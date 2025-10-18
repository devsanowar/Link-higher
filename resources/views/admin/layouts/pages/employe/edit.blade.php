@extends('admin.layouts.app')
@section('title', 'Employes')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                {{-- ============ Card: Edit Employe (same layout style) ============ --}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Edit Employe</h4>
                        <a href="{{ route('employe.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Employe
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="EditEmployeForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="text"
                                                id="name"
                                                name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter full name"
                                                value="{{ old('name', $employe->name ?? '') }}"
                                                required
                                            >
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
                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="text"
                                                id="profession"
                                                name="profession"
                                                class="form-control @error('profession') is-invalid @enderror"
                                                placeholder="Enter profession"
                                                value="{{ old('profession', $employe->profession ?? '') }}"
                                                required
                                            >
                                        </div>
                                        @error('profession')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image --}}
                            @php
                                $existingImage = $employe->image ?? null;
                                $currentSrc = $existingImage
                                    ? (\Illuminate\Support\Str::startsWith($existingImage, ['http://','https://','/storage'])
                                        ? $existingImage
                                        : asset($existingImage))
                                    : asset('backend/assets/images/placeholder-rect.png');
                            @endphp
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Image</label>
                                </div>

                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
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

                                        {{-- Current image preview --}}
                                        <div class="mt-2 {{ $existingImage ? '' : 'd-none' }}" id="currentImageWrap">
                                            <small class="text-muted d-block mb-1">Current Image</small>
                                            <img id="currentImage" src="{{ $currentSrc }}" alt="Current Image" class="border rounded" width="120">
                                        </div>

                                        {{-- New preview (live) --}}
                                        <img id="newImagePreview" class="mt-2 d-none border rounded" style="max-height: 110px;" />

                                        {{-- Hidden (optional mirror to your other pages) --}}
                                        <input type="hidden" id="currentImageInput" name="current_image" value="{{ $existingImage }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="order">Order <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="number"
                                                id="order"
                                                name="order"
                                                class="form-control @error('order') is-invalid @enderror"
                                                placeholder="Enter order number (0, 1, 2...)"
                                                value="{{ old('order', $employe->order ?? '') }}"
                                                required
                                            >
                                        </div>
                                        @error('order')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        @php
                                            $statusVal = old('status', $employe->status ?? 1);
                                        @endphp
                                        <select id="status" name="status" class="form-control show-tick">
                                            <option value="1" {{ (string)$statusVal === '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (string)$statusVal === '0' ? 'selected' : '' }}>Inactive</option>
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
                                    <button type="submit" class="btn btn-primary px-3 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE EMPLOYE</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container -->
@endsection


@push('scripts')
<script>
    $(document).ready(function() {

        // Live preview for new image
        $('#image').on('change', function (e) {
            const file = e.target.files?.[0];
            if (!file) {
                $('#newImagePreview').addClass('d-none');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(ev) {
                $('#newImagePreview').attr('src', ev.target.result).removeClass('d-none');
                $('#currentImageWrap').addClass('d-none');
            };
            reader.readAsDataURL(file);
        });

        // Submit (AJAX)
        $("#EditEmployeForm").on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: "{{ route('employe.update', $employe->id) }}",
                type: "POST", // using method spoofing for PUT
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message || 'Employe updated successfully.');

                        if (response.imageUrl) {
                            const busted = response.imageUrl + '?_=' + Date.now();
                            $('#currentImage').attr('src', busted);
                            $('#currentImageWrap').removeClass('d-none');
                            $('#newImagePreview').addClass('d-none');
                            $('#image').val('');
                            $('#currentImageInput').val(response.imageUrl);
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
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('#btnText').text('UPDATE EMPLOYE');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
    });
</script>
@endpush
