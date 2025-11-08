@extends('admin.layouts.app')
@section('title', 'Show order details')
@push('styles')
    @media print {
    .no-print {
        display: none !important;
    }
}

@endpush
@section('admin_content')

    <div id="invoiceArea" class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="header">
                        <h2>Invoices Detail</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <img src="{{ asset($website_settings->website_logo ?? 'frontend/assets/images/logo-placeholder.jpg') }}"
                                    width="70" alt="Link Higher">
                                <h4 class="float-md-right">Invoice # <strong>{{ $order->order_number ?? '' }}</strong></h4>
                                <hr>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <address>
                                    <strong>{{ $website_settings->website_title ?? '' }}</strong><br>
                                    <strong>Office One</strong> : {!! $website_settings->address_one ?? '' !!}<br>
                                    <strong>Office two</strong> {!! $website_settings->address_two ?? '' !!}<br>
                                    <abbr title="Phone"><strong>Phone</strong>:</abbr>
                                    {{ $website_settings->phone_one ?? '' }}
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                <p class="mb-0"><strong>Order Date: </strong> {{ $order->created_at->format('M d, Y') }}
                                </p>
                                <p class="mb-0"><strong>Name: </strong> <span>{{ $order->billing_name ?? '' }}</span></p>
                                <p class="mb-0"><strong>Order Status: </strong> <span
                                        class="badge bg-orange">Pending</span></p>
                                <p class="mb-0"><strong>Order ID: </strong> #123456</p>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="mainTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item</th>
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
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ number_format($item->price, 2) }}</td>
                                                    <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <p class="text-right">
                                    <b>Total:</b> ${{ number_format($order->total_amount ?? 0, 2) }}
                                </p>

                                <hr>
                            </div>
                            <div class="col-md-12 text-right hidden-print">
<a href="javascript:void(0);" onclick="printDiv('invoiceArea')" class="btn btn-raised btn-success">
    <i class="zmdi zmdi-print"></i>
</a>


                                <a href="javascript:void(0);" class="btn btn-raised btn-default">Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>

@endpush
