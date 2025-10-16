@extends('admin.layouts.app')
@section('title', 'Edit Goal Progress')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Goal Progress</h4>

                        <a href="{{ route('home.goal-progress-insight.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Goals
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="EditGoalProgressForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Method spoofing for PUT --}}
                            <input type="hidden" name="_method" value="PUT">

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
                                                placeholder="Enter goal title"
                                                value="{{ old('title', $goal->title ?? '') }}"
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
                                                rows="5"
                                                placeholder="Describe this goal..."
                                                required
                                            >{{ old('description', $goal->description ?? '') }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image (optional in edit) --}}
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
                                                accept="image/*"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Preview Image --}}
                                        <div class="mt-3">
                                            @php
                                                $existingImage = !empty($goal->image) ? asset($goal->image) : '#';
                                                $hasImage = !empty($goal->image);
                                            @endphp
                                            <img
                                                id="imagePreview"
                                                src="{{ $hasImage ? $existingImage : '#' }}"
                                                alt="Preview"
                                                class="img-fluid rounded shadow-sm {{ $hasImage ? '' : 'd-none' }}"
                                                style="max-width: 200px; border:1px solid #ddd; padding:4px;"
                                            >
                                        </div>

                                        <small class="text-muted d-block mt-2">
                                            Allowed: JPG, PNG, WebP • Suggestion: &lt;1MB
                                        </small>
                                    </div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="status" name="status" class="form-control show-tick">
                                            @php $currentStatus = old('status', $goal->status ?? 1); @endphp
                                            <option value="1" {{ $currentStatus == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $currentStatus == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE GOAL</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // ------- Image Live Preview -------
        $('#image').on('change', function (event) {
            const input = event.target;
            const preview = $('#imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.attr('src', e.target.result)
                           .removeClass('d-none')
                           .hide()
                           .fadeIn(300);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        // ------- Submit (AJAX PUT via method spoofing) -------
        $("#EditGoalProgressForm").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
        @php
            $updateUrl = route('home.goal-progress-insight.update', $goal->id);
        @endphp

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: "{{ $updateUrl }}",
                type: "POST", // keep POST; method spoofing sends PUT
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message || 'Goal updated successfully.');
                        if (response.redirect) {
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 800);
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
                    $('#btnText').text('UPDATE GOAL');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
    });
</script>
@endpush
