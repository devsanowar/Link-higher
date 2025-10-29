<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnRefund;
use Illuminate\Http\Request;

class ReturnAndRefundController extends Controller
{
    public function index()
    {
        $return_refund = ReturnRefund::first();
        return view('admin.layouts.pages.return-refund.index', compact('return_refund'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'return_refund_policy' => 'required',
        ]);

        $return_refund = ReturnRefund::first();
        if (!$return_refund) {
            $return_refund = new ReturnRefund();
        }
        $return_refund->return_refund_policy = $request->input('return_refund_policy');
        $return_refund->save();



        return response()->json([
            'status' => 'success',
            'message' => 'Return & Refund Policy updated successfully.'
        ]);
    }
}
