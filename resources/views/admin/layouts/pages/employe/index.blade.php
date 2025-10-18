@extends('admin.layouts.app')
@section('title', 'Employes')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                {{-- ============ Card#2: All Employes (table) ============ --}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>All Employes</h4>
                        <a href="{{ route('employe.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Employe
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Profession</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employes as $key => $employe)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($employe->image)
                                                    <img src="{{ asset($employe->image ?? '') }}" alt="Image"
                                                         class="border rounded" style="width:60px; height:60px; object-fit:cover;">
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $employe->name ?? ''}}</td>
                                            <td>{{ $employe->profession ?? '' }}</td>
                                            <td>{{ $employe->order ?? '0' }}</td>


                                             <td>
                                                @if ($employe->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('employe.edit', $employe->id) }}"
                                                   class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('employe.destroy', $employe->id) }}"
                                                      method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                            data-id="{{ $employe->id }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (method_exists($employes, 'links'))
                                <div class="mt-3">
                                    {{ $employes->links() }}
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

    {{-- Delete confirm (same pattern) --}}
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
