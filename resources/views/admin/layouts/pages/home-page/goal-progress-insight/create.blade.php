@extends('admin.layouts.app')
@section('title', 'Create Goal Progress')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Add Goal Progress</h4>

                        <a href="{{ route('home.goal-progress-insight.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Goals
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="AddGoalProgressForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="title">Title <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="title" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter goal title" value="{{ old('title') }}" required>
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
                                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                                rows="5" placeholder="Describe this goal..." required>{{ old('description') }}</textarea>
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
                                    <label for="image">Image <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image" name="image" accept="image/*"
                                                class="form-control @error('image') is-invalid @enderror" required>
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Preview Image --}}
                                        <div class="mt-3">
                                            <img id="imagePreview" src="#" alt="Preview"
                                                class="img-fluid rounded shadow-sm d-none"
                                                style="max-width: 200px; border:1px solid #ddd; padding:4px;">
                                        </div>

                                        <small class="text-muted d-block mt-2">
                                            Allowed: JPG, PNG, WebP • Suggestion: &lt;1MB
                                        </small>
                                    </div>
                                </div>
                            </div>


                            {{-- Status (default 1 per schema) --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="status" name="status" class="form-control show-tick">
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive
                                            </option>
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
                                        <span id="btnText">CREATE GOAL</span>
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
        // image preview
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
            } else {
                preview.addClass('d-none').attr('src', '#');
            }
        });
    });
</script>

    <script>
    $(document).ready(function() {

        // 🔹 Image Preview Logic
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
            } else {
                preview.addClass('d-none').attr('src', '#');
            }
        });

        // 🔹 Form Submit
        $("#AddGoalProgressForm").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: "{{ route('home.goal-progress-insight.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message || 'Goal created successfully.');

                        // ✅ Reset form
                        $("#AddGoalProgressForm")[0].reset();

                        // ✅ Reset image preview
                        $('#imagePreview')
                            .attr('src', '#')
                            .addClass('d-none');
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
                    $('#btnText').text('CREATE GOAL');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
    });
</script>

@endpush
