@extends('admin.layouts.app')
@section('title', 'Edit Project')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <style>
        #galleryPreview {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .preview-item {
            position: relative;
        }

        .preview-item img {
            width: 110px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 6px;
            display: block;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 22px;
            height: 22px;
            border: none;
            border-radius: 50%;
            background: rgba(0, 0, 0, .6);
            color: #fff;
            line-height: 22px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
            padding: 0;
        }

        .preview-item .remove-btn:hover {
            background: #dc3545;
        }

        .preview-item .badge-old {
            position: absolute;
            left: 4px;
            bottom: 4px;
            background: #17a2b8;
            color: #fff;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
        }
    </style>
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Project</h4>
                        <a href="{{ route('project.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Project
                        </a>
                    </div>

                    <div class="body table-responsive">

                        @php
                            $featureArray = is_array($project->features)
                                ? $project->features
                                : json_decode($project->features, true) ?? [];
                            $featureArray = array_values(
                                array_filter($featureArray, fn($v) => $v !== null && $v !== ''),
                            );
                            if (empty($featureArray)) {
                                $featureArray = [''];
                            } // at least one field
                            // gallery decode
                            $existingGallery = is_array($project->images)
                                ? $project->images
                                : json_decode($project->images, true) ?? [];
                        @endphp

                        <form id="editProjectForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Category --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="category_id">Category <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="category_id" name="category_id"
                                            class="form-control show-tick @error('category_id') is-invalid @enderror"
                                            required>
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories ?? [] as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ old('category_id', $project->category_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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
                                                placeholder="Enter Title" value="{{ old('title', $project->title) }}"
                                                required>
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
                                                rows="4" placeholder="High-level summary of the project..." required>{{ old('description', $project->description) }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Overview & Challenge --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="overview_challenge">Overview &amp; Challenge</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea id="overview_challenge" name="overview_challenge"
                                                class="form-control @error('overview_challenge') is-invalid @enderror" rows="4"
                                                placeholder="Client background, challenges, goals...">{{ old('overview_challenge', $project->overview_challenge) }}</textarea>
                                        </div>
                                        @error('overview_challenge')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Project Summary --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="project_summary">Project Summary</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea id="project_summary" name="project_summary"
                                                class="form-control @error('project_summary') is-invalid @enderror" rows="4"
                                                placeholder="Scope, timeline, deliverables...">{{ old('project_summary', $project->project_summary) }}</textarea>
                                        </div>
                                        @error('project_summary')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Video Url --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="video_url">Video Url</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="video_url" name="video_url"
                                                class="form-control @error('video_url') is-invalid @enderror"
                                                placeholder="Enter Video Url" value="{{ $project->video_url }}"
                                                required>
                                        </div>
                                        @error('video_url')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Solution & Result --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="solution_result">Solution &amp; Result</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea id="solution_result" name="solution_result"
                                                class="form-control @error('solution_result') is-invalid @enderror" rows="4"
                                                placeholder="Approach, tools, KPIs, outcomes...">{{ old('solution_result', $project->solution_result) }}</textarea>
                                        </div>
                                        @error('solution_result')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Features --}}
                            <div id="featureWrapper">
                                @foreach ($featureArray as $idx => $feat)
                                    <div class="row mb-3 featureRow">
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                            @if ($idx == 0)
                                                <label>Key Features</label>
                                            @endif
                                        </div>
                                        <div class="col-sm-9 d-flex">
                                            <input type="text" class="form-control me-2" name="features[]"
                                                placeholder="Feature {{ $idx + 1 }}" value="{{ $feat }}">
                                            @if ($idx == 0)
                                                <button type="button" class="btn btn-success addFeatureBtn">
                                                    <i class="zmdi zmdi-plus" style="margin-right:0;"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger removeFeatureBtn">
                                                    <i class="zmdi zmdi-delete" style="margin-right:0;"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @error('features')
                                    <div class="row">
                                        <div class="col-sm-9 offset-sm-3"><span
                                                class="text-danger small">{{ $message }}</span></div>
                                    </div>
                                @enderror
                            </div>

                            {{-- Main Image --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Main Image</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                accept="image/*">
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Current main image preview --}}
                                        @if (!empty($project->image))
                                            <div class="mt-2">
                                                <img src="{{ asset($project->image) }}" alt="Current Image"
                                                    class="border rounded" width="140">
                                                <small class="text-muted d-block mt-1">Uploading a new file will replace
                                                    current image.</small>
                                            </div>
                                        @endif

                                        {{-- Live preview for newly chosen main image --}}
                                        <img id="previewImage" src="#" alt="Preview"
                                            class="mt-2 border rounded d-none" width="140">
                                    </div>
                                </div>
                            </div>

                            {{-- Gallery Images (existing + add new) --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="images">Gallery Images</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="images" name="images[]"
                                                class="form-control @error('images') is-invalid @enderror"
                                                accept="image/*" multiple>
                                        </div>
                                        @error('images')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Existing gallery preview with ability to mark delete --}}
                                        <div id="existingGallery" class="d-flex flex-wrap gap-2 mt-2">
                                            @foreach ($existingGallery as $i => $gpath)
                                                <div class="preview-item" data-old-index="{{ $i }}"
                                                    data-old-path="{{ $gpath }}">
                                                    <img src="{{ asset($gpath) }}" alt="Old">
                                                    <button type="button" class="remove-btn remove-old"
                                                        title="Remove">&times;</button>
                                                    <span class="badge-old">Saved</span>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- New selection preview (add/remove before upload) --}}
                                        <div id="galleryPreview" class="d-flex flex-wrap gap-2 mt-2"></div>

                                        <small class="text-muted d-block mt-1">
                                            You can add new images (Ctrl/Shift). Click × to remove existing or new images
                                            from this update.
                                        </small>

                                        {{-- Hidden inputs for old images to remove --}}
                                        <div id="removedOldInputs"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Client Name --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="client_name">Client Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="client_name" name="client_name"
                                                class="form-control @error('client_name') is-invalid @enderror"
                                                placeholder="Enter Client name"
                                                value="{{ old('client_name', $project->client_name) }}" required>
                                        </div>
                                        @error('client_name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Website URL --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="website_url">Website URL <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="website_url" name="website_url"
                                                class="form-control @error('website_url') is-invalid @enderror"
                                                placeholder="Enter Website Url"
                                                value="{{ old('website_url', $project->website_url) }}" required>
                                        </div>
                                        @error('website_url')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Start Date --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="start_date">Project Start Date <strong
                                            class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="start_date" name="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                value="{{ $project->start_date ?? '' }}"
                                                required>
                                        </div>
                                        @error('start_date')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- End Date --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="end_date">Project End Date <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="end_date" name="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                value="{{ $project->end_date ?? '' }}"
                                                required>
                                        </div>
                                        @error('end_date')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
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
                                                {{ old('status', $project->status) == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $project->status) == 0 ? 'selected' : '' }}>Inactive
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
                                        <span id="btnText">UPDATE PROJECT</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- body -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Live preview for replacing main image
        (function() {
            const input = document.getElementById('image');
            const preview = document.getElementById('previewImage');
            if (input && preview) {
                input.addEventListener('change', function() {
                    const file = this.files?.[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = e => {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                });
            }
        })();
    </script>

    <script>
        // Dynamic Features add/remove
        (function() {
            $(document).ready(function() {
                let featureCount = $('#featureWrapper .featureRow').length || 1;

                $(document).on('click', '.addFeatureBtn', function() {
                    featureCount++;
                    const html = `
          <div class="row mb-3 featureRow">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 d-flex">
              <input type="text" class="form-control me-2" name="features[]" placeholder="Feature ${featureCount}">
              <button type="button" class="btn btn-danger removeFeatureBtn">
                <i class="zmdi zmdi-delete" style="margin-right:0;"></i>
              </button>
            </div>
          </div>`;
                    $('#featureWrapper').append(html);
                });

                $(document).on('click', '.removeFeatureBtn', function() {
                    $(this).closest('.featureRow').remove();
                });
            });
        })();
    </script>

    <script>
        // Gallery: existing remove + new selection manage/delete
        (function() {
            const galleryInput = document.getElementById('images');
            const galleryPreview = document.getElementById('galleryPreview'); // for NEW files
            const existingGalleryEl = document.getElementById('existingGallery'); // for OLD files
            const removedOldInputs = document.getElementById('removedOldInputs');

            // NEW files list in memory
            let selectedFiles = [];

            // Add NEW selection
            if (galleryInput && galleryPreview) {
                galleryInput.addEventListener('change', function() {
                    const incoming = Array.from(this.files || []);
                    const key = f => [f.name, f.size, f.lastModified].join('|');
                    const map = new Map(selectedFiles.map(f => [key(f), f]));
                    incoming.forEach(f => map.set(key(f), f));
                    selectedFiles = Array.from(map.values());
                    renderNewPreviews();
                    syncInputFiles();
                });

                galleryPreview.addEventListener('click', function(e) {
                    if (!e.target.classList.contains('remove-btn')) return;
                    const idx = Number(e.target.dataset.index);
                    if (!Number.isInteger(idx)) return;
                    selectedFiles.splice(idx, 1);
                    renderNewPreviews();
                    syncInputFiles();
                });
            }

            function renderNewPreviews() {
                galleryPreview.innerHTML = '';
                selectedFiles.forEach((file, i) => {
                    const wrap = document.createElement('div');
                    wrap.className = 'preview-item';

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.onload = () => URL.revokeObjectURL(img.src);

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'remove-btn';
                    btn.dataset.index = String(i);
                    btn.title = 'Remove';
                    btn.innerHTML = '&times;';

                    wrap.appendChild(img);
                    wrap.appendChild(btn);
                    galleryPreview.appendChild(wrap);
                });
            }

            function syncInputFiles() {
                const dt = new DataTransfer();
                selectedFiles.forEach(f => dt.items.add(f));
                galleryInput.files = dt.files;
            }

            // Remove OLD (already saved) image: add hidden input removed_existing_images[]
            if (existingGalleryEl && removedOldInputs) {
                existingGalleryEl.addEventListener('click', function(e) {
                    if (!e.target.classList.contains('remove-old')) return;
                    const item = e.target.closest('.preview-item');
                    const oldPath = item?.getAttribute('data-old-path');
                    if (!oldPath) return;

                    // Mark hidden input
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'removed_existing_images[]';
                    input.value = oldPath;
                    removedOldInputs.appendChild(input);

                    // Remove from UI
                    item.remove();
                });
            }
        })();
    </script>

    <script>
        // AJAX submit (PUT) with toastr
        $(document).ready(function() {
            $("#editProjectForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('project.update', $project->id) }}",
                    type: "POST", // method spoof
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message ||
                                'Project updated successfully.');

                            if (response.redirect_url) {
                                setTimeout(() => {
                                    window.location.href = response.redirect_url;
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
