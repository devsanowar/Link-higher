@extends('admin.layouts.app')
@section('title', 'User Management')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">All Users</h2>

                        <a href="javascript:void(0)" id="addUserBtn" class="btn btn-primary">
                            <i class="zmdi zmdi-account-add"></i> Add User
                        </a>
                    </div>

                    @include('admin.layouts.pages.users.add_user')

                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            @php
                                                $rel = ltrim($user->image ?? '', '/'); // "uploads/users/filename.jpg"
                                                $abs = $rel ? public_path($rel) : null; // /path/to/public/uploads/users/filename.jpg
                                                $fallback = asset('backend/assets/images/user.jpg'); // fallback image in public/backend/assets/images/
                                            @endphp

                                            <img src="{{ !empty($rel) && $rel !== 'default.jpg' && file_exists($abs) ? asset($rel) : $fallback }}"
                                                alt="User Image" width="48">
                                        </td>

                                        <td>{{ $user->name ?? '' }}</td>
                                        <td>{{ $user->email ?? '' }}</td>
                                        <td>{{ $user->phone ?? '' }}</td>
                                        <td>
                                            <a href="">Edit</a>
                                            <a href="">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Open modal
            $('#addUserBtn').on('click', function(e) {
                e.preventDefault();
                $('#addUserForm')[0].reset();
                $('#addUserModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }).modal('show');
            });

            // Submit via AJAX
            $('#addUserForm').on('submit', function(e) {
                e.preventDefault();

                const data = $(this).serialize();

                $('#auSubmitBtn').prop('disabled', true);
                $('#auBtnText').text('Processing...');
                $('#auBtnSpinner').removeClass('d-none');

                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: "POST",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        $('#auSubmitBtn').prop('disabled', false);
                        $('#auBtnText').text('Create User');
                        $('#auBtnSpinner').addClass('d-none');

                        $('#addUserModal').modal('hide');
                        toastr.success(res.message || 'User created successfully');
                        location.reload();

                        // TODO: টেবিল রিফ্রেশ/নতুন রো অ্যাপেন্ড করুন
                        // $('#usersTable').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        $('#auSubmitBtn').prop('disabled', false);
                        $('#auBtnText').text('Create User');
                        $('#auBtnSpinner').addClass('d-none');

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
