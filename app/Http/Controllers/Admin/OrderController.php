<?php
namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\OrderStatusChanged;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders           = Order::latest()->get();
        $trashedDataCount = Order::onlyTrashed()->count();
        return view('admin.layouts.pages.order.index', compact('orders', 'trashedDataCount'));
    }

    public function orderChangeStatus(Request $request, $id)
    {
        // Validate incoming status
        $request->validate([
            'status' => ['required', Rule::in(['pending', 'received', 'completed', 'cancelled'])],
        ]);

        $order = Order::findOrFail($id);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // If no change, optionally skip
        if ($oldStatus === $newStatus) {
            return redirect()->back()->with('info', 'Status unchanged.');
        }

        // Update
        $order->status            = $newStatus;
        $order->status_updated_at = now(); // recommended
        $order->save();

        // Send email (queued)
        // ensure $order->customer_email exists; fallback to user relation if you have it
        $to = $order->customer_email ?? ($order->user->email ?? null);

        if ($to) {
            // queued send: requires queue worker running
            Mail::to($to)->queue(new OrderStatusChanged($order));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Order status updated successfully.',
        ]);
    }

    public function show($id)
    {

        $order = Order::with(['items'])->find($id);

        return view('admin.layouts.pages.order.show', compact('order'));
    }

    public function invoice()
    {
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

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }

    /**
     * Summary of trashed
     */
    public function trashed()
    {
        $orders = Order::onlyTrashed();
        return view('admin.layouts.pages.order.recycle-bin', compact('orders'));
    }

    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('order.trashed')->with('success', 'Order restored successfully.');
    }

    public function forceDelete($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
        return redirect()->route('order.trashed')->with('success', 'Order deleted successfully.');
    }

}
