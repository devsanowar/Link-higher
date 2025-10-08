@extends('admin.layouts.app')
@section('title', 'Login Page')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4> Login Page </h4>
                </div>
                <div class="body">
                    <form id="loginPageForm" class="form_label" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Background Image Upload -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="login_page_bg">Login Page Background Image</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="login_page_bg" class="form-control" name="login_page_bg"
                                            accept="image/*">
                                    </div>

                                    <!-- Live Preview Box -->
                                    <div id="preview-wrapper" class="mt-3" style="position:relative; width:250px;">
                                        <img id="imagePreview"
                                            src="{{ isset($loginpage->login_page_bg) ? asset($loginpage->login_page_bg) : '' }}"
                                            alt="Preview"
                                            class="{{ isset($loginpage->login_page_bg) ? 'img-thumbnail' : 'd-none' }}"
                                            style="width:250px; height:auto; border-radius:6px; transition: all 0.3s ease;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Background Gradient Color Picker -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="login_page_bg_color_rgba">Background Color / Gradient</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="rgba-picker" style="display:flex; flex-direction:column; gap:10px;">
                                            <input type="text" id="login_page_bg_color_rgba" name="login_page_bg_color"
                                                class="form-control"
                                                placeholder="rgba(255,255,255,1) or linear-gradient(...)"
                                                value="{{ old('login_page_bg_color', $loginpage->login_page_bg_color ?? 'rgba(255,255,255,1)') }}">

                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <label class="mb-0" style="min-width:60px;">From:</label>
                                                <input type="color" id="gradient_color1" value="#ff0000"
                                                    style="width:45px; height:35px;">
                                                <label class="mb-0">To:</label>
                                                <input type="color" id="gradient_color2" value="#0000ff"
                                                    style="width:45px; height:35px;">

                                                <select id="gradient_type" class="form-control" style="max-width:150px;">
                                                    <option value="linear">Linear</option>
                                                    <option value="radial">Radial</option>
                                                </select>

                                                <input type="range" id="gradient_angle" min="0" max="360"
                                                    step="1" value="90" title="Angle" style="width:120px;">
                                                <span id="angle_val" style="min-width:40px;">90°</span>
                                            </div>

                                            <!-- Gradient preview -->
                                            <div id="gradient_preview"
                                                style="width:100%; height:50px; border-radius:6px; border:1px solid #ccc; transition: all 0.3s ease;">
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        দুইটি রঙ বেছে gradient তৈরি করুন। রঙ বা ছবি একসাথে দেওয়া যাবে না — যেটা বেছে নেবেন
                                        সেটাই সেভ হবে।
                                    </small>
                                </div>
                            </div>
                        </div>
                        <!-- Update Button -->
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
    <script src="{{ asset('backend') }}/assets/js/login_page.js"></script>
    <script>
        $(document).ready(function() {
            const $form = $('#loginPageForm');
            const $colorInput = $('#login_page_bg_color_rgba');
            const $fileInput = $('#login_page_bg');
            const $previewImg = $('#imagePreview');
            const $submitBtn = $('#submitBtn');
            const $btnText = $('#btnText');
            const $btnSpinner = $('#btnSpinner');
            const $gradientPreview = $('#gradient_preview');

            // --- Live Image Preview ---
            $fileInput.on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        // Show and update preview instantly
                        $previewImg.attr('src', evt.target.result)
                            .removeClass('d-none')
                            .css({
                                opacity: 0
                            })
                            .animate({
                                opacity: 1
                            }, 200);
                    };
                    reader.readAsDataURL(file);

                    // Clear color field if image selected
                    $colorInput.val('');
                    $gradientPreview.css('background', 'transparent');
                } else {
                    $previewImg.attr('src', '').addClass('d-none');
                }
            });

            // --- Gradient Color Generator ---
            const color1 = $('#gradient_color1');
            const color2 = $('#gradient_color2');
            const type = $('#gradient_type');
            const angle = $('#gradient_angle');
            const angleVal = $('#angle_val');

            function updateGradient() {
                const c1 = color1.val();
                const c2 = color2.val();
                const deg = angle.val();
                const t = type.val();

                let gradientCSS = t === 'linear' ?
                    `linear-gradient(${deg}deg, ${c1}, ${c2})` :
                    `radial-gradient(circle, ${c1}, ${c2})`;

                $gradientPreview.css('background', gradientCSS);
                $colorInput.val(gradientCSS);
                angleVal.text(deg + '°');

                // Remove image preview if gradient chosen
                if ($colorInput.val().length) {
                    $fileInput.val('');
                    $previewImg.attr('src', '').addClass('d-none');
                }
            }

            [color1, color2, type, angle].forEach(el => el.on('input', updateGradient));

            // manual input reflect
            $colorInput.on('input', function() {
                const val = $(this).val().trim();
                if (val.startsWith('linear-gradient') || val.startsWith('radial-gradient') || val
                    .startsWith('rgba')) {
                    $gradientPreview.css('background', val);
                }
            });

            // --- Form Submit AJAX ---
            $form.on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                $submitBtn.prop('disabled', true);
                $btnText.text('Processing...');
                $btnSpinner.removeClass('d-none');

                $.ajax({
                    url: "{{ route('login.page.update') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success(response.message || 'Updated successfully');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(_, messages) {
                                toastr.error(messages[0]);
                            });
                        } else {
                            toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                        }
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false);
                        $btnText.text('UPDATE');
                        $btnSpinner.addClass('d-none');
                    }
                });
            });
        });
    </script>
@endpush
