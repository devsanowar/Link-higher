@extends('admin.layouts.app')
@section('title', 'Project Categories')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
<div class="container-fluid">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">All Project Categories</h4>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProjectCategoryModal">
                        <i class="zmdi zmdi-plus"></i> Add Project Category
                    </button>
                </div>

                <div class="body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:60px">#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th style="width:120px">Status</th>
                                <th style="width:140px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectCategories as $key => $pc)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $pc->name ?? '' }}</td>
                                    <td>{{ $pc->slug ?? '' }}</td>
                                    <td>
                                        @if ((int)$pc->status === 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Edit -->
                                        <a href="javascript:void(0)"
                                           class="btn btn-sm btn-icon btn-info btn-edit-pc"
                                           title="Edit"
                                           data-id="{{ $pc->id }}"
                                           data-name="{{ $pc->name }}"
                                           data-slug="{{ $pc->slug }}"
                                           data-status="{{ (int)$pc->status }}"
                                           data-update-url="{{ route('project-category.update', $pc->id) }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('project-category.destroy', $pc->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn" data-id="{{ $pc->id }}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($projectCategories->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No project categories found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @include('admin.layouts.pages.project.category.create')
                @include('admin.layouts.pages.project.category.edit')
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

    {{-- Delete confirm --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.deleteBtn', function () {
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
        });
    </script>

    {{-- Create: auto-slug + AJAX submit --}}
    <script>
        (function () {
            function slugify(text) {
                return text.toString().trim().toLowerCase()
                    .replace(/[\s_]+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }

            // auto-generate slug from name (create modal)
            $(document).on('input', '#pc_name', function () {
                const nameVal = $(this).val();
                const currentSlug = $('#pc_slug').val();
                if (!currentSlug || currentSlug === slugify(currentSlug)) {
                    $('#pc_slug').val(slugify(nameVal));
                }
            });

            // AJAX create
            $('#createProjectCategoryForm').on('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const $btn = $('#pcSubmitBtn');
                const $btnText = $('#pcBtnText');
                const $btnSpin = $('#pcBtnSpinner');

                $btn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpin.removeClass('d-none');

                $.ajax({
                    url: "{{ route('project-category.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res?.status === 'success') {
                            toastr.success(res.message || 'Project category created successfully.');
                            $('#createProjectCategoryForm')[0].reset();
                            $('#createProjectCategoryModal').modal('hide');
                            location.reload();
                        } else {
                            toastr.error(res?.message || 'Something went wrong!');
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function (k, v) {
                                toastr.error(v[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function () {
                        $btn.prop('disabled', false);
                        $btnText.text('Create');
                        $btnSpin.addClass('d-none');
                    }
                });
            });
        })();
    </script>

    {{-- Edit: prefill + smart slug sync --}}
    <script>
        (function () {
            function slugify(text) {
                return text.toString().trim().toLowerCase()
                    .replace(/[\s_]+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }

            let editSlugTouched = false;
            let lastAutoSlug = null;

            // open edit modal
            $(document).on('click', '.btn-edit-pc', function () {
                const name = $(this).data('name') || '';
                const slugRaw = $(this).data('slug') || '';
                const rawStatus = $(this).data('status');
                const actionUrl = $(this).data('update-url');

                const statusStr = (rawStatus === 0 || rawStatus === "0") ? "0"
                                 : (rawStatus === 1 || rawStatus === "1") ? "1" : "1";

                $('#edit_pc_name').val(name);

                const initialSlug = slugRaw ? slugRaw : slugify(name);
                $('#edit_pc_slug').val(initialSlug);
                lastAutoSlug = initialSlug;
                editSlugTouched = false;

                $('#edit_pc_status').val(statusStr).trigger('change');
                $('#editProjectCategoryForm').attr('action', actionUrl);

                $('#editProjectCategoryModal').modal('show');
            });

            $(document).on('input', '#edit_pc_slug', function () {
                editSlugTouched = true;
            });

            $(document).on('input', '#edit_pc_name', function () {
                const currentName = $(this).val() || '';
                const newAuto = slugify(currentName);
                const $slugInput = $('#edit_pc_slug');
                const currentSlug = $slugInput.val() || '';

                if (!editSlugTouched || currentSlug === lastAutoSlug) {
                    $slugInput.val(newAuto);
                    lastAutoSlug = newAuto;
                }
            });

            $('#editProjectCategoryModal').on('shown.bs.modal', function () {
                if ($.fn.selectpicker) {
                    $('#edit_pc_status').selectpicker('refresh');
                }
            });
        })();
    </script>
@endpush
