@extends('admin.layouts.app')
@section('title', 'Products')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
@endpush
@section('admin_content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>All Products - <span><a href="{{ route('products.trashed') }}" class="btn btn-danger">Recycle Bin ({{ $trashedDataCount }})</a></span></h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="zmdi zmdi-plus"></i> Add Product
                    </a>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Website Url</th>
                                    <th>Price</th>
                                    <th>Ahrefs DR</th>
                                    <th>Moz DA</th>
                                    <th>Traffic</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-center">
                                            @php
                                                $rel = ltrim($product->image ?? '', '/');
                                                $abs = $rel ? public_path($rel) : null;
                                                $fallback = asset('backend/assets/images/user.jpg');
                                            @endphp
                                            <img src="{{ !empty($rel) && file_exists($abs) ? asset($rel) : $fallback }}"
                                                 alt="Product Image" width="48" height="48" style="object-fit:cover; border-radius:6px;">
                                        </td>
                                        <td>{{ $product->product_name ?? '' }}</td>
                                        <td>{{ Str::limit($product->website_url ?? '', 25, '...') }}</td>
                                        <td>${{ number_format($product->price ?? 0, 2) }}</td>
                                        <td>{{ $product->ahrefs_dr ?? '-' }}</td>
                                        <td>{{ $product->moz_da ?? '-' }}</td>
                                        <td>{{ $product->traffic ?? '-' }}</td>
                                        <td>{{ $product->target_country ?? '-' }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                               class="btn btn-primary btn-sm" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                  style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $product->id }}">
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
<script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>

<script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.deleteBtn', function() {
            let button = $(this);
            let form = button.closest('form');
            let rowId = button.data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This product will be permanently deleted!",
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
