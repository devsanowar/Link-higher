<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PackagePlan;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    public function index()
    {
        $cartContents = session()->get('cart', []);

        $totalAmount = 0;
        $itemCount = 0;
        foreach ($cartContents as $item) {
            $qty = isset($item['quantity']) ? (int)$item['quantity'] : 1;
            $price = isset($item['price']) ? (float)$item['price'] : 0;
            $totalAmount += $price * $qty;
            $itemCount += $qty;
        }

        return view('website.cart-page', [
            'cartContents' => $cartContents,
            'totalAmount' => round($totalAmount, 2),
            'itemCount' => $itemCount,
        ]);
    }

    public function addPlan(Request $request, PackagePlan $plan)
    {
        // Load relation service if available
        $plan->loadMissing('service', 'service.ServiceCategory');

        // Determine final price (respecting discount_type)
        $price = $plan->price;
        if (! empty($plan->discount) && ! empty($plan->discount_type)) {
            if ($plan->discount_type === 'percent') {
                $price = $plan->price - ($plan->price * $plan->discount) / 100;
            } elseif ($plan->discount_type === 'amount' || $plan->discount_type === 'flat') {
                // you used 'amount' in schema; accept 'flat' too if older code used it
                $price = $plan->price - $plan->discount;
            }
        } elseif (! empty($plan->final_price) && $plan->final_price > 0) {
            $price = $plan->final_price;
        }

        $price = round(max(0, $price), 2);

        // session cart structure: cart[<key>] = [...]
        $cart = session()->get('cart', []);

        // Use a unique key per plan (so multiple plans won't collide)
        $key = 'plan_' . $plan->id;

        if (isset($cart[$key])) {
            // if exists, increment quantity (or keep 1 if you don't want multiples)
            $cart[$key]['quantity'] += 1;
            $message = 'Package quantity updated in cart';
        } else {
            $service = $plan->service; // may be null if relation missing

            $cart[$key] = [
                'key'              => $key,
                'type'             => 'package_plan',
                'plan_id'          => $plan->id,
                'plan_name'        => $plan->name,
                'price'            => $price,
                'quantity'         => 1,
                'currency'         => $plan->currency ?? 'USD',
                // attach related service info (for display in cart)
                'service_id'       => $service->id ?? null,
                'service_title'    => $service->title ?? ($service->name ?? null),
                'image'    => $service->image ?? null, // adjust fieldname as your schema
                'service_category' => $service->ServiceCategory->name ?? null,
                // keep original price/meta if needed
                'regular_price'    => $plan->price,
                'discount'         => $plan->discount,
                'discount_type'    => $plan->discount_type,
            ];
            $message = 'Package added to cart';
        }

        session()->put('cart', $cart);

        // redirect to cart page with success flash
        return redirect()->route('cart.page')->with('success', $message);
    }


    // Update quantity (POST)
    public function updateQty(Request $request, $key)
    {
        $qty = max(1, (int) $request->quantity);

        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $qty;
            session()->put('cart', $cart);
            return redirect()->route('cart.page')->with('success', 'Quantity updated.');
        }

        return redirect()->route('cart.page')->with('error', 'Item not found in cart.');
    }


    public function remove(Request $request, $key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return redirect()->route('cart.page')->with('success', 'Item removed from cart.');
        }

        return redirect()->route('cart.page')->with('error', 'Item not found in cart.');
    }


}
