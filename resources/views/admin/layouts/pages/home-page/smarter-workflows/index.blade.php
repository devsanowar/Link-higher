@extends('admin.layouts.app')
@section('title', 'Smarter Workflows')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Smarter Workflows section image edit</h4>
                    </div>
                    <div class="card-body">
                        <form id="EditWorkflowForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Section Image --}}
                            @php
                                $existingImage = $workflowImage->image ?? null;
                                $currentSrc = $existingImage
                                    ? (\Illuminate\Support\Str::startsWith($existingImage, [
                                        'http://',
                                        'https://',
                                        '/storage',
                                    ])
                                        ? $existingImage
                                        : asset($existingImage))
                                    : asset('backend/assets/images/placeholder-rect.png');
                            @endphp

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Image <strong class="text-danger">*</strong></label>
                                </div>

                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Current image preview (wrapper + id) --}}
                                        <div class="mt-2 {{ $existingImage ? '' : 'd-none' }}" id="currentImageWrap">
                                            <small class="text-muted d-block mb-1">Current Image</small>
                                            <img id="currentImage" src="{{ $currentSrc }}" alt="Current Image"
                                                class="border rounded" width="120">
                                        </div>

                                        {{-- keep current path (if needed server-side) --}}
                                        <input type="hidden" id="currentImageInput" name="current_image"
                                            value="{{ $existingImage }}">

                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Workflows </h4>
                        <a href="{{ route('home.smarter-workflows.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Workflow
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($workflows as $key => $workflow)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $workflow->title ?? '' }}</td>
                                            <td>{{ Str::limit(strip_tags($workflow->description ?? ''), 60, '...') }}</td>

                                            <td>
                                                @if ($workflow->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('home.smarter-workflows.edit', $workflow->id) }}"
                                                    class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('home.smarter-workflows.destroy', $workflow->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $workflow->id }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- যদি pagination ব্যবহার করো --}}
                            @if (method_exists($workflows, 'links'))
                                <div class="mt-3">
                                    {{ $workflows->links() }}
                                </div>
                            @endif

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
                let form = $(this).closest('form');

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
        $(document).ready(function() {
            $("#EditWorkflowForm").on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                if (!formData.has('_method')) formData.append('_method', 'PUT');

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('home.smarter-workflow-image.update') }}", // must match your route name
                    type: "POST", // always POST when using _method spoofing
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'Image updated successfully.');

                            // Update current + preview images in real-time (with cache-busting)
                            if (response.imageUrl) {
                                const busted = response.imageUrl + '?_=' + Date.now();

                                // preview image
                                $("#previewImage")
                                    .removeClass('d-none')
                                    .attr('src', busted);

                                // current image (if exists in DOM)
                                const $currentImg = $("#currentImage");
                                const $currentWrap = $("#currentImageWrap");
                                if ($currentImg.length) {
                                    $currentImg.attr('src', busted);
                                }
                                if ($currentWrap.length) {
                                    $currentWrap.removeClass('d-none');
                                }

                                // hidden current_image input (optional)
                                const $currentInput = $("#currentImageInput");
                                if ($currentInput.length) {
                                    $currentInput.val(response.imageUrl);
                                }

                                // clear file input (optional)
                                $('#image').val('');
                            }
                        } else {
                            toastr.error(response.message ?? 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        $('#btnText').text('UPDATE');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
