@extends('admin.layouts.app')
@section('title', 'Edit Who We Are')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Who We Are</h4>

                        <a href="{{ route('about-page.who-we-are.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Members
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="EditWhoWeAreForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter full name"
                                                value="{{ old('name', $whoWeAre->name ?? '') }}" required>
                                        </div>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Profession --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="profession">Profession <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="profession" name="profession"
                                                class="form-control @error('profession') is-invalid @enderror"
                                                placeholder="Enter profession"
                                                value="{{ old('profession', $whoWeAre->profession ?? '') }}" required>
                                        </div>
                                        @error('profession')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                rows="4" placeholder="Write a short description...">{{ old('description', $whoWeAre->description ?? '') }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Video URL --}}
                            @php
                                $videoUrl = old('video_url', $whoWeAre->video_url ?? '');
                            @endphp
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="video_url">Video URL</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="url" id="video_url" name="video_url"
                                                class="form-control @error('video_url') is-invalid @enderror"
                                                placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..."
                                                value="{{ $videoUrl }}">
                                        </div>
                                        @error('video_url')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Video Preview --}}
                                        <div id="videoPreviewWrap" class="mt-3 {{ $videoUrl ? '' : 'd-none' }}">
                                            <small class="text-muted d-block mb-2">Video Preview:</small>
                                            <div class="ratio ratio-16x9">
                                                <iframe id="videoPreview" src="" allowfullscreen
                                                    style="width:100%;height:100%;border:0;"></iframe>
                                            </div>
                                        </div>
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
                                                class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        <div>
                                            <small class="text-muted">If no video URL is provided, an image will be used
                                            instead.</small>
                                        </div>

                                        {{-- Current image --}}
                                        @if (!empty($whoWeAre->image))
                                            <div id="currentImageWrap" class="mt-2">
                                                <small class="text-muted d-block mb-1">Current image:</small>
                                                <img id="currentImage" src="{{ asset($whoWeAre->image) }}"
                                                    alt="Profile Image" style="max-height: 100px;">
                                            </div>
                                        @endif

                                        {{-- New image live preview --}}
                                        <img id="previewImg" class="mt-2 d-none" style="max-height: 100px;" />
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

    // ========= Video Preview Helpers ==========
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
        } catch { return ''; }
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

    // ======== INITIAL states ========
    const initialUrl = @json($videoUrl);
    if (initialUrl) {
        const src = buildEmbedSrc(initialUrl);
        if (src) {
            $('#videoPreview').attr('src', src);
            $('#videoPreviewWrap').removeClass('d-none');
        }
    }

    // ======== ALLOW BOTH FIELDS (no exclusivity) ========
    $('#image').on('change', function(e){
        const file = e.target.files[0];
        if (!file) {
            $('#previewImg').addClass('d-none');
            return;
        }
        const reader = new FileReader();
        reader.onload = ev => {
            $('#previewImg').attr('src', ev.target.result).removeClass('d-none');
        };
        reader.readAsDataURL(file);

        $('#currentImageWrap').addClass('d-none');
    });

    $('#video_url').on('input change', function(){
        refreshPreview();
    });

    // ======== AJAX SUBMIT ========
    $("#EditWhoWeAreForm").submit(function(e){
        e.preventDefault();
        const formData = new FormData(this);

        $('#btnText').text('Processing...');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        $.ajax({
            url: "{{ route('about-page.who-we-are.update') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res){
                if(res.status === 'success'){
                    toastr.success(res.message || 'Updated successfully!');

                    // ➜ এই ভার্সনে দুটোই থাকাতে পারবে।
                    // ভিডিও থাকলে প্রিভিউ রিফ্রেশ করব
                    refreshPreview();

                    // ইমেজ আপলোড হয়ে থাকলে কারেন্ট ইমেজ আপডেট দেখাব
                    const hadFile = (this.querySelector('#image')?.files?.length || 0) > 0;
                    if (hadFile) {
                        const src = $('#previewImg').attr('src');
                        if (src) {
                            if ($('#currentImageWrap').length === 0) {
                                const html = `
                                    <div id="currentImageWrap" class="mt-2">
                                        <small class="text-muted d-block mb-1">Current image:</small>
                                        <img id="currentImage" src="${src}" alt="Profile Image" style="max-height: 100px;">
                                    </div>`;
                                $('#image').closest('.form-group').append(html);
                            } else {
                                $('#currentImage').attr('src', src);
                                $('#currentImageWrap').removeClass('d-none');
                            }
                            // প্রিভিউ ইমেজ হাইড করে দিব
                            $('#previewImg').addClass('d-none');
                        }
                    }
                } else {
                    toastr.error(res.message ?? 'Something went wrong!');
                }
            }.bind(this),
            error: function(xhr){
                if(xhr.status === 422 && xhr.responseJSON?.errors){
                    $.each(xhr.responseJSON.errors, function(k,v){
                        toastr.error(v[0]);
                    });
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },
            complete: function(){
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
