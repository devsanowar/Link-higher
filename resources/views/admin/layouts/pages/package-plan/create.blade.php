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

                        {{-- Subtitle --}}
                        <div class="row mb-3">
                            <div class="col-lg-3 form-control-label">
                                <label for="subtitle">Subtitle <strong class="text-danger">*</strong></label>
                            </div>
                            <div class="col-lg-9">
                                <textarea id="subtitle" name="subtitle" rows="2"
                                          class="form-control @error('subtitle') is-invalid @enderror"
                                          placeholder="For personal use or small teams...">{{ old('subtitle') }}</textarea>
                                @error('subtitle')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- CTA text/url --}}
                        <div class="row mb-3">
                            <div class="col-lg-3 form-control-label">
                                <label for="cta_text">CTA Button Text</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" id="cta_text" name="cta_text"
                                       class="form-control" placeholder="Start 14-day trial"
                                       value="{{ old('cta_text') }}">
                            </div>
                            <div class="col-lg-5">
                                <input type="text" id="cta_url" name="cta_url"
                                       class="form-control"
                                       placeholder="{{ url('/') }}/checkout/basic"
                                       value="{{ old('cta_url') }}">
                            </div>
                        </div>

                        {{-- Trust badges --}}
                        <div class="row mb-4 align-items-center">
                            <div class="col-lg-3 form-control-label">
                                <label>Trust Badges</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="d-flex flex-wrap align-items-center gap-4">
                                    <div class="d-flex align-items-center">
                                        <label class="me-2 mb-0">Trial (days)</label>
                                        <input type="number" name="trial_days" class="form-control"
                                               style="max-width:150px;margin-left:20px"
                                               value="{{ old('trial_days', 0) }}">
                                    </div>
                                    <div class="d-flex align-items-center ml-3">
                                        <label class="me-2 mb-0">Money Back (days)</label>
                                        <input type="number" name="money_back_days" class="form-control"
                                               style="max-width:150px;margin-left:20px"
                                               value="{{ old('money_back_days', 0) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pricing --}}
                        <h5 class="mb-2">Pricing</h5>
                        <div class="row mb-3">
                            <div class="col-lg-3 form-control-label"><label>Currency</label></div>
                            <div class="col-lg-3">
                                <input type="text" name="currency" id="currency"
                                       class="form-control" value="{{ old('currency', 'USD') }}" maxlength="3">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 form-control-label"><label>Monthly Amount</label></div>
                            <div class="col-lg-3">
                                <input type="number" step="0.01" name="monthly_amount" id="monthly_amount"
                                       class="form-control" value="{{ old('monthly_amount', 0) }}">
                            </div>
                            <div class="col-lg-3 form-control-label"><label>Yearly Amount</label></div>
                            <div class="col-lg-3">
                                <input type="number" step="0.01" name="yearly_amount" id="yearly_amount"
                                       class="form-control" value="{{ old('yearly_amount', 0) }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3 form-control-label"><label>Labels</label></div>
                            <div class="col-lg-3">
                                <input type="text" name="monthly_label" id="monthly_label"
                                       class="form-control" value="{{ old('monthly_label', 'mo') }}">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="yearly_label" id="yearly_label"
                                       class="form-control" value="{{ old('yearly_label', 'yr') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 form-control-label"><label>Yearly Discount</label></div>
                            <div class="col-lg-3">
                                <input type="number" name="yearly_save_percent" id="yearly_save_percent"
                                       class="form-control" placeholder="e.g., 35"
                                       value="{{ old('yearly_save_percent') }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="yearly_save_text" id="yearly_save_text"
                                       class="form-control" placeholder="Save up to 35% with yearly billing"
                                       value="{{ old('yearly_save_text') }}">
                            </div>
                        </div>

                        {{-- Features --}}
                        <h5 class="mb-2">Features</h5>
                        <div id="featureWrapper">
                            <div class="row mb-3 featureRow">
                                <div class="col-lg-3 form-control-label"><label>Features</label></div>
                                <div class="col-lg-9 d-flex">
                                    <input type="text" class="form-control me-2" name="features[]" placeholder="Feature 1">
                                    <button type="button" class="btn btn-success addFeatureBtn">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <div class="row mb-3">
                            <div class="col-lg-3 form-control-label"><label>Badges & Order</label></div>
                            <div class="col-lg-9 d-flex gap-2">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="is_free"
                                           name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_free">Free</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="is_popular"
                                           name="is_popular" value="1" {{ old('is_popular') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_popular">Popular</label>
                                </div>
                            </div>
                        </div>

                        {{-- Position --}}
                        <div class="row mb-4">
                            <div class="col-lg-3 form-control-label"><label class="me-2">Position</label></div>
                            <div class="col-lg-9">
                                <input type="number" class="form-control" name="position"
                                       value="{{ old('position', 1) }}">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-4">
                            <div class="col-lg-3 form-control-label"><label class="me-2">Status</label></div>
                            <div class="col-lg-9">
                                <select name="is_active" class="form-control show-tick" style="max-width:140px">
                                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Inactive</option>
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
            let featureCount = 1;
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
                    refreshPreviewFeatures();
                }
            });



            // -------- AJAX Submit --------
            $('#addPlanForm').on('submit', function(e) {
                e.preventDefault();
                const fd = new FormData(this);

                // features[] to JSON
                const features = [];
                $('input[name="features[]"]').each(function() {
                    if ($(this).val().trim()) features.push($(this).val().trim());
                });
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
