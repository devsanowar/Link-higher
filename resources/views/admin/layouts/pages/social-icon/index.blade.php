@extends('admin.layouts.app')
@section('title', 'Social Icon Page')
@section('admin_content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4> Social Icon </h4>
                </div>
                <div class="body">
                    <form id="socialIconForm" class="form_label" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="facebook_url">Facebook Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="facebook_url" class="form-control" name="facebook_url"
                                            placeholder="Enter facebook url"
                                            value="{{ old('facebook_url', $social->facebook_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="linkedin_url">Linkedin Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="linkedin_url" class="form-control" name="linkedin_url"
                                            placeholder="Enter linkedin url"
                                            value="{{ old('linkedin_url', $social->linkedin_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="instagram_url">Instagram Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="instagram_url" class="form-control" name="instagram_url"
                                            placeholder="Enter Instagram url"
                                            value="{{ old('instagram_url', $social->instagram_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="twitter_url">Twitter Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="twitter_url" class="form-control" name="twitter_url"
                                            placeholder="Enter Twitter url"
                                            value="{{ old('twitter_url', $social->twitter_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="pinterest_url">Pinterest Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="pinterest_url" class="form-control" name="pinterest_url"
                                            placeholder="Enter Pinterest url"
                                            value="{{ old('pinterest_url', $social->pinterest_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="youtube_url">Youtube Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="youtube_url" class="form-control" name="youtube_url"
                                            placeholder="Enter Youtube url"
                                            value="{{ old('youtube_url', $social->youtube_url ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="google_plus_url">Google Plus Url</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="google_plus_url" class="form-control"
                                            name="google_plus_url" placeholder="Enter Youtube url"
                                            value="{{ old('google_plus_url', $social->google_plus_url ?? '') }}">
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
            $('#socialIconForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();

                $('#submitBtn').prop('disabled', true);
                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('social.icon.update') }}",
                    method: "POST",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#submitBtn').prop('disabled', false);
                        $('#btnText').text('UPDATE');
                        $('#btnSpinner').addClass('d-none');
                        toastr.success(response.message || 'Social icons updated successfully');
                    },
                    error: function(xhr) {
                        $('#submitBtn').prop('disabled', false);
                        $('#btnText').text('UPDATE');
                        $('#btnSpinner').addClass('d-none');

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(_, messages) {
                                toastr.error(messages[0]);
                            });
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                        }
                    }
                });
            });
        });
    </script>
@endpush
