@extends('admin.layouts.app')
@section('title', 'Add Package Plan')

@push('styles')
    <link href="{{ asset('backend/assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Add Package Plan</h4>
                        <a href="{{ route('package_plans.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Plans
                        </a>
                    </div>

                    <div class="body table-responsive">
                        <form id="addPlanForm" method="POST">
                            @csrf

                            {{-- Service (foreign) --}}
                            <div class="row mb-3">
                                <div class="col-lg-3 form-control-label">
                                    <label for="service_id">Service</label>
                                </div>
                                <div class="col-lg-9">
                                    <select name="service_id" id="service_id" class="form-control show-tick">
                                        <option value="">-- Select Service (optional) --</option>
                                        @if (isset($services) && $services->count())
                                            @foreach ($services as $svc)
                                                <option value="{{ $svc->id }}"
                                                    {{ old('service_id') == $svc->id ? 'selected' : '' }}>
                                                    {{ $svc->service_title ?? ($svc->name ?? 'Service #' . $svc->id) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('service_id')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="row mb-3">
                                <div class="col-lg-3 form-control-label">
                                    <label for="name">Plan Name <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Basic / Advanced" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Slug --}}
                            <div class="row mb-3">
                                <div class="col-lg-3 form-control-label">
                                    <label for="slug">Slug <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" id="slug" name="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="basic / advanced" value="{{ old('slug') }}" required>
                                    @error('slug')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="row mb-3">
                                <div class="col-lg-3 form-control-label">
                                    <label for="price">Price</label>
                                </div>
                                <div class="col-lg-3">
                                    <input type="number" step="0.01" id="price" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', 0) }}">
                                    @error('price')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 form-control-label">
                                    <label for="discount">Discount</label>
                                </div>
                                <div class="col-lg-3">
                                    <input type="number" step="0.01" id="discount" name="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount') }}">
                                    @error('discount')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Discount Type --}}
                            <div class="row mb-3">
                                <div class="col-lg-3 form-control-label">
                                    <label for="discount_type">Discount Type</label>
                                </div>
                                <div class="col-lg-9 d-flex align-items-center gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="discount_percent" value="percent"
                                            {{ old('discount_type') === 'percent' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="discount_percent">Percent (%)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_type"
                                            id="discount_amount" value="amount"
                                            {{ old('discount_type') === 'amount' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="discount_amount">Amount</label>
                                    </div>
                                    @error('discount_type')
                                        <span class="text-danger small ms-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Currency --}}
                            <div class="row mb-3">
                                <div class="col-lg-3 form-control-label"><label for="currency">Currency</label></div>
                                <div class="col-lg-3">
                                    <input type="text" name="currency" id="currency" class="form-control"
                                        value="{{ old('currency', 'USD') }}" maxlength="10">
                                    @error('currency')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Features --}}
                            <h5 class="mb-2">Features</h5>
                            <div id="featureWrapper">
                                <div class="row mb-3 featureRow">
                                    <div class="col-lg-3 form-control-label"><label>Features</label></div>
                                    <div class="col-lg-9 d-flex">
                                        <input type="text" class="form-control me-2" name="features[]"
                                            placeholder="Feature 1">
                                        <button type="button" class="btn btn-success addFeatureBtn">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- If old features exist, render them --}}
                                @if (old('features') && is_array(old('features')))
                                    @foreach (old('features') as $i => $f)
                                        @if ($i == 0)
                                            @continue
                                        @endif
                                        <div class="row mb-2 featureRow">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-9 d-flex">
                                                <input type="text" class="form-control me-2" name="features[]"
                                                    value="{{ $f }}" placeholder="Feature">
                                                <button type="button" class="btn btn-danger removeFeatureBtn">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            {{-- Active --}}
                            <div class="row mb-4">
                                <div class="col-lg-3 form-control-label"><label class="me-2">Status</label></div>
                                <div class="col-lg-9">
                                    <select name="is_active" class="form-control show-tick" style="max-width:140px">
                                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix mt-2">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">CREATE PLAN</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> {{-- body --}}
                </div> {{-- card --}}
            </div> {{-- col --}}
        </div> {{-- row --}}
    </div> {{-- container --}}
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script>
    <script>
        (function() {
            // -------- Slug Auto Generate --------
            const name = document.getElementById('name');
            const slug = document.getElementById('slug');
            if (name && slug) {
                name.addEventListener('input', () => {
                    slug.value = name.value
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/(^-|-$)/g, '');
                });
            }

            // -------- Dynamic Feature Add/Remove --------
            let featureCount = document.querySelectorAll('.featureRow').length || 1;
            document.addEventListener('click', function(e) {
                if (e.target.closest('.addFeatureBtn')) {
                    featureCount++;
                    const row = `
                    <div class="row mb-2 featureRow">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9 d-flex">
                            <input type="text" class="form-control me-2" name="features[]" placeholder="Feature ${featureCount}">
                            <button type="button" class="btn btn-danger removeFeatureBtn">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </div>
                    </div>`;
                    $('#featureWrapper').append(row);
                }
                if (e.target.closest('.removeFeatureBtn')) {
                    e.target.closest('.featureRow').remove();
                }
            });

            // -------- AJAX Submit --------
            $('#addPlanForm').on('submit', function(e) {
                e.preventDefault();
                const fd = new FormData(this);

                // Gather features[] and append as JSON string for DB json column
                const features = [];
                $('input[name="features[]"]').each(function() {
                    if ($(this).val().trim()) features.push($(this).val().trim());
                });
                // remove individual features[] keys and add single 'features' JSON as expected by controller
                fd.delete('features[]');
                fd.append('features', JSON.stringify(features));

                // Button state
                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('package_plans.store') }}",
                    type: "POST",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Created!',
                                text: res.message ?? 'Package Plan created successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href =
                                    "{{ route('package_plans.index') }}";
                            });
                        } else {
                            Swal.fire('Error', res.message ?? 'Something went wrong!', 'error');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';
                            $.each(errors, function(k, v) {
                                msg += v[0] + "\n";
                            });
                            Swal.fire('Validation Error', msg, 'error');
                        } else {
                            Swal.fire('Error', 'Unexpected error occurred!', 'error');
                        }
                    },

                    complete: function() {
                        $('#btnText').text('CREATE PLAN');
                        $('#btnSpinner').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            });
        })();
    </script>
@endpush
