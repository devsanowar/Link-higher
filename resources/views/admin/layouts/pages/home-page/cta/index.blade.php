@extends('admin.layouts.app')
@section('title', 'Create CTA')

@section('admin_content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Update CTA</h4>

                </div>

                <div class="body">
                    <form id="editCtaForm" method="POST" class="form_label">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">
                            <div class="col-lg-2 form-control-label"><label>Title</label></div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="title" class="form-control" placeholder="Enter CTA title" value="{{ $cta->title ?? '' }}">
                                    </div>
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 form-control-label"><label>Content</label></div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                   <div class="form-line">
                                     <textarea name="description" rows="4" class="form-control" placeholder="Enter CTA content (HTML allowed)">{!! $cta->description ?? '' !!}</textarea>
                                   </div>
                                </div>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 form-control-label"><label>Button One</label></div>
                            <div class="col-lg-5">
                                <input type="text" name="button_one_name" class="form-control mb-2"
                                    value="{{ $cta->button_one_name ?? '' }}" placeholder="Button text e.g., Get Started">
                                @error('button_one_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-5">
                                <input type="text" name="button_one_url" class="form-control mb-2"
                                    value="{{ $cta->button_one_url ?? '' }}" placeholder="https://...">
                                @error('button_one_url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 form-control-label"><label>Button Two</label></div>
                            <div class="col-lg-5">
                                <input type="text" name="button_two_name" class="form-control mb-2"
                                    value="{{ $cta->button_two_name ?? '' }}" placeholder="Button text e.g., Learn More">
                                @error('button_two_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-5">
                                <input type="text" name="button_two_url" class="form-control mb-2"
                                    value="{{ $cta->button_two_url ?? '' }}" placeholder="https://...">
                                @error('button_two_url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row clearfix">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-3 rounded-0" id="submitBtn">
                                    <span id="btnText">UPDATE CTA</span>
                                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $("#editCtaForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('home.cta.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'cta updated successfully.');
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
                    }
                });
            });
        });
    </script>
@endpush
