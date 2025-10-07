@extends('admin.layouts.app')
@section('title', 'Website Color Settings')
@push('styles')
    <style>
        .color-wrapper {
            display: flex;
        }

        input.color-picker {
            height: 38px;
        }

        .form-group .form-line {
            padding: 0 0 0 10px;
        }
    </style>
@endpush
@section('admin_content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4> Website Color Settings </h4>
                </div>
                <div class="body">
                    <form id="WebsiteColorForm" class="form_label" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Primary Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="primary_color">Primary Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="primary_color" class="form-control hex-input"
                                                name="primary_color" value="{{ $color->primary_color_picker ?? '' }}" maxlength="6">
                                            <input type="color" id="primary_color_picker" class="color-picker"
                                                value="{{ $color->primary_color ?? '' }}" aria-label="Primary Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Secondary Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="secondary_color">Secondary Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="secondary_color" class="form-control hex-input"
                                                name="secondary_color" value="{{ $color->secondary_color ?? '' }}" maxlength="6">
                                            <input type="color" id="secondary_color_picker" class="color-picker"
                                                value="{{ $color->secondary_color ?? '' }}" aria-label="Secondary Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Background Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="background_color">Background Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="background_color" class="form-control hex-input"
                                                name="background_color" value="{{ $color->background_color ?? '' }}" maxlength="6">
                                            <input type="color" id="background_color_picker" class="color-picker" value="{{ $color->background_color ?? '' }}" aria-label="Background Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Text Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="text_color">Text Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="text_color" class="form-control hex-input"
                                                name="text_color" placeholder="000000" value="{{ $color->text_color ?? '' }}" maxlength="6">
                                            <input type="color" id="text_color_picker" class="color-picker"
                                                value="{{ $color->text_color ?? '' }}" aria-label="Text Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Heading Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="heading_color">Heading Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="heading_color" class="form-control hex-input"
                                                name="heading_color" value="{{ $color->heading_color ?? '' }}" maxlength="6">
                                            <input type="color" id="heading_color_picker" class="color-picker"
                                                value="{{ $color->heading_color ?? '' }}" aria-label="Heading Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Link Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="link_color">Link Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="link_color" class="form-control hex-input"
                                                name="link_color" value="{{ $color->link_color ?? '' }}" maxlength="6">
                                            <input type="color" id="link_color_picker" class="color-picker"
                                                value="{{ $color->link_color ?? '' }}" aria-label="Link Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Link Hover Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="link_hover_color">Link Hover Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="link_hover_color" class="form-control hex-input"
                                                name="link_hover_color" placeholder="551A8B" value="{{ $color->link_hover_color ?? '' }}"
                                                maxlength="6">
                                            <input type="color" id="link_hover_color_picker" class="color-picker"
                                                value="{{ $color->link_hover_color ?? '' }}" aria-label="Link Hover Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dark Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="dark_color">Dark Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="dark_color" class="form-control hex-input"
                                                name="dark_color" value="{{ $color->dark_color ?? '' }}" maxlength="6">
                                            <input type="color" id="dark_color_picker" class="color-picker"
                                                value="{{ $color->dark_color ?? '' }}" aria-label="Dark Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Light Color -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="light_color">Light Color</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="light_color" class="form-control hex-input"
                                                name="light_color" value="{{ $color->light_color ?? '' }}" maxlength="6">
                                            <input type="color" id="light_color_picker" class="color-picker"
                                                value="{{ $color->light_color ?? '' }}" aria-label="Light Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button Background -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_background_color">Button Background</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="button_background_color"
                                                class="form-control hex-input" name="button_background_color" value="{{ $color->button_background_color ?? '' }}" maxlength="6">
                                            <input type="color" id="button_background_color_picker"
                                                class="color-picker" value="{{ $color->button_background_color ?? '' }}" aria-label="Button Background">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button Hover -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_hover_color">Button Hover</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="button_hover_color" class="form-control hex-input"
                                                name="button_hover_color" placeholder="0B5ED7" value="{{ $color->button_hover_color ?? '' }}"
                                                maxlength="6">
                                            <input type="color" id="button_hover_color_picker" class="color-picker"
                                                value="{{ $color->button_hover_color ?? '' }}" aria-label="Button Hover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button Text -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="button_text_color">Button Text</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="button_text_color" class="form-control hex-input"
                                                name="button_text_color" value="{{ $color->button_text_color ?? '' }}"
                                                maxlength="6">
                                            <input type="color" id="button_text_color_picker" class="color-picker"
                                                value="{{ $color->button_text_color ?? '' }}" aria-label="Button Text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Header Background -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="header_background_color">Header Background</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="header_background_color"
                                                class="form-control hex-input" name="header_background_color" value="{{ $color->header_background_color ?? '' }}" maxlength="6">
                                            <input type="color" id="header_background_color_picker"
                                                class="color-picker" value="{{ $color->header_background_color ?? '' }}" aria-label="Header Background">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Header Text -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="header_text_color">Header Text</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="header_text_color" class="form-control hex-input"
                                                name="header_text_color" value="{{ $color->header_text_color ?? '' }}"
                                                maxlength="6">
                                            <input type="color" id="header_text_color_picker" class="color-picker"
                                                value="{{ $color->header_text_color ?? '' }}" aria-label="Header Text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Background -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="footer_background_color">Footer Background</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="footer_background_color"
                                                class="form-control hex-input" name="footer_background_color"
                                                value="{{ $color->footer_background_color ?? '' }}" maxlength="6">
                                            <input type="color" id="footer_background_color_picker"
                                                class="color-picker" value="{{ $color->footer_background_color ?? '' }}" aria-label="Footer Background">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Text -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="footer_text_color">Footer Text</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="color-wrapper">
                                            <input type="text" id="footer_text_color" class="form-control hex-input"
                                                name="footer_text_color" value="{{ $color->footer_text_color ?? '' }}"
                                                maxlength="6">
                                            <input type="color" id="footer_text_color_picker" class="color-picker"
                                                value="{{ $color->footer_text_color ?? '' }}" aria-label="Footer Text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit (visual only) -->
                        <div class="row clearfix">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button id="submitBtn" type="submit"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect">
                                    <span id="btnSpinner" class="d-none spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    <span id="btnText">UPDATE COLOR'S</span>
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
        /* Auto-sync: color picker ↔ HEX input (for all fields above) */
        document.addEventListener('DOMContentLoaded', function() {
            const ids = [
                'primary_color', 'secondary_color', 'background_color', 'text_color', 'heading_color',
                'link_color', 'link_hover_color', 'dark_color', 'light_color',
                'button_background_color', 'button_hover_color', 'button_text_color',
                'header_background_color', 'header_text_color', 'footer_background_color', 'footer_text_color'
            ];

            const toHex = v => v.replace(/[^0-9A-Fa-f]/g, '').substring(0, 6).toUpperCase();

            ids.forEach(id => {
                const hex = document.getElementById(id);
                const pick = document.getElementById(id + '_picker');
                if (!hex || !pick) return;

                // init (prefer hex value; else reflect picker)
                if (hex.value) {
                    hex.value = toHex(hex.value);
                    if (hex.value.length === 6) pick.value = '#' + hex.value;
                } else if (pick.value) {
                    hex.value = toHex(pick.value.replace('#', ''));
                }

                // picker -> hex
                pick.addEventListener('input', () => {
                    hex.value = toHex(pick.value.replace('#', ''));
                });

                // hex -> picker
                hex.addEventListener('input', () => {
                    const v = toHex(hex.value);
                    hex.value = v;
                    if (v.length === 6) pick.value = '#' + v;
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#WebsiteColorForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();

                $('#submitBtn').prop('disabled', true);
                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('website.color.update') }}",
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
