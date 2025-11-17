<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// PayPal client (srmklive)
use Srmklive\PayPal\Services\PayPal as PayPalClient;

// Paddle official SDK
use Paddle\SDK\Paddle;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (! Auth::check() || Auth::user()->system_admin !== 'customer') {
            return redirect()->route('customer.register');
        }

        $cartContents = session()->get('cart', []);
        $totalAmount = 0;
        $itemsCount  = 0;
        foreach ($cartContents as $item) {
            $totalAmount += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            $itemsCount += ($item['quantity'] ?? 1);
        }

        $countries = Country::where('status', 1)->orderBy('country_name')->get();
        return view("website.checkout", compact("countries", "cartContents", "totalAmount", "itemsCount"));
    }

    /**
     * Main process method: create order in DB and branch by payment method.
     */
    public function process(Request $request)
    {
        $data = $request->validate([
            'fname'        => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'country_name' => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:255',
            'zip'          => 'nullable|string|max:50',
            'address'      => 'required|string|max:1000',
            'notes'        => 'nullable|string|max:2000',
            'payment_method' => 'required|string|in:cod,paypal,paddle',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty! Please add packages first.');
        }

        // calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $price = $item['price'] ?? 0;
            $qty   = $item['quantity'] ?? 1;
            $subtotal += $price * $qty;
        }
        $totalAmount = $subtotal;

        $orderNumber = strtoupper('ORD-' . date('Ymd') . '-' . Str::random(6));

        DB::beginTransaction();
        try {
            // create order record (payment_status = pending)
            $order = Order::create([
                'user_id'         => Auth::id(),
                'order_number'    => $orderNumber,
                'billing_name'    => $data['fname'],
                'billing_email'   => $data['email'],
                'billing_country' => $data['country_name'] ?? null,
                'billing_city'    => $data['city'] ?? null,
                'billing_zip'     => $data['zip'] ?? null,
                'billing_address' => $data['address'],
                'subtotal'        => $subtotal,
                'total_amount'    => $totalAmount,
                'payment_method'  => $data['payment_method'],
                'payment_status'  => 'pending',
                'status'          => 'pending',
                'notes'           => $data['notes'] ?? null,
            ]);

            foreach ($cart as $item) {
                $price = $item['price'] ?? 0;
                $qty   = $item['quantity'] ?? 1;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'plan_id'    => $item['plan_id'] ?? null,
                    'name'       => $item['plan_name'] ?? 'Package',
                    'price'      => $price,
                    'quantity'   => $qty,
                    'line_total' => $price * $qty,
                    'meta'       => [
                        'service_title'    => $item['service_title'] ?? null,
                        'service_category' => $item['service_category'] ?? null,
                        'image'            => $item['image'] ?? null,
                        'currency'         => $item['currency'] ?? 'USD',
                        'discount'         => $item['discount'] ?? null,
                        'discount_type'    => $item['discount_type'] ?? null,
                    ],
                ]);
            }

            DB::commit();

            // Branch by payment method
            if ($data['payment_method'] === 'cod') {
                session()->forget('cart');
                return redirect()->route('order.success', $order->id)
                    ->with('success', 'Your order has been placed successfully! Order#: ' . $orderNumber);
            }

            if ($data['payment_method'] === 'paypal') {
                // redirect to PayPal initiation route
                return redirect()->route('paypal.redirect', $order->id);
            }

            if ($data['payment_method'] === 'paddle') {
                // redirect to Paddle initiation route
                return redirect()->route('paddle.redirect', $order->id);
            }

            // fallback
            return redirect()->route('order.success', $order->id);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Order create failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to place order, please try again.');
        }
    }

    /**
     * PayPal: redirect user to PayPal approval page
     */
    public function paypalRedirect($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        // use srmklive/paypal
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();

        $orderData = [
            "intent" => "CAPTURE",
            "application_context" => [
                "cancel_url" => route('checkout.page'),
                "return_url" => route('paypal.callback'),
            ],
            "purchase_units" => [[
                "reference_id" => $order->order_number,
                "amount" => [
                    "currency_code" => "USD",
                    "value" => number_format($order->total_amount, 2, '.', '')
                ],
                "description" => "Order #".$order->order_number
            ]]
        ];

        $response = $provider->createOrder($orderData);

        if (isset($response['id']) && isset($response['links'])) {
            // find approval link
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        Log::error('PayPal create order failed: ' . json_encode($response));
        return redirect()->route('checkout.page')->with('error', 'Unable to initiate PayPal payment.');
    }

    /**
     * PayPal callback - capture payment and update order
     */
    public function paypalCallback(Request $request)
    {
        $token = $request->query('token'); // token returned by PayPal
        $payerId = $request->query('PayerID');

        if (! $token) {
            return redirect()->route('checkout.page')->with('error', 'PayPal payment canceled or failed.');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // capture
        $capture = $provider->capturePaymentOrder($token);

        // Check capture status
        if (isset($capture['status']) && in_array($capture['status'], ['COMPLETED','APPROVED','COMPLETED'])) {
            // find reference id (our order number)
            $reference = $capture['purchase_units'][0]['reference_id'] ?? null;
            if ($reference) {
                $order = Order::where('order_number', $reference)->first();
                if ($order) {
                    $order->payment_status = 'paid';
                    $order->status = 'processing';
                    $order->transaction_id = $capture['id'] ?? $token;
                    $order->save();

                    // clear cart
                    session()->forget('cart');

                    return redirect()->route('order.success', $order->id)->with('success', 'Payment completed via PayPal.');
                }
            }
            // fallback: redirect to checkout
            return redirect()->route('checkout.page')->with('error', 'Order not found after PayPal payment.');
        }

        Log::error('PayPal capture response: ' . json_encode($capture));
        return redirect()->route('checkout.page')->with('error', 'PayPal payment failed.');
    }

    /**
     * Paddle redirect - open Paddle checkout (server-side example)
     * Note: Often you'll open Paddle Checkout using client-side Paddle.js with product id.
     * Here we create a simple server-side flow that returns a redirect/checklink if needed.
     */
    public function paddleRedirect($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        // Initialize Paddle client (official SDK)
        $paddle = new Paddle([
            'vendor_id' => env('PADDLE_VENDOR_ID'),
            'vendor_auth_code' => env('PADDLE_VENDOR_AUTH_CODE'),
        ]);

        // You can either:
        // 1) Create a checkout link / use product ID + passthrough and redirect user to Paddle Checkout page
        // 2) Use Paddle.js from frontend and open checkout with product_id and passthrough = json_encode([...])
        //
        // Example: create a checkout link via 'checkout/generate_pay_link' endpoint (vendor API)
        try {
            $payload = [
                'title' => 'Order '.$order->order_number,
                'webhook_url' => route('paddle.webhook'),
                'prices' => ['USD:' . number_format($order->total_amount, 2, '.', '')],
                'quantity' => 1,
                'passthrough' => json_encode(['order_id' => $order->id, 'order_number' => $order->order_number]),
                // optionally product_id or other fields if you manage products in Paddle
            ];

            // The official SDK method name may vary; below is illustrative:
            $response = $paddle->checkout()->generatePayLink($payload);

            if (!empty($response['url'])) {
                return redirect()->away($response['url']);
            }

            Log::error('Paddle generate link failed: ' . json_encode($response));
            return redirect()->route('checkout.page')->with('error', 'Unable to initiate Paddle checkout.');
        } catch (\Throwable $e) {
            Log::error('Paddle redirect error: ' . $e->getMessage());
            return redirect()->route('checkout.page')->with('error', 'Paddle integration error.');
        }
    }

    /**
     * Paddle webhook to confirm payment (server-to-server)
     * Paddle will POST to this route with sale data. Validate/verify signature (see Paddle docs).
     */
    public function paddleWebhook(Request $request)
    {
        // IMPORTANT: validate Paddle webhook signature before trusting data.
        // The official SDK includes webhook verification helpers.
        // For brevity: implement verification according to Paddle docs and then:
        $data = $request->all();

        // Example: if passthrough contains order_id
        $passthrough = json_decode($data['passthrough'] ?? '{}', true);
        $orderId = $passthrough['order_id'] ?? null;

        if ($orderId) {
            $order = Order::find($orderId);
            if ($order) {
                // check event & status fields from Paddle webhook to ensure it's a successful payment
                // For example, event_type = 'payment_succeeded' or sale_status = 'completed'
                $order->payment_status = 'paid';
                $order->status = 'processing';
                $order->transaction_id = $data['checkout_id'] ?? ($data['sale_id'] ?? null);
                $order->save();

                // clear cart for user (if stored in session it'll already be gone for this flow;
                // if you need to notify user, send email, etc.)
            }
        }

        return response('OK', 200);
    }

    public function showOrderConfirmation($id)
    {
        $order = Order::with(['items'])->find($id);

        if (! $order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        if (Auth::check()) {
            $user = Auth::user();
            $isOwner = ($order->user_id == $user->id);
            $isCustomer = ($user->system_admin === 'customer');
            if (! $isOwner && ! $isCustomer) {
                return redirect()->route('home')->with('error', 'You are not allowed to view this order.');
            }
        } else {
            return redirect()->route('customer.register')->with('error', 'Please login to view your order.');
        }

        return view('website.order.order-success', compact('order'));
    }
}
