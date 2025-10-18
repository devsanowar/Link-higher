@extends('admin.layouts.app')
@section('title', 'Edit Customer Focus Tone')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Customer Focus Tone</h4>
                    </div>

                    <div class="card-body">
                        <form id="EditCustomerFocusToneForm" method="POST">
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
                                                placeholder="Enter title"
                                                value="{{ old('title', $customerFocusTone->title ?? '') }}" required>
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
                                    <label for="description">Short Description</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{!! $customerFocusTone->description ?? '' !!}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Video URL --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="video_url">Video URL</label>
                                </div>
                                @php
                                    $videoUrl = old('video_url', $customerFocusTone->video_url ?? '');
                                @endphp

                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="url" id="video_url" name="video_url"
                                                class="form-control @error('video_url') is-invalid @enderror"
                                                placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..."
                                                value="{{ old('video_url', $video_url ?? '') }}">
                                        </div>
                                        @error('video_url')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Live Preview --}}
                                        <div id="videoPreviewWrap" class="mt-3 {{ $videoUrl ? '' : 'd-none' }}">
                                            <small class="text-muted d-block mb-2">Video preview:</small>
                                            <div class="ratio ratio-16x9">
                                                <iframe id="videoPreview" src="" allowfullscreen
                                                    style="width:100%;height:100%;border:0;"></iframe>
                                            </div>
                                        </div>
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
        function buildEmbedSrc(url) {
            if (!url) return '';
            try {
                const u = new URL(url);
                const host = u.hostname.replace('www.', '');

                if (host.includes('youtube.com')) {
                    const v = u.searchParams.get('v');
                    if (v) return 'https://www.youtube.com/embed/' + v;
                    if (u.pathname.startsWith('/embed/')) return url;
                }
                if (host === 'youtu.be') {
                    const id = u.pathname.replace('/', '');
                    if (id) return 'https://www.youtube.com/embed/' + id;
                }
                if (host.includes('vimeo.com')) {
                    const id = u.pathname.split('/').filter(Boolean).pop();
                    if (id) return 'https://player.vimeo.com/video/' + id;
                }
                return '';
            } catch (e) {
                return '';
            }
        }

        function refreshPreview() {
            const val = $('#video_url').val().trim();
            const src = buildEmbedSrc(val);
            if (src) {
                $('#videoPreview').attr('src', src);
                $('#videoPreviewWrap').removeClass('d-none');
            } else {
                $('#videoPreview').attr('src', '');
                $('#videoPreviewWrap').addClass('d-none');
            }
        }

        $(document).ready(function() {
            // initial value from server (safe for both create & edit)
            const initialUrl = @json($videoUrl);
            if (initialUrl) {
                const src = buildEmbedSrc(initialUrl);
                if (src) {
                    $('#videoPreview').attr('src', src);
                    $('#videoPreviewWrap').removeClass('d-none');
                }
            }

            // live update
            $('#video_url').on('input change', refreshPreview);
        });

        $(document).ready(function() {
            // Initial preview from existing value
            refreshPreview();

            // Live preview on change
            $('#video_url').on('input change', refreshPreview);

            // Submit (AJAX)
            $("#EditCustomerFocusToneForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                   url: "{{ route('home.customer-focus-tone.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'Updated successfully.');
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
                        $('#btnText').text('UPDATED');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);

                        // 3s পরে আবার আগের বাটন টেক্সট
                        setTimeout(function() {
                            $('#btnText').text('UPDATE');
                        }, 3000);
                    }
                });
            });
        });
    </script>
@endpush
