@extends('admin.layouts.app')
@section('title', 'Edit User')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit User</h4>
                        <a href="{{ route('user.management.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> Back to Users
                        </a>
                    </div>
                    <div class="body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter full name" value="{{ old('name', $user->name) }}"
                                                required>
                                        </div>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email">Email <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="example@mail.com" value="{{ old('email', $user->email) }}"
                                                required>
                                        </div>
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="phone">Phone (optional)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="phone" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="017XXXXXXXX" value="{{ old('phone', $user->phone) }}">
                                        </div>
                                        @error('phone')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Password (Show & Change Option) --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Leave blank to keep current password">
                                            <i id="togglePassword" class="zmdi zmdi-eye-off position-absolute"
                                                style="right: 12px; top: 10px; cursor: pointer;"></i>
                                        </div>
                                        <small class="text-muted">If you don’t want to change password, leave this field
                                            blank.</small>
                                        @error('password')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="form-control" placeholder="Re-enter new password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Profile Image --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Profile Image</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                        @if ($user->image)
                                            <img src="{{ asset($user->image) }}" alt="User Image"
                                                class="mt-2 border rounded" width="100">
                                        @endif
                                    </div>
                                </div>
                            </div>


                            {{-- Role --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="au_role">Role</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <select id="au_role" name="system_admin" class="form-control show-tick">
                                        <option value="admin" {{ $user->system_admin === 'admin' ? 'selected' : '' }}>
                                            Admin</option>
                                        <option value="editor" {{ $user->system_admin === 'editor' ? 'selected' : '' }}>
                                            Editor
                                        </option>
                                        <option value="user" {{ $user->system_admin === 'user' ? 'selected' : '' }}>User
                                        </option>
                                    </select>

                                </div>
                            </div>


                            {{-- Submit Button --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">
                                        UPDATE USER
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('zmdi-eye-off');
                icon.classList.add('zmdi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('zmdi-eye');
                icon.classList.add('zmdi-eye-off');
            }
        });
    </script>
@endpush
