@extends('admin.layouts.app')
@section('title', 'Case Study')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Case Study - <span><a href="{{ route('case.study.trashed') }}" class="btn btn-danger">Recycle Bin ({{ $trashedDataCount }})</a></span> </h4>
                        <a href="{{ route('case.study.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i>
                            </i> Create Case Studies
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Title</th>
                                        <th>Service</th>
                                        <th>Website Url</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($cases as $key => $case)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $case->title ?? '' }}</td>
                                            <td>{{ $case->service->service_title ?? '' }}</td>
                                            <td>{{ Str::limit($case->website_url ?? '', 20, '...') }}</td>
                                            <td>{{ $case->start_date ?? '' }}</td>
                                            <td>{{ $case->end_date }}</td>
                                            <td>
                                                @if ($case->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('case.study.edit', $case->id) }}"
                                                    class="btn btn-primary btn-sm" title="Edit"><i
                                                        class="zmdi zmdi-edit"></i></a>
                                                <form action="{{ route('case.study.destroy', $case->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $case->id }}">
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
@endpush
