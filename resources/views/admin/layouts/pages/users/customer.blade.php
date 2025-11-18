@extends('admin.layouts.app')
@section('title', 'Customer Management')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">

@endpush
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">All Customers</h4>

                        <div class="d-flex gap-2">
                            <a href="{{ route('user.management.index') }}" class="btn btn-primary">
                                <i class="zmdi zmdi-accounts"></i> All User
                            </a>
                        </div>
                    </div>

                    @include('admin.layouts.pages.users.add_user')

                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key => $user)
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
                                        <td class="text-center">
                                            <!-- Edit Link -->
                                            <a href="{{ route('user.management.edit', $user->id) }}"
                                                class="btn btn-sm btn-icon btn-info" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <!-- Delete Link -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                    data-id="{{ $user->id }}">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
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
    <script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>

    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function() {
                let button = $(this);
                let form = button.closest('form');
                let rowId = button.data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
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
