@extends('admin.layouts.app')
@section('title', 'Trusted Clients')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> Trusted Clients </h4>
                        <a href="{{ route('clients.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Client
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Logo</th>
                                        <th>Company Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($clients as $key => $client)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>
                                                @php
                                                    $img = $client->company_image
                                                        ? asset($client->company_image)
                                                        : asset('backend/assets/images/company-placeholder.png');
                                                @endphp
                                                <img src="{{ $img }}" alt="Company Logo" width="60">
                                            </td>

                                            <td>{{ $client->company_name ?? '—' }}</td>

                                            <td>
                                                @if ($client->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('clients.edit', $client->id) }}"
                                                   class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('clients.destroy', $client->id) }}"
                                                      method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                            data-id="{{ $client->id }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination ব্যবহার করলে --}}
                            @if(method_exists($clients, 'links'))
                                <div class="mt-3">
                                    {{ $clients->links() }}
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
