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

                            <td>৳ {{ number_format($recentOrder->total_amount, 2) }}</td>

                            <td>
                                <button class="btn btn-sm btn-outline-secondary">Details</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>

        </div>
        <div class="mt-3">
    {{ $recentOrders->links('pagination::bootstrap-5') }}
</div>
        <!-- Mobile order cards -->
        <div class="d-sm-none p-2">
            <div class="card mb-2 border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold">#INV-1123</div>
                        <small class="text-secondary">Oct 26, 2025</small>
                        <div class="mt-1"><span
                                class="badge bg-success-subtle text-success border border-success-subtle">Delivered</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold">৳ 2,980</div>
                        <button class="btn btn-sm btn-outline-secondary mt-2">Details</button>
                    </div>
                </div>
            </div>
            <div class="card mb-2 border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold">#INV-1122</div>
                        <small class="text-secondary">Oct 24, 2025</small>
                        <div class="mt-1"><span
                                class="badge bg-warning-subtle text-warning border border-warning-subtle">Processing</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold">৳ 4,250</div>
                        <button class="btn btn-sm btn-outline-secondary mt-2">Details</button>
                    </div>
                </div>
            </div>
            <div class="card mb-2 border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold">#INV-1121</div>
                        <small class="text-secondary">Oct 22, 2025</small>
                        <div class="mt-1"><span
                                class="badge bg-info-subtle text-info border border-info-subtle">Shipped</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold">৳ 1,750</div>
                        <button class="btn btn-sm btn-outline-secondary mt-2">Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
