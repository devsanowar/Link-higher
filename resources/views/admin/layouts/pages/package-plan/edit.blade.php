@extends('admin.layouts.app')
@section('title', 'Edit Package Plan')

@push('styles')
    <link href="{{ asset('backend/assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Package Plan</h4>
                <a href="{{ route('package_plans.index') }}" class="btn btn-primary">
                    <i class="zmdi zmdi-arrow-left"></i> All Plans
                </a>
            </div>

            <div class="body table-responsive">
                <form id="editPlanForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="plan_id" value="{{ $plan->id }}">

                    <div class="row clearfix">
                        <div class="col-lg-12">
                            {{-- Service (foreign) --}}
                            <div class="mb-3">
                                <label for="service_id">Service</label>
                                <select name="service_id" id="service_id" class="form-control show-tick">
                                    <option value="">-- Select Service (optional) --</option>
                                    @if (isset($services) && $services->count())
                                        @foreach ($services as $svc)
                                            <option value="{{ $svc->id }}"
                                                {{ $plan->service_id == $svc->id ? 'selected' : '' }}>
                                                {{ $svc->service_title ?? ($svc->name ?? 'Service #' . $svc->id) }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('service_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name">Plan Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', $plan->name) }}" required>
                            </div>

                            {{-- Slug --}}
                            <div class="mb-3">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input type="text" id="slug" name="slug" class="form-control"
                                    value="{{ old('slug', $plan->slug) }}" required>
                            </div>

                            {{-- Price & Discount --}}
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" id="price" name="price" class="form-control"
                                        value="{{ old('price', $plan->price) }}">
                                    @error('price')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" id="discount" name="discount" class="form-control"
                                        value="{{ old('discount', $plan->discount) }}">
                                    @error('discount')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Discount Type --}}
                            <div class="mb-3">
                                <label>Discount Type</label>
                                <div class="d-flex gap-3 mt-2 align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="discount_percent" value="percent"
                                            {{ old('discount_type', $plan->discount_type) === 'percent' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="discount_percent">Percent (%)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="discount_amount" value="amount"
                                            {{ old('discount_type', $plan->discount_type) === 'amount' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="discount_amount">Amount</label>
                                    </div>
                                    @error('discount_type')
                                        <span class="text-danger small ms-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Currency --}}
                            <div class="mb-3">
                                <label for="currency">Currency</label>
                                <input type="text" id="currency" name="currency" class="form-control"
                                    value="{{ old('currency', $plan->currency ?? 'USD') }}">
                            </div>

                            {{-- Features --}}
                            <hr>
                            <h5>Features</h5>
                            <div id="featureWrapper">
                                @php
                                    $features = is_string($plan->features)
                                        ? json_decode($plan->features, true)
                                        : $plan->features ?? [];
                                    $features = $features ?: [];
                                @endphp

                                @if (count($features))
                                    @foreach ($features as $f)
                                        <div class="d-flex mb-2 featureRow">
                                            <input type="text" class="form-control me-2" name="features[]"
                                                value="{{ $f }}">
                                            <button type="button" class="btn btn-danger removeFeatureBtn"><i
                                                    class="zmdi zmdi-delete"></i></button>
                                        </div>
                                    @endforeach
                                    <div class="d-flex mb-2">
                                        <div class="col-12 p-0">
                                            <button type="button" class="btn btn-success addFeatureBtn"><i
                                                    class="zmdi zmdi-plus"></i> Add feature</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex mb-2 featureRow">
                                        <input type="text" class="form-control me-2" name="features[]"
                                            placeholder="Feature 1">
                                        <button type="button" class="btn btn-success addFeatureBtn"><i
                                                class="zmdi zmdi-plus"></i></button>
                                    </div>
                                @endif
                            </div>

                            {{-- Status --}}
                            <div class="mb-3 mt-3">
                                <label for="is_active">Status</label>
                                <select id="is_active" name="is_active" class="form-control show-tick"
                                    style="max-width:140px">
                                    <option value="1" {{ $plan->is_active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$plan->is_active ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            {{-- Submit --}}
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-5" id="submitBtn">
                                    <span id="btnText">UPDATE PLAN</span>
                                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                </button>
                            </div>
                        </div>

                    </div> {{-- row --}}
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script>
    <script>
        (function() {

            // ======== SLUG AUTO GENERATE ========
            $('#name').on('input', function() {
                $('#slug').val($(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, ''));
                refreshPreview();
            });

            // ======== DYNAMIC FEATURE ADD/REMOVE ========
            $(document).on('click', '.addFeatureBtn', function() {
                $('#featureWrapper').append(`
            <div class="d-flex mb-2 featureRow">
                <input type="text" class="form-control me-2" name="features[]" placeholder="Feature">
                <button type="button" class="btn btn-danger removeFeatureBtn"><i class="zmdi zmdi-delete"></i></button>
            </div>`);
                refreshPreviewFeatures();
            });

            $(document).on('click', '.removeFeatureBtn', function() {
                $(this).closest('.featureRow').remove();
                refreshPreviewFeatures();
            });

            $('#featureWrapper').on('input', 'input[name="features[]"]', function() {
                refreshPreviewFeatures();
            });


            $('#editPlanForm').on('submit', function(e) {
                e.preventDefault();
                let fd = new FormData(this);

                // convert features[] to JSON string
                const features = [];
                $('input[name="features[]"]').each(function() {
                    if ($(this).val().trim()) features.push($(this).val().trim());
                });
                fd.delete('features[]');
                fd.append('features', JSON.stringify(features));

                // Add _method = PUT
                fd.append('_method', 'PUT');

                $('#btnText').text('Updating...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('package_plans.update', $plan->id) }}",
                    type: 'POST', // keep POST, but _method = PUT
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status === 'success') {
                            toastr.success(res.message ?? 'Plan updated successfully.');
                            if (res.redirectUrl) {
                                setTimeout(function() {
                                    window.location.href = res.redirectUrl;
                                }, 1000);
                            }
                        } else {
                            toastr.error(res.message ?? 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        let msg = 'Unexpected error';
                        if (xhr.status === 422) {
                            msg = Object.values(xhr.responseJSON.errors).map(v => v[0]).join('\n');
                        }
                        Swal.fire('Validation Error', msg, 'error');
                    },
                    complete: function() {
                        $('#btnText').text('UPDATE PLAN');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });


        })();
    </script>
@endpush
