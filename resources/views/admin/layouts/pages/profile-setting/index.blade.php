@extends('admin.layouts.app')
@section('title', 'Profile Settings')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <style>
        .profile-image-wrapper {
            position: relative;
            display: inline-block;
        }

        .profile-image {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #eee;
            display: block;
        }

        .camera-btn {
            position: absolute;
            right: 8px;
            bottom: 8px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 0;
            background: #fff;
            color: #444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .15);
            transition: transform .1s ease;
        }

        .camera-btn:hover {
            transform: scale(1.03);
        }

        .camera-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .camera-btn i {
            font-size: 22px;
        }

        /* Password show style design*/
        .password-group {
            position: relative;
        }

        .password-group input {
            padding-right: 45px;
            /* জায়গা রাখলাম বাটনের জন্য */
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            outline: none;
            cursor: pointer;
            color: #555;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #0d6efd;
        }

        .password-toggle i {
            vertical-align: middle;
        }
    </style>
@endpush
@section('admin_content')
    <section class="profile-page">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="card overflowhidden m-t-20">
                        <div class="profile-header">
                            <div class="profile_info row">
                                {{-- <div class="col-lg-3 col-md-4 col-12">
                                    <div class="profile-image float-md-right">
                                        <img src="{{ asset('backend') }}/assets/images/profile_av.jpg" alt="">
                                    </div>
                                </div> --}}

                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="profile-image-wrapper">
                                        @if (Auth::user()->image)
                                            <img id="profileImage" src="{{ asset(Auth::user()->image) }}" alt="Profile"
                                                class="profile-image">
                                        @else
                                            <img id="profileImage" src="{{ asset('backend/assets/images/profile_av.jpg') }}"
                                                alt="Profile" class="profile-image">
                                        @endif

                                        <button type="button" id="cameraBtn" class="camera-btn" title="Change photo">
                                            <i class="material-icons">photo_camera</i>
                                        </button>

                                        <!-- id now matches JS -->
                                        <input type="file" id="profileFile" class="d-none"
                                            accept="image/png,image/jpeg,image/jpg,image/webp">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-8 col-12">
                                    <h4 class="m-t-5 m-b-0">{{ Auth::user()->name }}</h4>
                                    {{-- <span class="job_post">Ui UX Designer</span> --}}
                                    <p>{{ Auth::user()->phone ?? '' }}</p>
                                    <p>{{ Auth::user()->email ?? '' }}</p>
                                    <p>{{ Auth::user()->about ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-sub-header">
                            <div class="box-list">
                                <ul class="text-center">
                                    <li><a href="#" class="">
                                            <p>Welcome to my profile - {{ Auth::user()->name }}</p>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Password Update</h4>
                        </div>
                        <div class="body">
                            <form id="passwordUpdateForm" class="form_label" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div class="form-group password-group mb-3">
                                    <label for="current_password">Current Password</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="current_password" name="current_password"
                                                class="form-control" required>
                                            <button type="button" class="password-toggle" data-target="#current_password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- New Password -->
                                <div class="form-group password-group mb-3">
                                    <label for="password">New Password</label>
                                    <div class="form-group mb-0">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="form-control"
                                                required minlength="8">
                                            <button type="button" class="password-toggle" data-target="#password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted">At least 8 characters, with uppercase, number &
                                        symbol.</small>

                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group password-group mb-3">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="form-control" required>
                                            <button type="button" class="password-toggle"
                                                data-target="#password_confirmation">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button id="pwdSubmitBtn" type="submit" class="btn btn-primary w-100">
                                    <span id="pwdBtnSpinner" class="d-none spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    <span id="pwdBtnText">UPDATE PASSWORD</span>
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Info update</h4>
                        </div>
                        <div class="body">
                            <form id="ProfileInfoUpdateForm" class="form_label" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Name -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Full Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ old('name', auth()->user()->name) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ old('email', auth()->user()->email) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="phone">Phone</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" id="phone" name="phone" class="form-control"
                                                    value="{{ old('phone', auth()->user()->phone) }}"
                                                    placeholder="017XXXXXXXXXX">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="address" name="address" class="form-control"
                                                    placeholder="Enter Address"
                                                    value="{{ old('address', auth()->user()->address) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- About -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="about">About</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea id="about" name="about" rows="4" class="form-control" placeholder="Write a short bio...">{!! old('about', auth()->user()->about) !!}</textarea>
                                            </div>
                                            <small class="text-muted">A short description about yourself.</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row clearfix">
                                    <div class="col-lg-12 d-flex justify-content-end">
                                        <button id="submitBtn" type="submit"
                                            class="btn btn-raised btn-primary m-t-15 waves-effect">
                                            <span id="btnSpinner" class="d-none spinner-border spinner-border-sm"
                                                role="status" aria-hidden="true"></span>
                                            <span id="btnText">UPDATE</span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // when click on camera icon → open file picker
            $('#cameraBtn').on('click', function() {
                $('#profileFile').trigger('click');
            });

            // when a file is chosen → upload
            $('#profileFile').on('change', function() {
                const file = this.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('image', file);
                formData.append('_method', 'PUT'); // spoof PUT request

                $('#cameraBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('profile.image.update') }}",
                    type: "POST", // POST + _method=PUT
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // ✅ main fix
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        // instantly update profile image
                        $('#profileImage').attr('src', response.image_url + '?t=' + Date.now());
                    },
                    error: function(xhr) {
                        toastr.error('Image upload failed!');
                    },
                    complete: function() {
                        $('#cameraBtn').prop('disabled', false);
                        $('#profileFile').val('');
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#ProfileInfoUpdateForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();

                $('#submitBtn').prop('disabled', true);
                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('profile.info.update') }}",
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


    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $(document).on('click', '.password-toggle', function() {
                const target = $($(this).data('target'));
                const icon = $(this).find('i');
                const type = target.attr('type') === 'password' ? 'text' : 'password';
                target.attr('type', type);

                // Change icon
                if (type === 'text') {
                    icon.removeClass('fa-eye').addClass('fa-eye-slash').css('color', '#0d6efd');
                } else {
                    icon.removeClass('fa-eye-slash').addClass('fa-eye').css('color', '#555');
                }
            });

            // Password Update Ajax
            $('#passwordUpdateForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();

                $('#pwdSubmitBtn').prop('disabled', true);
                $('#pwdBtnText').text('Processing...');
                $('#pwdBtnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('profile.password.update') }}",
                    type: "POST", // @method('PUT') serializes automatically
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#pwdSubmitBtn').prop('disabled', false);
                        $('#pwdBtnText').text('UPDATE PASSWORD');
                        $('#pwdBtnSpinner').addClass('d-none');

                        toastr.success(response.message || 'Password updated successfully');

                        $('#current_password, #password, #password_confirmation').val('');
                    },
                    error: function(xhr) {
                        $('#pwdSubmitBtn').prop('disabled', false);
                        $('#pwdBtnText').text('UPDATE PASSWORD');
                        $('#pwdBtnSpinner').addClass('d-none');

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
