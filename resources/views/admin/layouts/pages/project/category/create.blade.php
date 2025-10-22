<div class="modal fade" id="createProjectCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="createProjectCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="createProjectCategoryForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProjectCategoryLabel">Add Project Category</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="pc_name">Name <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="pc_name" name="name"
                                    placeholder="e.g. Web Development" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="pc_slug">Slug <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="pc_slug" name="slug"
                                    placeholder="e.g. web-development" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pc_status">Status</label>
                    <select id="pc_status" name="status" class="form-control show-tick" data-width="100%">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" id="pcSubmitBtn" class="btn btn-primary">
                    <span id="pcBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                    <span id="pcBtnText">Create</span>
                </button>
            </div>
    </div>
    </form>
</div>
</div>
