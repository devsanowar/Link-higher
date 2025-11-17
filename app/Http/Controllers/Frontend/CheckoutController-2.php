<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Country;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {

        if (! Auth::check() || Auth::user()->system_admin !== 'customer') {
            return redirect()->route('customer.register');
        }

        $cartContents = session()->get('cart', []);

        // if (empty($cartContents)) {
        //     return redirect()->route('cart.page')->with('error', 'Your cart is empty! Please add packages first.');
        // }

        $totalAmount = 0;
        $itemsCount  = 0;
        foreach ($cartContents as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $itemsCount += ($item['quantity'] ?? 1);
        }

        $countries = Country::where('status', 1)->orderBy('country_name')->get();

        $countries = Country::where('status', 1)->latest()->get();
        return view("website.checkout", compact("countries", "cartContents", "totalAmount", "itemsCount"));

    }

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
                'payment_method'  => 'cod',
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
            session()->forget('cart');

            return redirect()->route('order.success', $order->id)
                ->with('success', 'Your order has been placed successfully! Order#: ' . $orderNumber);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Order create failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to place order, please try again.');
        }
    }

    public function showOrderConfirmation($id)
    {
        // Load order with its items
        $order = Order::with(['items'])->find($id);

        if (! $order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        // User Must Own Order (except admin)
        if (Auth::check()) {
            $user = Auth::user();

            $isOwner = ($order->user_id == $user->id);
            $isCustomer = ($user->system_admin === 'customer');

            if (! $isOwner && ! $isCustomer) {
                return redirect()->route('home')->with('error', 'You are not allowed to view this order.');
            }
        } else {
            return redirect()->route('customer.register')
                ->with('error', 'Please login to view your order.');
        }


        return view('website.order.order-success', compact('order'));
    }

}
