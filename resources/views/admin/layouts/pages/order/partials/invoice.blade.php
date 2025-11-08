{{-- resources/views/admin/orders/partials/invoice.blade.php --}}
<div id="invoiceContent">
    <div class="row">
        <div class="col-6">
            <img src="{{ asset($website_settings->website_logo ?? 'frontend/assets/images/logo-placeholder.jpg') }}" width="70" alt="Logo">
            <h5>{{ $website_settings->website_title ?? '' }}</h5>
            <div>{!! $website_settings->address_one ?? '' !!}</div>
            <div>{{ $website_settings->phone_one ?? '' }}</div>
        </div>
        <div class="col-6 text-right">
            <h5>Invoice # <strong>{{ $order->order_number ?? '' }}</strong></h5>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
            <p><strong>Name:</strong> {{ $order->billing_name ?? '' }}</p>
            <p><strong>Email:</strong> {{ $order->billing_email ?? '' }}</p>
            <p><strong>Status:</strong>
                <span class="badge badge-warning">{{ ucfirst($order->status) }}</span>
            </p>
        </div>
    </div>

    <hr>

    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-12 text-right mt-3">
            <h5>Total: ${{ number_format($order->total_amount ?? 0, 2) }}</h5>
        </div>
    </div>
</div>
