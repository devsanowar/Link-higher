@extends('admin.layouts.app')
@section('title', 'Profile Settings')
@push('styles')
<link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

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
                                    <li><a href="mail-inbox.html" class="">
                                            <p>Welcome to my profile - {{ Auth::user()->name }}</p>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>About Me</h2>
                        </div>
                        <div class="body">
                            <p class="text-default">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged.</p>
                            <blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <small>Designer <cite title="Source Title">Source Title</cite></small>
                            </blockquote>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="ProfileUpdateForm" class="form_label" method="POST">
                                <!-- Name -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Full Name</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Enter full name" required>
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
                                                    placeholder="name@example.com" required>
                                            </div>
                                            <small class="text-muted">This email must be unique.</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- System Admin (enum: admin, user, editor) -->
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                        <label for="system_admin">Role</label>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
                                        <div class="form-group">

                                            <select id="system_admin" name="system_admin" class="form-control show-tick">
                                                <option value="editor" selected>Editor</option>
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>

                                            <small class="text-muted">Choose one of: admin / user / editor</small>
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
                                                    placeholder="+8801XXXXXXXXX">
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
                                                    placeholder="House, Road, City">
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
                                                <textarea id="about" name="about" rows="4" class="form-control" placeholder="Write a short bio..."></textarea>
                                            </div>
                                            <small class="text-muted">A short description about yourself.</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="row clearfix">
                                    <div class="col-lg-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">
                                            Update Profile
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
@endpush
