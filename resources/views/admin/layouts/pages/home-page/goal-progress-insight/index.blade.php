@extends('admin.layouts.app')
@section('title', 'Goal Progress Insights')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Goal Progress </h4>
                        <a href="{{ route('home.goal-progress-insight.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Insight
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($items as $key => $gp)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>
                                                <img src="{{ asset($gp->image ?? '') }}" alt="Goal Image" width="60" class="rounded border">
                                            </td>

                                            <td>{{ $gp->title ?? '' }}</td>

                                            <td>{{ Str::limit(strip_tags($gp->description ?? ''), 60, '...') }}</td>

                                            <td>
                                                @if ((int)($gp->status ?? 0) === 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('home.goal-progress-insight.edit', $gp->id) }}"
                                                   class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('home.goal-progress-insight.destroy', $gp->id) }}"
                                                      method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination (optional) --}}
                            @if(method_exists($items, 'links'))
                                <div class="mt-3">
                                    {{ $items->links() }}
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
                const form = $(this).closest('form');
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
