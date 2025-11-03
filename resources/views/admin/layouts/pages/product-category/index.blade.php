@extends('admin.layouts.app')
@section('title', 'Product Categories')
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">All Product Categories</h4>

                        <a href="{{ route('product-category.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Category
                        </a>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px;">#</th>
                                    <th style="width:80px;">Image</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th style="width:120px;">Status</th>
                                    <th style="width:140px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <th scope="row" style="vertical-align:middle;">{{ $key + 1 }}</th>
                                        <td class="text-center">
                                            @php
                                                // normalize stored path and check existence
                                                $rel = ltrim($category->image ?? '', '/');
                                                $abs = $rel ? public_path($rel) : null;
                                                $fallback = asset('backend/assets/images/user.jpg');
                                            @endphp

                                            <img src="{{ !empty($rel) && $rel !== 'default.jpg' && file_exists($abs) ? asset($rel) : $fallback }}"
                                                 alt="Category Image" width="48" height="48" style="object-fit:cover; border-radius:6px;">
                                        </td>

                                        <td style="vertical-align:middle;">{{ $category->category_name ?? '' }}</td>
                                        <td style="vertical-align:middle;">{{ $category->category_slug ?? '' }}</td>

                                        <td class="text-center" style="vertical-align:middle;">
                                            @if(isset($category->status) && $category->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>

                                        <td class="text-center" style="vertical-align:middle;">
                                            <!-- Edit Link -->
                                            <a href="{{ route('product-category.edit', $category->id) }}"
                                               class="btn btn-sm btn-icon btn-info" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <!-- Delete Link -->
                                            <form action="{{ route('product-category.destroy', $category->id) }}" method="POST"
                                                  style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $category->id }}" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                                @if($categories->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            No product categories found.
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                        <!-- optional: pagination (if controller returns paginated result) -->
                        @if(method_exists($categories, 'links'))
                            <div class="d-flex justify-content-center mt-3">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
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
                    text: "This category will be permanently deleted!",
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
