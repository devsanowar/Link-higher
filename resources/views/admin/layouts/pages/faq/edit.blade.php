@extends('admin.layouts.app')
@section('title', 'Edit FAQ')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit FAQ</h4>

                        <a href="{{ route('faqs.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All FAQ
                        </a>
                    </div>

                    <div class="card-body">
                        <form id="EditFAQForm" method="POST" action="{{ route('faqs.update', $faq->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Question --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="question">Question <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                type="text"
                                                id="question"
                                                name="question"
                                                class="form-control @error('question') is-invalid @enderror"
                                                placeholder="Enter question"
                                                value="{{ old('question', $faq->question) }}"
                                                required
                                            >
                                        </div>
                                        @error('question')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Answer --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="answer">Answer <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea
                                                id="answer"
                                                name="answer"
                                                class="form-control @error('answer') is-invalid @enderror"
                                                rows="4"
                                                placeholder="Answer..."
                                                required
                                            >{{ old('answer', $faq->answer) }}</textarea>
                                        </div>
                                        @error('answer')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="status" name="status" class="form-control show-tick">
                                            <option value="1" {{ old('status', $faq->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $faq->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE FAQ</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> {{-- card-body --}}
                </div>
            </div>
        </div>
    </div>
@endsection

