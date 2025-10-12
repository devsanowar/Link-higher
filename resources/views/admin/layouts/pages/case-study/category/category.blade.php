@extends('admin.layouts.app')
@section('title', 'Category Page')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">All Category</h4>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
                            <i class="zmdi zmdi-plus"></i> Add Category
                        </button>

                    </div>


                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $category->category_name ?? '' }}</td>
                                        <td>
                                            @if ($category->status === 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <!-- Edit Link/Button -->
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-icon btn-info btn-edit-category" title="Edit"
                                                data-id="{{ $category->id }}" data-name="{{ $category->category_name }}"
                                                data-slug="{{ $category->category_slug }}"
                                                data-status="{{ (int) $category->status }}"
                                                data-update-url="{{ route('category.update', $category->id) }}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>


                                            <!-- Delete Link -->
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                    data-id="{{ $category->id }}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                    @include('admin.layouts.pages.case-study.category.add-category')
                    @include('admin.layouts.pages.case-study.category.edit-category')
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


    <script>
        (function() {
            // Simple slugify
            function slugify(text) {
                return text
                    .toString()
                    .trim()
                    .toLowerCase()
                    .replace(/[\s\_]+/g, '-') // spaces/underscores -> dash
                    .replace(/[^\w\-]+/g, '') // remove non-word
                    .replace(/\-\-+/g, '-') // collapse multiple dashes
                    .replace(/^-+|-+$/g, ''); // trim dashes
            }

            // Auto-generate slug from name
            $(document).on('input', '#cat_name', function() {
                const nameVal = $(this).val();
                const currentSlug = $('#cat_slug').val();
                if (!currentSlug || currentSlug === slugify(currentSlug)) {
                    $('#cat_slug').val(slugify(nameVal));
                }
            });

            // AJAX submit
            $('#createCategoryForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const $btnText = $('#catBtnText');
                const $btnSpin = $('#catBtnSpinner');
                const $btn = $('#catSubmitBtn');

                $btn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpin.removeClass('d-none');

                $.ajax({
                    url: "{{ route('category.store') }}", // আপনার store রুট
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res?.status === 'success') {
                            toastr.success(res.message || 'Category created successfully.');
                            $('#createCategoryForm')[0].reset();
                            $('#createCategoryModal').modal('hide');
                            location.reload();
                        } else {
                            toastr.error(res?.message || 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btnText.text('Create');
                        $btnSpin.addClass('d-none');
                    }
                });
            });

        })();
    </script>

    <script>
        (function() {
            // helper: slugify
            function slugify(text) {
                return text.toString().trim().toLowerCase()
                    .replace(/[\s_]+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }

            let editSlugTouched = false; // user typed in slug?
            let lastAutoSlug = null; // last auto-generated slug

            // ----- open Edit modal & prefill -----
            $(document).on('click', '.btn-edit-category', function() {
                const name = $(this).data('name') || '';
                const slugRaw = $(this).data('slug') || '';
                const rawStatus = $(this).data('status');
                const actionUrl = $(this).data('update-url');

                // normalize status "0"/"1"
                const statusStr = (rawStatus === 0 || rawStatus === "0") ? "0" :
                    (rawStatus === 1 || rawStatus === "1") ? "1" :
                    "1";

                // Prefill name
                $('#edit_cat_name').val(name);

                // Prefill slug: if DB empty -> generate from name
                const initialSlug = slugRaw ? slugRaw : slugify(name);
                $('#edit_cat_slug').val(initialSlug);
                lastAutoSlug = initialSlug;
                editSlugTouched = false; // allow auto-sync until user edits slug manually

                // Status + action
                $('#edit_cat_status').val(statusStr).trigger('change');
                $('#editCategoryForm').attr('action', actionUrl);

                // Show modal
                $('#editCategoryModal').modal('show');
            });

            // ----- user typed in slug => stop auto-overwrite -----
            $(document).on('input', '#edit_cat_slug', function() {
                editSlugTouched = true;
            });

            // ----- keep slug synced while user hasn't edited slug manually -----
            $(document).on('input', '#edit_cat_name', function() {
                const currentName = $(this).val() || '';
                const newAuto = slugify(currentName);
                const $slugInput = $('#edit_cat_slug');
                const currentSlug = $slugInput.val() || '';

                // যদি ইউজার slug ম্যানুয়ালি না ছোঁয়, অথবা slug এখনো last auto-র সমান,
                // তাহলে name বদলালে slug আপডেট করো
                if (!editSlugTouched || currentSlug === lastAutoSlug) {
                    $slugInput.val(newAuto);
                    lastAutoSlug = newAuto;
                }
            });

            // If using bootstrap-select:
            $('#editCategoryModal').on('shown.bs.modal', function() {
                if ($.fn.selectpicker) {
                    $('#edit_cat_status').selectpicker('refresh');
                }
            });
        })();
    </script>
@endpush
