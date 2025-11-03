@extends('admin.layouts.app')
@section('title', 'Create Product')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Add Product</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Products
                        </a>
                    </div>

                    <div class="body table-responsive">

                        <form id="addProductForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Product category --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="product_name">Category<strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="product_category_id" name="product_category_id"
                                            class="form-control show-tick @error('product_category_id') is-invalid @enderror"
                                            required>
                                            <option value="" disabled selected>-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_category_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Product Name --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="product_name">Product Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="product_name" name="product_name"
                                                class="form-control @error('product_name') is-invalid @enderror"
                                                placeholder="Product Name" value="{{ old('product_name') }}" required>
                                        </div>
                                        @error('product_name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- Website URL --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="website_url">Website URL</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="url" id="website_url" name="website_url"
                                                class="form-control @error('website_url') is-invalid @enderror"
                                                placeholder="https://example.com" value="{{ old('website_url') }}">
                                        </div>
                                        @error('website_url')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="price">Price ($)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" step="0.01" id="price" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="100.00" value="{{ old('price') }}">
                                        </div>
                                        @error('price')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- SEO Info: Ahrefs DR, Moz DA, Traffic, Target Country --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="ahrefs_dr">Ahrefs DR</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7">
                                    <input type="number" id="ahrefs_dr" name="ahrefs_dr" class="form-control"
                                        placeholder="26" value="{{ old('ahrefs_dr') }}">
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="moz_da">Moz DA</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7">
                                    <input type="number" id="moz_da" name="moz_da" class="form-control"
                                        placeholder="25" value="{{ old('moz_da') }}">
                                </div>
                            </div>


                            <div class="row clearfix mt-2">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="traffic">Traffic</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7">
                                    <input type="number" id="traffic" name="traffic" class="form-control"
                                        placeholder="8000" value="{{ old('traffic') }}">
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="moz_pa">Moz PA</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-7">
                                    <input type="number" id="moz_pa" name="moz_pa" class="form-control"
                                        placeholder="30" value="{{ old('moz_pa') }}">
                                </div>


                            </div>

                            {{-- Price --}}
                            <div class="row clearfix mt-2">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="target_country">Target Country</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="target_country" name="target_country"
                                                class="form-control" placeholder="United States"
                                                value="{{ old('target_country') }}">
                                        </div>
                                        @error('target_country')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Product Description --}}
                            <div class="row clearfix mt-3">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="description">Product Description</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div style="border: 1px solid #ccc">
                                            <textarea name="product_description" id="description" rows="4" class="form-control" style="padding: 5px 10px"
                                                placeholder="Write product description...">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Product Image</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <input style="border: 1px solid #ccc; padding-left: 10px;" type="file"
                                            id="image" name="image"
                                            class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        <img id="previewImage" src="#" alt="Preview Image"
                                            class="mt-2 border rounded d-none" width="120">
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- News --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="news">News</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="news" name="news" class="form-control show-tick">
                                            <option value="1" {{ old('news', 1) == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ old('news', 1) == 0 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
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
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            {{-- Submit --}}
                            <div class="row clearfix mt-3">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">CREATE PRODUCT</span>
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

        $(document).ready(function() {
            $("#addProductForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('products.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            $("#addProductForm")[0].reset();
                            $('#previewImage').attr('src', '#').addClass('d-none');
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message ?? 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        $('#btnText').text('CREATE PRODUCT');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
