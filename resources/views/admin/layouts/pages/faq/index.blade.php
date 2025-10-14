@extends('admin.layouts.app')
@section('title', 'Faq Page')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All FAQ </h4>
                        <a href="{{ route('faqs.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i>
                            </i> Create FAQ
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($faqs as $key => $faq)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $faq->question ?? '' }}</td>
                                            <td>{{ Str::limit($faq->answer ?? '', 30, '...') }}</td>

                                            <td>
                                                @if ($faq->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-info btn-sm"
                                                    title="Restore"><i class="zmdi zmdi-edit"></i></a>

                                                <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $faq->id }}">
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
