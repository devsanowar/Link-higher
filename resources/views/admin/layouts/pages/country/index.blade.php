@extends('admin.layouts.app')
@section('title', 'Countries')
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
                        <h4> All Countries </h4>

                        <!-- Button -->
                        <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal"
                            data-target="#createCountryModal">
                            <i class="zmdi zmdi-plus"></i> Create Country
                        </a>
                    </div>

                    {{-- Create Modal Include --}}
                    @include('admin.layouts.pages.country.create')

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">SN</th>
                                        <th>Name</th>
                                        <th style="width:60px">Status</th>
                                        <th style="width: 80px">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($countries as $key => $country)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $country->country_name ?? '' }}</td>

                                            <td>
                                                @if ($country->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <!-- Edit Button -->
                                                <a href="javascript:void(0);" class="btn btn-info btn-sm" title="Edit"
                                                    data-toggle="modal" data-target="#editCountryModal{{ $country->id }}">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                {{-- Edit Modal Include (will use $country inside a loop) --}}
                                                @include('admin.layouts.pages.country.edit')

                                                <form action="{{ route('country.destroy', $country->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $country->id }}">
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
                let button = $(this);
                let form = button.closest('form');

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
@endpush
