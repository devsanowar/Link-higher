<div class="modal fade" id="editProjectCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="editProjectCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editProjectCategoryForm" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectCategoryLabel">Edit Project Category</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_pc_name">Name <span class="text-danger">*</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" id="edit_pc_name" name="name" required>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="edit_pc_slug">Slug <span class="text-danger">*</span></label>
                        <div class="form-line">
                            <input type="text" class="form-control" id="edit_pc_slug" name="slug" required>
                        </div>

                        <small class="text-muted">Adjust if necessary; will stay synced with name until you edit
                            slug.</small>
                    </div>

                    <div class="form-group">
                        <label for="edit_pc_status">Status</label>
                        <select id="edit_pc_status" name="status" class="form-control show-tick" data-width="100%">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>
