@extends('admin.layouts.app')
@section('title', 'Package Plans')
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">All Package Plans</h4>

                        <a href="{{ route('package_plans.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add New Plan
                        </a>
                    </div>

                    <div class="body table-responsive">

                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
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
                                @foreach ($plans as $key => $plan)
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


                                        {{-- <td class="text-start">
                                        @if ($plan->features)
                                            <ul class="m-0 ps-3">
                                                @foreach (json_decode($plan->features, true) as $feature)
                                                    <li>{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td> --}}

                                        <td>
                                            @if ($plan->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('package_plans.edit', $plan->id) }}"
                                                class="btn btn-sm btn-info" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <form action="{{ route('package_plans.destroy', $plan->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger deleteBtn"
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
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Delete confirmation
            $(document).on('click', '.deleteBtn', function() {
                let button = $(this);
                let form = button.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This plan will be permanently deleted.",
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
