@extends('admin.layouts.app')
@section('title', 'Invoice Management')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
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


                                            <!-- replace your action column button with this -->
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-info btn-sm openOrderModal"
                                                    data-url="{{ route('order.invoice.show', $order->id) }}"
                                                    data-id="{{ $order->id }}" title="View / Print">
                                                    <i class="zmdi zmdi-print"></i>
                                                </a>

                                            </td>

                                            @include('admin.layouts.pages.order.modal')

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


    <script>
        $(document).ready(function() {
            // Open modal & load invoice partial via AJAX
            $(document).on('click', '.openOrderModal', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                // ask server to return only modal partial
                let fetchUrl = url + (url.indexOf('?') === -1 ? '?modal=1' : '&modal=1');

                $('#orderModalContent').html('Loading...');
                $('#orderModal').modal('show');

                $.get(fetchUrl, function(html) {
                    $('#orderModalContent').html(html);
                }).fail(function() {
                    $('#orderModalContent').html(
                        '<div class="alert alert-danger">Could not load order details.</div>');
                });
            });

            // Print only modal content: open in new window and print
            $('#modalPrintBtn').on('click', function() {
                let content = document.getElementById('orderModalContent').innerHTML;
                // optional: page title
                let title = document.querySelector('#orderModalLabel').innerText || 'Invoice';
                let printWindow = window.open('', '_blank', 'width=900,height=700');
                printWindow.document.open();
                printWindow.document.write(`
            <!doctype html>
            <html>
            <head>
                <meta charset="utf-8">
                <title>${title}</title>
                <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
                <style>
                    /* hide anything unnecessary in print */
                    .no-print { display: none !important; }
                    body { padding: 20px; font-family: Arial, Helvetica, sans-serif; }
                </style>
            </head>
            <body>
                ${content}
            </body>
            </html>
        `);
                printWindow.document.close();
                // ensure content rendered before printing
                printWindow.onload = function() {
                    printWindow.focus();
                    printWindow.print();
                    // optionally close after print
                    // printWindow.close();
                };
            });
        });
    </script>
@endpush
