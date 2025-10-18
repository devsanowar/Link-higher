@extends('admin.layouts.app')
@section('title', 'Achievements')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Achievements </h4>
                        <a href="{{ route('home.achievements.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Achievement
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Title</th>
                                        <th>Count</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th width="130">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($achievements as $key => $achievement)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $achievement->title ?? '' }}</td>
                                            <td>{{ $achievement->count_value ?? '' }}</td>
                                            <td>{{ $achievement->order ?? '' }}</td>

                                            <td>
                                                @if ($achievement->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('home.achievements.edit', $achievement->id) }}"
                                                   class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('home.achievements.destroy', $achievement->id) }}"
                                                      method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                            data-id="{{ $achievement->id }}" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No achievements found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- যদি pagination ব্যবহার করো --}}
                            @if (method_exists($achievements, 'links'))
                                <div class="mt-3">
                                    {{ $achievements->links() }}
                                </div>
                            @endif
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
