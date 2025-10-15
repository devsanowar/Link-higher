@extends('admin.layouts.app')
@section('title', 'Edit Smart Strategy')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Smart Strategy</h4>

                    </div>

                    <div class="card-body">
                        <form id="editStrategyForm" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" id="title" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Strategy title" value="{{ old('title', $strategy->title ?? '') }}"
                                                required>
                                        </div>
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Subtitle --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="subtitle">Subtitle <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="subtitle" name="subtitle"
                                                class="form-control @error('subtitle') is-invalid @enderror"
                                                placeholder="Short sub heading"
                                                value="{{ old('subtitle', $strategy->subtitle ?? '') }}" required>
                                        </div>
                                        @error('subtitle')
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
                                                rows="6" placeholder="Full description..." required>{!! old('description', $strategy->description ?? '') !!}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- Feature Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="feature_title">Feature Title <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="feature_title" name="feature_title"
                                                class="form-control @error('feature_title') is-invalid @enderror"
                                                placeholder="e.g., What you get"
                                                value="{{ old('feature_title', $strategy->feature_title ?? '') }}" required>
                                        </div>
                                        @error('feature_title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            {{-- Features (dynamic list) --}}
                            @php
                                $featuresRaw = old('features', $strategy->features ?? '');
                                $featuresArr = [];
                                if (filled($featuresRaw)) {
                                    $decoded = json_decode($featuresRaw, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $featuresArr = $decoded;
                                    } else {
                                        $featuresArr = preg_split('/\r\n|\r|\n|,/', $featuresRaw);
                                    }
                                    $featuresArr = array_values(array_filter(array_map('trim', $featuresArr)));
                                }
                                if (empty($featuresArr)) {
                                    $featuresArr = [''];
                                }
                            @endphp

                            <div id="featureWrapper">
                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Features</label>
                                    </div>
                                    <div class="col-sm-9"></div>
                                </div>

                                @foreach ($featuresArr as $idx => $f)
                                    <div class="row mb-3 featureRow">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 d-flex">
                                            <input type="text" class="form-control me-2" name="features[]"
                                                value="{{ $f }}" placeholder="Feature {{ $idx + 1 }}">
                                            <button type="button"
                                                class="btn btn-{{ $idx === 0 ? 'success addFeatureBtn' : 'danger removeFeatureBtn' }}">
                                                <i class='zmdi zmdi-{{ $idx === 0 ? 'plus' : 'delete' }}'
                                                    style="margin-right:0px"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

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
                                        <small class="text-muted">PNG/JPG/WEBP, max 2MB</small>
                                        @error('image')
                                            <span class="text-danger small d-block">{{ $message }}</span>
                                        @enderror>

                                        @php
                                            $existingImage = $strategy->image ?? null;
                                            $imgSrc = $existingImage
                                                ? (\Illuminate\Support\Str::startsWith($existingImage, [
                                                    'http://',
                                                    'https://',
                                                    '/storage',
                                                ])
                                                    ? $existingImage
                                                    : asset($existingImage))
                                                : null;
                                        @endphp

                                        @if ($imgSrc)
                                            <div class="mt-2">
                                                <small class="text-muted d-block mb-1">Current Image</small>
                                                <img id="currentImage" src="{{ $imgSrc }}" alt="Current Image"
                                                    class="border rounded" width="120">
                                            </div>
                                            <input type="hidden" name="current_image" value="{{ $existingImage }}">
                                        @else
                                            <img id="currentImage"
                                                src="{{ asset('backend/assets/images/placeholder-rect.png') }}"
                                                alt="Preview" class="border rounded" width="120"
                                                style="display:none">
                                        @endif

                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE STRATEGY</span>
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
        $(document).on('change', '#image', function() {
            const file = this.files?.[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#currentImage').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        });
    </script>

    <script>
        $(document).ready(function() {
            let featureCount = $('#featureWrapper .featureRow input[name="features[]"]').length || 1;

            $(document).on('click', '.addFeatureBtn', function() {
                featureCount++;
                let html = `
                    <div class="row mb-3 featureRow">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 d-flex">
                            <input type="text" class="form-control me-2" name="features[]" placeholder="Feature ${featureCount}">
                            <button type="button" class="btn btn-danger removeFeatureBtn">
                                <i class='zmdi zmdi-delete' style="margin-right:0px"></i>
                            </button>
                        </div>
                    </div>`;
                $('#featureWrapper').append(html);
            });

            $(document).on('click', '.removeFeatureBtn', function() {
                $(this).closest('.featureRow').remove();
            });
        });
    </script>

    {{-- AJAX Update --}}
    <script>
        $(document).ready(function() {
            $("#editStrategyForm").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                if (!formData.has('_method')) formData.append('_method', 'PUT');

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('home.smart-strategy.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message ??
                            'Strategy updated successfully.');

                            if (response.image_url) {
                                const bust = Date.now();
                                $('#currentImage').attr('src', response.image_url + '?_=' +
                                    bust).show();
                                $('input[name="current_image"]').val(response
                                .image_url);
                            }

                            if (response.redirect) {
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 800);
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
