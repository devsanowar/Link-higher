@extends('admin.layouts.app')
@section('title', 'Posts')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
@endpush
@section('admin_content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>All Posts</h4>
                    <a href="{{ route('post.create') }}" class="btn btn-primary">
                        <i class="zmdi zmdi-plus"></i> Add Post
                    </a>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Excerpt</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($posts as $key => $post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-center">
                                            @php
                                                $rel = ltrim($post->featured_image ?? '', '/');
                                                $abs = $rel ? public_path($rel) : null;
                                                $fallback = asset('backend/assets/images/user.jpg');
                                            @endphp
                                            <img src="{{ !empty($rel) && file_exists($abs) ? asset($rel) : $fallback }}"
                                                 alt="Post Image" width="64" height="48" style="object-fit:cover; border-radius:6px;">
                                        </td>
                                        <td>
                                            <strong>{{ $post->title ?? '-' }}</strong>
                                            <div class="small text-muted">Slug: {{ $post->slug ?? '-' }}</div>
                                            @if(!empty($post->meta_title))
                                                <div class="small text-muted">Meta: {{ Str::limit($post->meta_title, 40) }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $post->category->name ?? '-' }}</td>
                                        <td>{{ Str::limit(strip_tags($post->excerpt ?? $post->content ?? ''), 80, '...') }}</td>
                                        <td>
                                            @if ($post->status == 1)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-danger">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at ? $post->created_at->format('d M, Y') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-info btn-sm" title="View"><i class="zmdi zmdi-eye"></i></a>
                                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="zmdi zmdi-edit"></i></a>

                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn" data-id="{{ $post->id }}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div> <!-- body -->
            </div> <!-- card -->
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
                text: "This post will be moved to recycle bin (soft delete) or permanently deleted based on your route!",
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
