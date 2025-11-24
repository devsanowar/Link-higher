<!-- Create Partner Site Modal -->
<div class="modal fade" id="createPartnerSiteModal" tabindex="-1" role="dialog" aria-labelledby="createPartnerSiteLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('partner-sites.store') }}" method="POST">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="createPartnerSiteLabel">Add New Partner Site</h5>
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
                                placeholder="Enter site name">
                        </div>
                        @error('site_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Site URL <span class="text-danger">*</span></label>
                        <div class="form-line">
                            <input type="text" name="site_url"
                                class="form-control @error('site_url') is-invalid @enderror"
                                placeholder="https://example.com">
                        </div>
                        @error('site_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control show-tick @error('status') is-invalid @enderror">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>
