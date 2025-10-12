@extends('admin.layouts.app')
@section('title', 'Edit Service')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Service</h4>

                        <a href="{{ route('services.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Services
                        </a>
                    </div>

                    <div class="body table-responsive">
                        <form id="editServiceForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Service Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="service_title">Service Title <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="service_title" name="service_title"
                                                class="form-control @error('service_title') is-invalid @enderror"
                                                placeholder="Service Title"
                                                value="{{ old('service_title', $service->service_title) }}" required>
                                        </div>
                                        @error('service_title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Service Slug --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="service_slug">Service Slug <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="service_slug" name="service_slug"
                                                class="form-control @error('service_slug') is-invalid @enderror"
                                                placeholder="premium-seo-audit"
                                                value="{{ old('service_slug', $service->service_slug) }}" required>
                                        </div>
                                        @error('service_slug')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Short Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="service_short_description">Short Description <strong
                                            class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea id="service_short_description" name="service_short_description"
                                                class="form-control @error('service_short_description') is-invalid @enderror" rows="3"
                                                placeholder="A concise 1–2 sentence summary..." required>{{ old('service_short_description', $service->service_short_description) }}</textarea>
                                        </div>
                                        @error('service_short_description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Long Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="service_long_description">Long Description <strong
                                            class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea id="service_long_description" name="service_long_description"
                                                class="form-control @error('service_long_description') is-invalid @enderror" rows="6"
                                                placeholder="Full details, inclusions, process, FAQs..." required>{{ old('service_long_description', $service->service_long_description) }}</textarea>
                                        </div>
                                        @error('service_long_description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Service Features --}}
                            @php
                                // Expecting array/JSON in DB. Fallback to [] if null.
                                $features = old(
                                    'service_features',
                                    is_array($service->service_features ?? null)
                                        ? $service->service_features
                                        : (filled($service->service_features)
                                            ? json_decode($service->service_features, true)
                                            : []),
                                );
                                if (!is_array($features)) {
                                    $features = [];
                                }
                            @endphp

                            <div id="featureWrapper">
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Features</label>
                                    </div>
                                    <div class="col-sm-9"></div>
                                </div>

                                @if (count($features))
                                    @foreach ($features as $idx => $feature)
                                        <div class="row mb-3 featureRow">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 d-flex">
                                                <input type="text" class="form-control me-2" name="service_features[]"
                                                    value="{{ $feature }}" placeholder="Feature {{ $idx + 1 }}">
                                                <button type="button" class="btn btn-danger removeFeatureBtn">
                                                    <i class='zmdi zmdi-delete' style="margin-right:0px"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row mb-3 featureRow">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 d-flex">
                                            <input type="text" class="form-control me-2" name="service_features[]"
                                                placeholder="Feature 1">
                                            <button type="button" class="btn btn-success addFeatureBtn">
                                                <i class='zmdi zmdi-plus' style="margin-right:0px"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                {{-- Add button row --}}
                                <div class="row mb-3">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-success addFeatureBtn">
                                            <i class='zmdi zmdi-plus' style="margin-right:0px"></i> Add Feature
                                        </button>
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
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Current image preview --}}
                                        @php
                                            // Adjust pathing to your storage. Example tries Storage URL first, then asset.
                                            $existingImage = $service->image ?? null;
                                        @endphp

                                        @if ($existingImage)
                                            <div class="mt-2">
                                                <small class="text-muted d-block mb-1">Current Image</small>
                                                <img src="{{ \Illuminate\Support\Str::startsWith($existingImage, ['http://', 'https://', '/storage']) ? $existingImage : asset($existingImage) }}"
                                                    alt="Current Image" class="border rounded" width="120">
                                            </div>
                                            <input type="hidden" name="current_image" value="{{ $existingImage }}">
                                        @endif
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
                                            <option value="1"
                                                {{ old('status', $service->status) == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $service->status) == 0 ? 'selected' : '' }}>Inactive
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
                                        <span id="btnText">UPDATE SERVICE</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
@endsection

@push('scripts')
    {{-- Dynamic Features --}}
    <script>
        $(document).ready(function() {
            // Start from the count already rendered (server-side)
            let featureCount = $('#featureWrapper .featureRow input[name="service_features[]"]').length || 1;

            // Add new feature input
            $(document).on('click', '.addFeatureBtn', function() {
                featureCount++;
                let html = `
                    <div class="row mb-3 featureRow">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 d-flex">
                            <input type="text" class="form-control me-2" name="service_features[]" placeholder="Feature ${featureCount}">
                            <button type="button" class="btn btn-danger removeFeatureBtn"><i class='zmdi zmdi-delete' style="margin-right:0px"></i></button>
                        </div>
                    </div>`;
                $('#featureWrapper').append(html);
            });

            // Remove dynamically added feature input
            $(document).on('click', '.removeFeatureBtn', function() {
                $(this).closest('.featureRow').remove();
            });
        });
    </script>

    {{-- AJAX Update --}}
    <script>
        $(document).ready(function() {
            $("#editServiceForm").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                // Ensure method spoofing present (in case)
                if (!formData.has('_method')) formData.append('_method', 'PUT');

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('services.update', $service->id) }}",
                    type: "POST", // using POST with _method=PUT
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message ?? 'Service updated successfully.');
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                        } else {
                            toastr.error(response.message ?? 'Something went wrong!');
                        }

                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        $('#btnText').text('UPDATED');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
