<div class="col-12 col-xxl-7" id="orders">
    <div class="card card-modern">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recent Orders</h5>
            <a href="#" class="btn btn-sm btn-primary">View all</a>
        </div>
        <div class="table-responsive d-none d-sm-block">
            <table class="table table-modern align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $recentOrder)
                        <tr>
                            <td class="fw-medium">#{{ $recentOrder->order_number ?? $recentOrder->id }}</td>

                            <td>{{ $recentOrder->created_at->format('d M, Y') }}</td>

                            <td>
                                @if ($recentOrder->status == 'processing')
                                    <span
                                        class="badge bg-warning-subtle text-warning border border-warning-subtle">Processing</span>
                                @elseif($recentOrder->status == 'completed')
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle">Completed</span>
                                @elseif($recentOrder->status == 'cancelled')
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle">Cancelled</span>
                                @else
                                    <span
                                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">{{ ucfirst($recentOrder->status) }}</span>
                                @endif
                            </td>

                            <td>$ {{ number_format($recentOrder->total_amount, 2) }}</td>

                            <td>
                                <button class="btn btn-sm btn-outline-secondary">Details</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>

        </div>
        <div class="mt-3 for-desktop">
            {{ $recentOrders->links('pagination::bootstrap-5') }}
        </div>
        <!-- Mobile order cards -->
        <div class="d-sm-none p-2">
            @foreach ($recentOrders as $recentOrder)
                <div class="card mb-2 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-semibold">#{{ $recentOrder->order_number ?? $recentOrder->id }}</div>
                            <small class="text-secondary">{{ $recentOrder->created_at->format('d M, Y') }}</small>
                            <div class="mt-1">
                                @if ($recentOrder->status == 'processing')
                                    <span
                                        class="badge bg-warning-subtle text-warning border border-warning-subtle">Processing</span>
                                @elseif($recentOrder->status == 'completed')
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle">Completed</span>
                                @elseif($recentOrder->status == 'cancelled')
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle">Cancelled</span>
                                @else
                                    <span
                                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">{{ ucfirst($recentOrder->status) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">${{ number_format($recentOrder->total_amount, 2) }}</div>

                            <a href="javascript:void(0);" class="btn btn-info btn-sm openOrderModal"
                                data-url="{{ route('order.invoice.show', $recentOrder->id) }}"
                                data-id="{{ $recentOrder->id }}" title="View / Print">
                                <i class="zmdi zmdi-print"></i>
                            </a>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 for-phone">
            {{ $recentOrders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>





