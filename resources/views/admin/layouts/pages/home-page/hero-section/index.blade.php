@extends('admin.layouts.app')
@section('title', 'Hero Section')
@section('admin_content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4> Hero Section Content</h4>
                </div>
                <div class="body">
                    <form id="heroSectionForm" class="form_label" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Title --}}
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Title <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="form-line">

                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title', $heroSection->title ?? '') }}"
                                        placeholder="Enter hero title">
                                </div>
                                <span class="text-danger error-text title_error"></span>
                            </div>
                        </div>

                        {{-- Short Description --}}
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Short Description <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <textarea name="short_description" class="form-control" rows="3" placeholder="Enter short description">{!! $heroSection->short_description ?? '' !!}</textarea>
                                </div>
                                <span class="text-danger error-text short_description_error"></span>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Hero Image <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <span class="text-danger error-text image_error"></span>
                                <div class="mt-2">
                                    @if (!empty($heroSection->image))
                                        <img id="previewImage" src="{{ asset($heroSection->image) }}" class="border rounded"
                                            width="150">
                                    @else
                                        <img id="previewImage" src="#" class="border rounded d-none" width="150">
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Button One --}}
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Button One</label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <input type="text" name="button_one" class="form-control"
                                        placeholder="Enter button 1 text"
                                        value="{{ old('button_one', $heroSection->button_one ?? '') }}">
                                </div>
                                <span class="text-danger error-text button_one_error"></span>
                            </div>
                        </div>

                        {{-- Button One URL --}}
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Button One URL</label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <input type="text" name="button_one_url" class="form-control"
                                        placeholder="Enter button 1 URL"
                                        value="{{ old('button_one_url', $heroSection->button_one_url ?? '') }}">
                                </div>
                                <span class="text-danger error-text button_one_url_error"></span>
                            </div>
                        </div>

                        {{-- Button Two --}}
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label">Button Two</label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <input type="text" name="button_two" class="form-control"
                                        placeholder="Enter button 2 text"
                                        value="{{ old('button_two', $heroSection->button_two ?? '') }}">
                                </div>

                                <span class="text-danger error-text button_two_error"></span>
                            </div>
                        </div>

                        {{-- Button Two URL --}}
                        <div class="form-group row mb-4">
                            <label class="col-md-3 col-form-label">Button Two URL</label>
                            <div class="col-md-9">
                                <div class="form-line">
                                    <input type="text" name="button_two_url" class="form-control"
                                        placeholder="Enter button 2 URL"
                                        value="{{ old('button_two_url', $heroSection->button_two_url ?? '') }}">
                                </div>

                                <span class="text-danger error-text button_two_url_error"></span>
                            </div>
                        </div>



                        <!-- Update Settings Button -->
                        <div class="row clearfix">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button id="submitBtn" type="submit"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect">
                                    <span id="btnSpinner" class="d-none spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    <span id="btnText">UPDATE</span>
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
            // Image preview
            $('input[name="image"]').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImage').attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            });

            $("#heroSectionForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                // Clear previous error messages
                $('.error-text').text('');

                $.ajax({
                    url: "{{ route('home.hero.section.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            if (response.image) {
                                $('#previewImage').attr('src', response.image);
                            }
                        } else {
                            toastr.error(response.message ?? 'Something went wrong!');
                        }
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Show validation errors under each input
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });
                        } else {
                            toastr.error("An unexpected error occurred.");
                        }
                    },

                    complete: function() {
                        $('#btnText').text('UPDATE');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
