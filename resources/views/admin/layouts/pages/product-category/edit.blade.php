@extends('admin.layouts.app')
@section('title', 'Edit Category')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Product Category</h4>

                        <a href="{{ route('product-category.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Categories
                        </a>
                    </div>

                    <div class="body table-responsive">

                        <form id="editCategoryForm" method="POST" enctype="multipart/form-data"
                              action="{{ route('product-category.update', $productCategory->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Category Name --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="category_name">Category Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="category_name" name="category_name"
                                                class="form-control @error('category_name') is-invalid @enderror"
                                                placeholder="Category Name" value="{{ old('category_name', $productCategory->category_name) }}"
                                                required>
                                        </div>
                                        @error('category_name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Image </label>
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

                                        <img id="previewImage"
                                             src="{{ $productCategory->image ? asset($productCategory->image) : '#' }}"
                                             alt="Preview Image"
                                             class="mt-2 border rounded {{ $productCategory->image ? '' : 'd-none' }}" width="120">
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
                                            <option value="1" {{ old('status', $productCategory->status) == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ old('status', $productCategory->status) == 0 ? 'selected' : '' }}>
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
                                        <span id="btnText">UPDATE CATEGORY</span>
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
    </div>
@endsection

@push('scripts')
    <script>
        // Image preview
        (function() {
            const input = document.getElementById('image');
            const preview = document.getElementById('previewImage');
            if (input && preview) {
                input.addEventListener('change', function() {
                    const file = this.files?.[0];
                    if (!file) {
                        preview.src = '#';
                        preview.classList.add('d-none');
                        return;
                    }
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
        $(document).ready(function(){
            $("#editCategoryForm").submit(function(e){
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status === 'success'){
                            toastr.success(response.message);

                            if(response.redirectUrl){
                                setTimeout(function(){
                                    window.location.href = response.redirectUrl;
                                }, 1000);
                            }

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
                        $('#btnText').text('UPDATE CATEGORY');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
