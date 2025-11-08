@extends('admin.layouts.app')
@section('title', 'Orders')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{-- <h4>All Orders - <span><a href="{{ route('orders.trashed') }}" class="btn btn-danger">Recycle Bin ({{ $trashedDataCount }})</a></span></h4> --}}

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Order #</th>
                                        <th>Billing Name</th>
                                        <th>Billing Email</th>
                                        <th>Billing Country</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr id="order-row-{{ $order->id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order->order_number ?? '-' }}</td>
                                            <td>{{ $order->billing_name ?? '-' }}</td>
                                            <td>{{ $order->billing_email ?? '-' }}</td>
                                            <td>{{ $order->billing_country ?? '-' }}</td>
                                            <td>${{ number_format($order->total_amount ?? 0, 2) }}</td>
                                            <td>{{ strtoupper($order->payment_method ?? 'cod') }}</td>
                                            <td>
                                                <select class="form-control form-control-sm show-tick" name="status">
                                                    <option value="pending"
                                                        {{ $order->status === 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="received"
                                                        {{ $order->status === 'received' ? 'selected' : '' }}>Received
                                                    </option>
                                                    <option value="completed"
                                                        {{ $order->status === 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                    <option value="cancelled"
                                                        {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                            </td>

                                            <td>
                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-info btn-sm" title="View"><i class="zmdi zmdi-eye"></i></a>

                                            {{-- <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                  style="display:inline-block;" id="delete-form-{{ $order->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $order->id }}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>

    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {

            // DELETE with SweetAlert confirmation (same as original)
            $(document).on('click', '.deleteBtn', function() {
                let button = $(this);
                let orderId = button.data('id');
                let form = $('#delete-form-' + orderId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This order will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endpush
