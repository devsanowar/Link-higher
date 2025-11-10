@extends('admin.dashboard')
@section('title', 'Trashed Data')
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Trashed Data </h4>
                        <a href="{{ route('package_plans.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i>
                            </i> All Plan
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Plan Name</th>
                                        <th>Service Title</th>
                                        <th>Regular Price</th>
                                        <th>Sale Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($plans->get() as $key => $plan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                        <td>
                                            <strong>{{ $plan->name }}</strong><br>
                                            @if ($plan->is_popular)
                                                <span class="badge bg-success">Popular</span>
                                            @endif
                                            @if ($plan->is_free)
                                                <span class="badge bg-info">Free</span>
                                            @endif
                                        </td>

                                        <td>{{ $plan->service->service_title }}</td>
                                        <td>{{ $plan->price ?? '0' }}</td>

                                        <td>

                                            {{-- Show formatted price --}}
                                            <span>{{ number_format( $plan->final_price ?? '0', 2) }}</span>

                                            {{-- Optional: show discount info --}}

                                            <small class="text-muted d-block">
                                                ({{ ucfirst($plan->discount_type) }} discount:
                                                {{ $plan->discount_type === 'percent' ? $plan->discount . '%' : '$0.00' . $plan->discount }})
                                            </small>

                                        </td>

                                        <td>
                                            @if ($plan->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>


                                            <td>
                                                <a href="{{ route('plan.restore', $plan->id) }}"
                                                    class="btn btn-info btn-sm" title="Edit"><i
                                                        class="zmdi zmdi-refresh"></i></a>

                                                <form action="{{ route('plan.force.delete', $plan->id) }}" method="POST"
                                                    style="display:inline-block;" id="delete-form-{{ $plan->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                        data-id="{{ $plan->id }}">
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
                    text: "Permanent delete this data!",
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
