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
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="title">Title <strong class="text-danger">*</strong></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter title" value="{{ old('title', $heroSection->title ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="short_description">Short Description <strong
                                        class="text-danger">*</strong></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                            <textarea class="form-control" name="short_description" id="short_description" placeholder="Enter short description">{!! $heroSection->short_description ?? '' !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="hero_image">Image <strong class="text-danger">*</strong></label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="hero_image" class="form-control" name="image"
                                            placeholder="Enter short description">
                                    </div>
                                    @if (!empty($heroSection->image))
                                        <img id="previewImage" src="{{ asset($heroSection->image) }}" alt="Client Image"
                                            class="mt-2 border rounded" width="120">
                                    @else
                                        <img id="previewImage" src="#" alt="Preview Image"
                                            class="mt-2 border rounded d-none" width="120">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_one">Button one </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="button_one" class="form-control" name="button_one"
                                            placeholder="Enter button name" value="{{ old('button_one', $heroSection->button_one ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_one_url">Button one url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="button_one_url" class="form-control" name="button_one_url"
                                            placeholder="Enter button url" value="{{ old('button_one_url', $heroSection->button_one_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_two">Button Two </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="button_two" class="form-control" name="button_two"
                                            placeholder="Enter button name" value="{{ old('button_two', $heroSection->button_two ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_two_url">Button Two Url </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="button_two_url" class="form-control" name="button_two_url"
                                            placeholder="Enter button url" value="{{ old('button_two_url', $heroSection->button_two_url ?? '') }}">
                                    </div>
                                </div>
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

            // Ajax form submit
            $("#heroSectionForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

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
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        $('#btnText').text('Update');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
