<!-- Edit Partner Site Modal -->
<div class="modal fade" id="editPartnerSiteModal-{{ $site->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editPartnerSiteLabel-{{ $site->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('partner-sites.update', $site->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editPartnerSiteLabel-{{ $site->id }}">Edit Partner Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Site Name <span class="text-danger">*</span></label>
                        <div class="form-line">
                            <input type="text" name="site_name"
                                class="form-control @error('site_name') is-invalid @enderror"
                                value="{{ old('site_name', $site->site_name) }}" required>
                        </div>
                        @error('site_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Site URL <span class="text-danger">*</span></label>
                        <div class="form-line">
                            <input type="text" name="site_url"
                                class="form-control @error('site_url') is-invalid @enderror"
                                value="{{ old('site_url', $site->site_url) }}" required>
                        </div>
                        @error('site_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <div class="form-line">
                            <select name="status" class="form-control show-tick @error('status') is-invalid @enderror" required>
                                <option value="1" {{ old('status', $site->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $site->status) == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>
