<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
      </div>

      <form id="editCategoryForm" action="#" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          {{-- Category Name --}}
          <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
              <label for="edit_cat_name">Category Name</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="edit_cat_name" name="category_name" class="form-control" required>
                </div>
              </div>
            </div>
          </div>

          {{-- Slug --}}
          <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
              <label for="edit_cat_slug">Slug</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
              <div class="form-group">
                <div class="form-line">
                  <input type="text" id="edit_cat_slug" name="category_slug" class="form-control">
                </div>
              </div>
            </div>
          </div>

          {{-- Status --}}
          <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
              <label for="edit_cat_status">Status</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
              <div class="form-group">
                <div class="form-line">
                  <select id="edit_cat_status" name="status" class="form-control show-tick" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /modal-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
      </form>

    </div>
  </div>
</div>
