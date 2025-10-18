@extends('admin.layouts.app')
@section('title', 'Edit About Us')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit About Us</h4>
                    </div>

                    <div class="card-body">
                        <form id="EditAboutForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="title">Title <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="text"
                                                id="title"
                                                name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter title"
                                                value="{{ old('title', $about->title ?? '') }}"
                                                required
                                            >
                                        </div>
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="description">Description <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea
                                                id="description"
                                                name="description"
                                                class="form-control @error('description') is-invalid @enderror"
                                                rows="6"
                                                placeholder="Write the about content..."
                                                required
                                            >{!! old('description', $about->description ?? '') !!}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Image</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="file"
                                                id="image"
                                                name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                accept="image/*"
                                            >
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Existing image preview --}}
                                        @if(!empty($about?->image))
                                            <div class="mt-2">
                                                <small class="text-muted d-block mb-1">Current image:</small>
                                                <img src="{{ asset($about->image) }}" alt="About Image" style="max-height: 110px;">
                                            </div>
                                        @endif

                                        {{-- New image live preview --}}
                                        <img id="newImagePreview" class="mt-2 d-none" style="max-height: 110px;" />
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        // New image live preview
        $('#image').on('change', function (e) {
            const file = e.target.files?.[0];
            if (!file) return $('#newImagePreview').addClass('d-none');
            const reader = new FileReader();
            reader.onload = function (ev) {
                $('#newImagePreview').attr('src', ev.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(file);
        });

        // AJAX submit
        $("#EditAboutForm").on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({

                url: "{{ route('about-page.about-us.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status === 'success') {
                        toastr.success(res.message || 'About updated successfully.');
                    } else {
                        toastr.error(res.message ?? 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        $.each(xhr.responseJSON.errors, function(k, v){
                            toastr.error(v[0]);
                        });
                    } else {
                        toastr.error(xhr.responseJSON?.message || 'An unexpected error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('#btnText').text('UPDATED');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                    setTimeout(() => $('#btnText').text('UPDATE'), 2000);
                }
            });
        });
    });
</script>
@endpush
