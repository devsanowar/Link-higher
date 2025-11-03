@extends('admin.layouts.app')
@section('title', 'Services')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Add Service</h4>

                        <a href="{{ route('services.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i>
                            </i> All Services
                        </a>
                    </div>


                    <div class="body table-responsive">

                        <form id="addServiceForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Service Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="service_category_id">Service Category <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                            <select name="service_category_id" id="service_category_id" class="form-control show-tick">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>

                                        @error('service_category_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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
                                                placeholder="Service Title" value="{{ old('service_title') }}"
                                                required>
                                        </div>
                                        @error('service_title')
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
                                                placeholder="A concise 1–2 sentence summary..." required>{{ old('service_short_description') }}</textarea>
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
                                                placeholder="Full details, inclusions, process, FAQs..." required>{{ old('service_long_description') }}</textarea>
                                        </div>
                                        @error('service_long_description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Service Features --}}

                            <div id="featureWrapper">
                                <div class="row mb-3 featureRow">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label for="image">Features</label>
                                    </div>
                                    <div class="col-sm-9 d-flex">
                                        <input type="text" class="form-control me-2" name="service_features[]"
                                            placeholder="Feature 1">
                                        <button type="button" class="btn btn-success addFeatureBtn"><i
                                                class='zmdi zmdi-plus' style="margin-right: 0px;"></i> </button>
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
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror" required>
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        <img id="previewImage" src="#" alt="Preview Image"
                                            class="mt-2 border rounded d-none" width="120">
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
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>
                                                Inactive</option>
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
                                        <span id="btnText">CREATE SERVICE</span>
                                        <span id="btnSpinner"
                                            class="spinner-border spinner-border-sm d-none ms-2"></span>
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
    <script>
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
        $(document).ready(function() {
            let featureCount = 1;

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
        </div>
        `;
                $('#featureWrapper').append(html);
            });

            // Remove dynamically added feature input
            $(document).on('click', '.removeFeatureBtn', function() {
                $(this).closest('.featureRow').remove();
            });
        });
    </script>


<script>
    $(document).ready(function(){
    $("#addServiceForm").submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);

        $('#btnText').text('Processing...');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        $.ajax({
            url: "{{ route('services.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                $("#addServiceForm")[0].reset();
                if(response.status === 'success'){
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message ?? 'Something went wrong!');
                }
            },
            error: function(xhr){
                if(xhr.status === 422){
                    $.each(xhr.responseJSON.errors, function(key, value){
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },
            complete: function(){
                $('#btnText').text('SERVICE CREATED');
                $('#btnSpinner').addClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });
    });
});
</script>

@endpush
