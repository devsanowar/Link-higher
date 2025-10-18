@extends('admin.layouts.app')
@section('title', 'Create Mission & Vision')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Mission & Vision</h4>
                    </div>

                    <div class="card-body">
                        <form id="AddMissionVisionForm" method="POST">
                            @csrf
                            @method("PUT")

                            {{-- Mission Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="mission_title">Mission Title</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="text"
                                                id="mission_title"
                                                name="mission_title"
                                                class="form-control @error('mission_title') is-invalid @enderror"
                                                placeholder="Enter mission title"
                                                value="{{ $missionAndVission->mission_title ?? '' }}"
                                            >
                                        </div>
                                        @error('mission_title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Vision Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="vision_title">Vision Title</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="text"
                                                id="vision_title"
                                                name="vision_title"
                                                class="form-control @error('vision_title') is-invalid @enderror"
                                                placeholder="Enter vision title"
                                                value="{{ $missionAndVission->vision_title ?? '' }}"
                                            >
                                        </div>
                                        @error('vision_title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Mission Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="mission">Mission Description</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea
                                                id="mission"
                                                name="mission"
                                                class="form-control @error('mission') is-invalid @enderror"
                                                rows="5"
                                                placeholder="Write the mission details (optional)"
                                            >{!! $missionAndVission->mission ?? '' !!}</textarea>
                                        </div>
                                        @error('mission')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Vision Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="vision">Vision Description</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea
                                                id="vision"
                                                name="vision"
                                                class="form-control @error('vision') is-invalid @enderror"
                                                rows="5"
                                                placeholder="Write the vision details (optional)"
                                            >{!! $missionAndVission->vision ?? '' !!}</textarea>
                                        </div>
                                        @error('vision')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        $("#AddMissionVisionForm").on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: "{{ route('about-page.mission-vision.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status === 'success') {
                        toastr.success(res.message || 'Mission & Vision updated successfully.');
                    } else {
                        toastr.error(res.message ?? 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        $.each(xhr.responseJSON.errors, function(k, v){
                            toastr.error(v[0]);
                        });
                    } else {
                        toastr.error(xhr.responseJSON?.message || 'Unexpected error.');
                    }
                },
                complete: function() {
                    $('#btnText').text('UPDATED');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                    setTimeout(() => $('#btnText').text('UPDATE'), 2000);
                }
            });
        });
    });
</script>
@endpush
