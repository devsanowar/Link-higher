@extends('admin.layouts.app')
@section('title', 'Post Categories')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Post Categories </h4>

                        <!-- Button: Open Create Modal -->
                        <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#createPostCategoryModal">
                            <i class="zmdi zmdi-plus"></i> Create Category
                        </a>
                    </div>

                    {{-- Create Modal --}}
                    @include('admin.layouts.pages.post.category.create')

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->category_name ?? '' }}</td>
                                            <td>{{ $category->category_slug ?? '' }}</td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at ? $category->created_at->diffForHumans() : '-' }}</td>
                                            <td>
                                                <!-- Edit Button (open edit modal) -->
                                                <a href="javascript:void(0);" class="btn btn-info btn-sm" title="Edit"
                                                   data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                {{-- Include Edit Modal for this category --}}
                                                @include('admin.layouts.pages.post.category.edit', ['category' => $category])

                                                <!-- Delete Form -->
                                                <form action="{{ route('post-category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn" data-id="{{ $category->id }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- If you want pagination: --}}
                            {{-- {{ $categories->links() }} --}}
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
            // Delete Confirm
            $(document).on('click', '.deleteBtn', function() {
                let button = $(this);
                let form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
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

            // Auto-generate slug on create modal (client-side)
            $(document).on('input', '#category_name', function() {
                const text = $(this).val();
                const slug = text.toString().toLowerCase()
                    .replace(/\s+/g, '-')           // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                    .replace(/^-+/, '')             // Trim - from start of text
                    .replace(/-+$/, '');            // Trim - from end of text
                $('#category_slug').val(slug);
            });

            // Auto-generate slug on edit modals (for multiple modals)
            $(document).on('input', '.edit-category-name', function() {
                const $this = $(this);
                const id = $this.data('id');
                const text = $this.val();
                const slug = text.toString().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
                $('#category_slug_' + id).val(slug);
            });
        });
    </script>

@endpush
