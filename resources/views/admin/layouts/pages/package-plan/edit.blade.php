@extends('admin.layouts.app')
@section('title', 'Edit Package Plan')

@push('styles')
<link href="{{ asset('backend/assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<style>
    .plan-preview .card {
        max-width: 420px;
        margin-left: auto;
        margin-right: auto
    }
    .plan-preview .price {
        font-size: 2.2rem;
        font-weight: 700;
        line-height: 1
    }
    .text-muted-70 { color: #6c757d; opacity: .9 }
</style>
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

                {{-- Hidden ID --}}
                <input type="hidden" name="id" id="plan_id" value="{{ $plan->id }}">

                <div class="row clearfix">
                    <div class="col-lg-8">
                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name">Plan Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ $plan->name }}" required>
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                   value="{{ $plan->slug }}" required>
                        </div>

                        {{-- Subtitle --}}
                        <div class="mb-3">
                            <label for="subtitle">Subtitle</label>
                            <textarea id="subtitle" name="subtitle" rows="2"
                                class="form-control">{{ $plan->subtitle }}</textarea>
                        </div>

                        {{-- CTA --}}
                        <div class="mb-3">
                            <label for="cta_text">CTA Button Text</label>
                            <input type="text" id="cta_text" name="cta_text" class="form-control"
                                   value="{{ $plan->cta_text }}">
                        </div>
                        <div class="mb-3">
                            <label for="cta_url">CTA URL</label>
                            <input type="text" id="cta_url" name="cta_url" class="form-control"
                                   value="{{ $plan->cta_url }}">
                        </div>

                        {{-- Pricing --}}
                        <hr>
                        <h5>Pricing</h5>
                        <div class="mb-3">
                            <label for="currency">Currency</label>
                            <input type="text" id="currency" name="currency" class="form-control"
                                   value="{{ $plan->currency }}">
                        </div>

                        <div class="mb-3">
                            <label for="monthly_amount">Monthly Amount</label>
                            <input type="number" step="0.01" id="monthly_amount" name="monthly_amount"
                                   class="form-control" value="{{ $plan->monthly_amount }}">
                        </div>

                        <div class="mb-3">
                            <label for="yearly_amount">Yearly Amount</label>
                            <input type="number" step="0.01" id="yearly_amount" name="yearly_amount"
                                   class="form-control" value="{{ $plan->yearly_amount }}">
                        </div>

                        <div class="mb-3">
                            <label for="yearly_save_percent">Yearly Discount (%)</label>
                            <input type="number" id="yearly_save_percent" name="yearly_save_percent"
                                   class="form-control" value="{{ $plan->yearly_save_percent }}">
                        </div>

                        <div class="mb-3">
                            <label for="yearly_save_text">Discount Text</label>
                            <input type="text" id="yearly_save_text" name="yearly_save_text"
                                   class="form-control" value="{{ $plan->yearly_save_text }}">
                        </div>

                        {{-- Features --}}
                        <hr>
                        <h5>Features</h5>
                        <div id="featureWrapper">
                            @php
                                $features = json_decode($plan->features, true) ?? [];
                            @endphp
                            @forelse ($features as $f)
                                <div class="d-flex mb-2 featureRow">
                                    <input type="text" class="form-control me-2" name="features[]" value="{{ $f }}">
                                    <button type="button" class="btn btn-danger removeFeatureBtn">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </div>
                            @empty
                                <div class="d-flex mb-2 featureRow">
                                    <input type="text" class="form-control me-2" name="features[]" placeholder="Feature 1">
                                    <button type="button" class="btn btn-success addFeatureBtn"><i class="zmdi zmdi-plus"></i></button>
                                </div>
                            @endforelse
                        </div>

                        {{-- Position & Status --}}
                        <div class="mb-3 mt-3">
                            <label for="position">Position</label>
                            <input type="number" id="position" name="position" class="form-control"
                                   value="{{ $plan->position }}">
                        </div>
                        <div class="mb-3">
                            <label for="is_active">Status</label>
                            <select id="is_active" name="is_active" class="form-control show-tick">
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

                    {{-- Preview --}}
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="plan-preview">
                            <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                                <span class="text-muted-70">Billed monthly</span>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" id="previewToggle">
                                    <label class="form-check-label ms-2 text-muted-70"
                                           for="previewToggle">Billed yearly</label>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 id="pv_name" class="fw-bold">{{ $plan->name }}</h5>
                                    <div id="pv_subtitle" class="text-muted-70">{{ $plan->subtitle }}</div>

                                    <div class="d-flex align-items-end gap-1 mt-3">
                                        <span class="h5 mb-1">$</span>
                                        <span class="price" id="pv_amount">{{ $plan->monthly_amount }}</span>
                                        <span class="fs-6">/</span>
                                        <span class="fs-6" id="pv_label">mo</span>
                                    </div>

                                    <div id="pv_save" class="text-primary small mt-1 d-none">
                                        {{ $plan->yearly_save_text }}
                                    </div>

                                    <button type="button" class="btn btn-primary w-100 mt-3" id="pv_cta">
                                        {{ $plan->cta_text ?? 'Button text' }}
                                    </button>

                                    <ul class="mt-3 mb-0 small" id="pv_features">
                                        @foreach ($features as $f)
                                            <li>{{ $f }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
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
(function(){

    // ======== SLUG AUTO GENERATE ========
    $('#name').on('input', function(){
        $('#slug').val($(this).val().toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,''));
    });

    // ======== DYNAMIC FEATURE ADD/REMOVE ========
    $(document).on('click', '.addFeatureBtn', function(){
        $('#featureWrapper').append(`
            <div class="d-flex mb-2 featureRow">
                <input type="text" class="form-control me-2" name="features[]" placeholder="Feature">
                <button type="button" class="btn btn-danger removeFeatureBtn"><i class="zmdi zmdi-delete"></i></button>
            </div>`);
        refreshPreviewFeatures();
    });

    $(document).on('click', '.removeFeatureBtn', function(){
        $(this).closest('.featureRow').remove();
        refreshPreviewFeatures();
    });

    // ======== PREVIEW FUNCTIONS ========

    const fields = [
        'name','subtitle','cta_text','monthly_amount','yearly_amount',
        'monthly_label','yearly_label','yearly_save_text','currency'
    ];

    fields.forEach(id => {
        const el = document.getElementById(id);
        if(!el) return;
        el.addEventListener('input', refreshPreview);
    });

    $('#is_popular, #previewToggle').on('change', refreshPreview);
    $('#featureWrapper').on('input', 'input[name="features[]"]', refreshPreviewFeatures);

    function currencySymbol(){
        const cur = ($('#currency').val() || 'USD').toUpperCase();
        return cur === 'BDT' ? '৳' : (cur === 'EUR' ? '€' : '$');
    }

    function refreshPreview(){
        const yearly = $('#previewToggle').is(':checked');

        // name, subtitle, CTA
        $('#pv_name').text($('#name').val() || 'Plan name');
        $('#pv_subtitle').text($('#subtitle').val() || 'Subtitle will appear here…');
        $('#pv_cta').text($('#cta_text').val() || 'Button text');

        // popular badge
        $('#pv_popular').toggleClass('d-none', !$('#is_popular').is(':checked'));

        // price & label
        const amt = yearly ? parseFloat($('#yearly_amount').val() || 0) : parseFloat($('#monthly_amount').val() || 0);
        const label = yearly ? ($('#yearly_label').val() || 'yr') : ($('#monthly_label').val() || 'mo');

        $('#pv_amount').text(isNaN(amt) ? '0' : (amt % 1 === 0 ? amt.toFixed(0) : amt.toFixed(2)));
        $('#pv_label').text(label);
        $('.plan-preview .h5').text(currencySymbol());

        // save text
        const saveText = $('#yearly_save_text').val() || '';
        $('#pv_save').text(saveText).toggleClass('d-none', !yearly || !saveText);
    }

    function refreshPreviewFeatures(){
        const list = $('#pv_features');
        list.empty();
        $('input[name="features[]"]').each(function(){
            if($(this).val().trim()){
                list.append(`<li>${$(this).val().trim()}</li>`);
            }
        });
    }

    // ======== INITIAL PREVIEW ========
    refreshPreview();
    refreshPreviewFeatures();

    // ======== AJAX UPDATE ========
    $('#editPlanForm').on('submit', function(e){
        e.preventDefault();
        let fd = new FormData(this);

        // convert features to JSON
        const features = [];
        $('input[name="features[]"]').each(function(){
            if($(this).val().trim()) features.push($(this).val().trim());
        });
        fd.delete('features[]');
        fd.append('features', JSON.stringify(features));

        $('#btnText').text('Updating...');
        $('#btnSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);

        $.ajax({
            url: "{{ route('package_plans.update', $plan->id) }}",
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.status === 'success'){
                    Swal.fire('Updated!', res.message ?? 'Plan updated successfully.', 'success');
                } else {
                    Swal.fire('Error', res.message ?? 'Something went wrong!', 'error');
                }
            },
            error: function(xhr){
                let msg = 'Unexpected error';
                if(xhr.status === 422){
                    msg = Object.values(xhr.responseJSON.errors).map(v=>v[0]).join('\n');
                }
                Swal.fire('Validation Error', msg, 'error');
            },
            complete: function(){
                $('#btnText').text('UPDATE PLAN');
                $('#btnSpinner').addClass('d-none');
                $('#submitBtn').prop('disabled', false);
            }
        });
    });

})();
</script>
@endpush

