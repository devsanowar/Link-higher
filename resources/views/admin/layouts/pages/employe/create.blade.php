@extends('admin.layouts.app')
@section('title', 'Employes')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                {{-- ============ Card#1: Create Employe (same layout style) ============ --}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Create Employe</h4>
                        <a href="{{ route('employe.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i>
                            </i> All Employe
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="CreateEmployeForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter full name" required>
                                        </div>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="profession">Profession <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="profession" name="profession"
                                                class="form-control @error('profession') is-invalid @enderror"
                                                placeholder="Enter profession" required>
                                        </div>
                                        @error('profession')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- Image (same style as your workflow image section) --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Image</label>
                                </div>

                                <div class="col-lg-9 col-md-7 col-sm-6 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

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
                                            <input type="number" id="order" name="order"
                                                class="form-control @error('order') is-invalid @enderror"
                                                placeholder="Enter order number (0, 1, 2...)" required>
                                        </div>
                                        @error('order')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
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
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
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
                                            <span id="btnText">CREATE EMPLOYE</span>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $("#CreateEmployeForm").on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('employe.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'Employe created successfully.');
                            $("#CreateEmployeForm")[0].reset();
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
                        $('#btnText').text('CREATED');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                        setTimeout(() => $('#btnText').text('CREATE EMPLOYE'), 2000);
                    }
                });
            });
        });
    </script>
@endpush
