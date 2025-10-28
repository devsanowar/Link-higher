@extends('admin.layouts.app')
@section('title', 'Website Settings')
@section('admin_content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4> Website Settings </h4>
                </div>
                <div class="body">
                    <form id="websiteSettingForm" class="form_label" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Website Title --}}
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="website_title">Website Title</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="website_title" class="form-control" name="website_title"
                                            placeholder="Enter website title"
                                            value="{{ old('website_title', $settings->website_title ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Website Tagline --}}
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="website_tag_title">Website Tagline</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="website_tag_title" class="form-control"
                                            name="website_tag_title" placeholder="Enter website tagline"
                                            value="{{ old('website_tag_title', $settings->website_tag_title ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Website Logo --}}
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="website_logo">Website Logo</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="website_logo" class="form-control" name="website_logo"
                                            accept=".jpg,.jpeg,.png,.gif"
                                            onchange="previewImage(event, 'website_logo_preview')">
                                        <input type="hidden" name="remove_website_logo" id="remove_website_logo"
                                            value="0">
                                    </div>
                                </div>

                                <div id="website_logo_preview" class="image-preview"
                                    style="display: {{ !empty($settings->website_logo) ? 'block' : 'none' }};">
                                    <img id="website_logo_img"
                                        src="{{ !empty($settings->website_logo) ? asset($settings->website_logo) : '' }}"
                                        alt="Logo Preview" style="max-width:100px; max-height:100px;">
                                    <button type="button" class="remove-preview"
                                        onclick="removeImage('website_logo','website_logo_preview')">X</button>
                                </div>
                            </div>
                        </div>

                        {{-- Website Favicon --}}
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="website_favicon">Website Favicon</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="website_favicon" class="form-control"
                                            name="website_favicon" accept=".jpg,.jpeg,.png,.gif"
                                            onchange="previewImage(event, 'website_favicon_preview')">
                                        <input type="hidden" name="remove_website_favicon" id="remove_website_favicon"
                                            value="0">

                                    </div>
                                </div>

                                <div id="website_favicon_preview" class="image-preview"
                                    style="display: {{ !empty($settings->website_favicon) ? 'block' : 'none' }};">
                                    <img id="website_favicon_img"
                                        src="{{ !empty($settings->website_favicon) ? asset($settings->website_favicon) : '' }}"
                                        alt="Favicon Preview" style="max-width:50px; max-height:50px;">
                                    <button type="button" class="remove-preview"
                                        onclick="removeImage('website_favicon','website_favicon_preview')">X</button>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Logo --}}
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="website_footer_logo">Footer Logo</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="website_footer_logo" class="form-control"
                                            name="website_footer_logo" accept=".jpg,.jpeg,.png,.gif"
                                            onchange="previewImage(event, 'website_footer_logo_preview')">
                                        <input type="hidden" name="remove_website_footer_logo"
                                            id="remove_website_footer_logo" value="0">

                                    </div>
                                </div>

                                <div id="website_footer_logo_preview" class="image-preview"
                                    style="display: {{ !empty($settings->website_footer_logo) ? 'block' : 'none' }};">
                                    <img id="website_footer_logo_img"
                                        src="{{ !empty($settings->website_footer_logo) ? asset($settings->website_footer_logo) : '' }}"
                                        alt="Footer Logo Preview" style="max-width:100px; max-height:100px;">
                                    <button type="button" class="remove-preview"
                                        onclick="removeImage('website_footer_logo','website_footer_logo_preview')">X</button>
                                </div>
                            </div>
                        </div>


                        <!-- Phone One -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="phone_one">Phone One</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone_one" class="form-control" name="phone_one"
                                            placeholder="Enter primary phone number"
                                            value="{{ old('phone_one', $settings->phone_one ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Two -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="phone_two">Phone Two</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone_two" class="form-control" name="phone_two"
                                            placeholder="Enter secondary phone number"
                                            value="{{ old('phone_two', $settings->phone_two ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email One -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_one">Email One</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="email_one" class="form-control" name="email_one"
                                            placeholder="Enter primary email"
                                            value="{{ old('email_one', $settings->email_one ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email Two -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_two">Email Two</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="email_two" class="form-control" name="email_two"
                                            placeholder="Enter secondary email"
                                            value="{{ old('email_two', $settings->email_two ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address One -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="address_one">Address One</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address_one" class="form-control" name="address_one"
                                            placeholder="Enter primary address"
                                            value="{{ old('address_one', $settings->address_one ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Two -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="address_two">Address Two</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address_two" class="form-control" name="address_two"
                                            placeholder="Enter secondary address"
                                            value="{{ old('address_two', $settings->address_two ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Google Map -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="google_map">Google Map</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="google_map" class="form-control" name="google_map"
                                            placeholder="Enter google map embed link"
                                            value="{{ old('google_map', $settings->google_map ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Copyright Text -->
                        <div class="row clearfix ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="footer_copyright_text">Footer Copyright Text</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="footer_copyright_text" class="form-control"
                                            name="footer_copyright_text" placeholder="Enter footer copyright text"
                                            value="{{ old('footer_copyright_text', $settings->footer_copyright_text ?? '') }}">
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
                                    <span id="btnText">UPDATE SETTINGS</span>
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
        function previewImage(event, previewId) {
            const file = event.target.files?.[0];
            if (!file) return;

            // নতুন ফাইল সিলেক্ট করলে remove-ফ্ল্যাগ 0 করে দাও
            const id = event.target.id; // website_logo / website_favicon / website_footer_logo
            const flagId = 'remove_' + id; // remove_website_logo, ...
            const flagInput = document.getElementById(flagId);
            if (flagInput) flagInput.value = '0';

            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.getElementById(previewId);
                preview.style.display = "block";
                const img = preview.querySelector('img');
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function removeImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            // 🔴 remove ফ্ল্যাগ = 1
            const flagInput = document.getElementById('remove_' + inputId);
            if (flagInput) flagInput.value = '1';

            // ইনপুট ও প্রিভিউ ক্লিয়ার
            input.value = '';
            preview.style.display = "none";
            const img = preview.querySelector('img');
            if (img) img.src = '';
        }

        $(function() {
            $('#websiteSettingForm').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                // খালি ফাইল ইনপুট বাদ দাও (যাতে validator ভুল না ধরে)
                ['website_logo', 'website_favicon', 'website_footer_logo'].forEach(name => {
                    const input = form.querySelector('#' + name);
                    if (!input || !input.files || input.files.length === 0) {
                        formData.delete(name);
                    }
                });

                $('#submitBtn').prop('disabled', true);
                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('website.settings.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#submitBtn').prop('disabled', false);
                        $('#btnText').text('UPDATE SETTINGS');
                        $('#btnSpinner').addClass('d-none');

                        if (response.status === 'success') {
                            toastr.success(response.message);

                            // সার্ভারের রেসপন্স অনুযায়ী UI আপডেট
                            if (response.data) {
                                // logo
                                if (response.data.website_logo) {
                                    $('#website_logo_preview').show();
                                    $('#website_logo_img').attr('src', response.data
                                        .website_logo + '?t=' + Date.now());
                                    $('#remove_website_logo').val('0');
                                } else {
                                    $('#website_logo_preview').hide();
                                    $('#website_logo_img').attr('src', '');
                                    $('#remove_website_logo').val('0');
                                }

                                // favicon
                                if (response.data.website_favicon) {
                                    $('#website_favicon_preview').show();
                                    $('#website_favicon_img').attr('src', response.data
                                        .website_favicon + '?t=' + Date.now());
                                    $('#remove_website_favicon').val('0');
                                } else {
                                    $('#website_favicon_preview').hide();
                                    $('#website_favicon_img').attr('src', '');
                                    $('#remove_website_favicon').val('0');
                                }

                                // footer logo
                                if (response.data.website_footer_logo) {
                                    $('#website_footer_logo_preview').show();
                                    $('#website_footer_logo_img').attr('src', response.data
                                        .website_footer_logo + '?t=' + Date.now());
                                    $('#remove_website_footer_logo').val('0');
                                } else {
                                    $('#website_footer_logo_preview').hide();
                                    $('#website_footer_logo_img').attr('src', '');
                                    $('#remove_website_footer_logo').val('0');
                                }
                            }
                        } else {
                            toastr.error(response.message || 'An error occurred.');
                        }
                    },
                    error: function(xhr) {
                        $('#submitBtn').prop('disabled', false);
                        $('#btnText').text('UPDATE SETTINGS');
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
