<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::latest()->get();
        return view('admin.layouts.pages.order.index', compact('orders'));
    }

    public function show($id){

        $order = Order::with(['items'])->find($id);

        return view('admin.layouts.pages.order.show', compact('order'));
    }

    public function invoice(){
        $orders = Order::latest()->get();

        return view('admin.layouts.pages.order.invoice', compact('orders'));
    }


    public function invoiceShow(Request $request, $id)
{
    $order = Order::with(['items'])->findOrFail($id);

    // যদি AJAX বা modal=1 আসে — partial return করুন
    if ($request->ajax() || $request->query('modal')) {
        // partial view: resources/views/admin/orders/partials/invoice.blade.php
        return view('admin.layouts.pages.order.partials.invoice', compact('order'));
    }

    // otherwise full page (your existing full page view)
    return view('admin.layouts.pages.order.show', compact('order'));
}


}
