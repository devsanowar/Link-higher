@extends('admin.layouts.app')
@section('title', 'Smart Solution Features')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Features </h4>
                        <a href="{{ route('home.smart-solution-features.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Feature
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Feature Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th width="130">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($features as $key => $feature)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $feature->feature_title ?? '' }}</td>
                                            <td>{{ Str::limit(strip_tags($feature->feature_description ?? ''), 80, '...') }}</td>

                                            <td>
                                                @if ($feature->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('home.smart-solution-features.edit', $feature->id) }}"
                                                   class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('home.smart-solution-features.destroy', $feature->id) }}"
                                                      method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                            data-id="{{ $feature->id }}" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No features found.</td>
                                        </tr>
                                    @endforelse
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
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function() {
                let form = $(this).closest('form');

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
