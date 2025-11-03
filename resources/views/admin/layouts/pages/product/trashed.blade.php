@extends('admin.layouts.app')
@section('title', 'Trashed Products')

@section('admin_content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Trashed Products</h4>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="zmdi zmdi-arrow-left"></i> Back to Products
                    </a>
                </div>

                <div class="body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th style="width:80px;">Image</th>
                                <th>Product Name</th>
                                <th>Slug</th>
                                <th style="width:160px;">Website</th>
                                <th style="width:90px;">Price</th>
                                <th style="width:90px;">Traffic</th>
                                <th style="width:120px;">Target Country</th>
                                <th style="width:180px;">Deleted At</th>
                                <th style="width:170px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trashedProducts as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    {{-- Image --}}
                                    <td class="text-center">
                                        @php
                                            $rel = ltrim($product->image ?? '', '/');
                                            $abs = $rel ? public_path($rel) : null;
                                            $fallback = asset('backend/assets/images/user.jpg');
                                        @endphp
                                        <img src="{{ (!empty($rel) && file_exists($abs)) ? asset($rel) : $fallback }}"
                                             alt="Product Image" width="48" height="48"
                                             style="object-fit:cover; border-radius:6px;">
                                    </td>

                                    <td>{{ $product->product_name ?? '-' }}</td>
                                    <td>{{ $product->product_slug ?? '-' }}</td>
                                    <td>{{ Str::limit($product->website_url ?? '-', 30) }}</td>
                                    <td>${{ isset($product->price) ? number_format($product->price, 2) : '-' }}</td>
                                    <td>{{ $product->traffic ?? '-' }}</td>
                                    <td>{{ $product->target_country ?? '-' }}</td>
                                    <td>{{ optional($product->deleted_at)->format('Y-m-d H:i') ?? '-' }}</td>

                                    <td class="text-center">

                                        <a href="{{ route('products.restore', $product->id) }}"
                                                    class="btn btn-info btn-sm" title="Restore"><i class="zmdi zmdi-undo"></i></a>

                                        <!-- Permanent Delete Button -->
                                        <form action="{{ route('products.force.delete', $product->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $product->id }}" title="Delete Permanently">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center text-muted py-4">
                                        No trashed products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination (if you use paginate in controller) --}}
                    @if(method_exists($trashedProducts, 'links'))
                        <div class="d-flex justify-content-center mt-3">
                            {{ $trashedProducts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.deleteBtn', function() {
            let button = $(this);
            let form = button.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This product will be permanently deleted and cannot be recovered!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete permanently!',
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
