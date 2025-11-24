@extends('admin.layouts.app')
@section('title', 'Partner Sites')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('admin_content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>All Partner Sites</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#createPartnerSiteModal">
                            <i class="zmdi zmdi-plus"></i> Add New Site
                        </button>

                        @include('admin.layouts.pages.partner-site-list.create')

                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Site Name</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sites as $key => $site)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $site->site_name }}</td>
                                            <td>
                                                <a href="{{ $site->site_url }}" target="_blank">
                                                    {{ $site->site_url }}
                                                </a>
                                            </td>

                                            <td>
                                                @if ($site->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $site->created_at ? $site->created_at->format('d M, Y') : '-' }}
                                            </td>

                                            <td>

                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editPartnerSiteModal-{{ $site->id }}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>

                                                @include('admin.layouts.pages.partner-site-list.edit')


                                                <form action="{{ route('partner-sites.destroy', $site->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                                        data-id="{{ $site->id }}">
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
        </div>
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
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This site will be deleted!",
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

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#createPartnerSiteModal').modal('show');
            });
        </script>
    @endif
@endpush
