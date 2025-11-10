@extends('admin.dashboard')
@section('title', 'Trashed Data')
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Trashed Data </h4>
                        <a href="{{ route('order.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i>
                            </i> All Orders
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Order #</th>
                                        <th>Billing Name</th>
                                        <th>Billing Country</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders->get() as $key => $order)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $order->order_number ?? '-' }}</td>
                                            <td>{{ $order->billing_name ?? '-' }}</td>
                                            <td>{{ $order->billing_country ?? '-' }}</td>
                                            <td>${{ number_format($order->total_amount ?? 0, 2) }}</td>

                                            <td>
                                            <a href="{{ route('order.restore', $order->id) }}" class="btn btn-info btn-sm" title="Edit"><i class="zmdi zmdi-refresh"></i></a>

                                            <form action="{{ route('order.force.delete', $order->id) }}" method="POST"
                                                  style="display:inline-block;" id="delete-form-{{ $order->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $order->id }}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
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
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function() {
                let button = $(this);
                let form = button.closest('form');
                let rowId = button.data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Permanent delete this data!",
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
