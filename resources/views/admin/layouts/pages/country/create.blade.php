<!-- Modal -->
<div class="modal fade" id="createCountryModal" tabindex="-1" role="dialog"
    aria-labelledby="createCountryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document"> <!-- modal-lg optional -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCountryModalLabel">Create Country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- form -->
                <form id="addCountryForm" action="{{ route('country.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Country Name --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="country_name">Country Name <strong class="text-danger">*</strong></label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="country_name" name="country_name"
                                        class="form-control @error('country_name') is-invalid @enderror"
                                        placeholder="Country Name" value="{{ old('country_name') }}" required>
                                </div>
                                @error('country_name')
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
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>
                                        Inactive</option>
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
                            <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitCountryBtn">
                                <span id="btnCountryText">CREATE COUNTRY</span>
                                <span id="btnCountrySpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- /form -->
            </div>
        </div>
    </div>
</div>
