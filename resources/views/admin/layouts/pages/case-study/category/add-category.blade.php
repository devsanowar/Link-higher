<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="createCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    {{-- Category Name --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="cat_name">Category Name <strong class="text-danger">*</strong></label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="cat_name" name="category_name"
                                        class="form-control @error('category_name') is-invalid @enderror"
                                        placeholder="e.g., Technology" value="{{ old('category_name') }}" required>
                                </div>
                                @error('category_name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Slug (auto) --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="cat_slug">Slug</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="cat_slug" name="category_slug"
                                        class="form-control @error('category_slug') is-invalid @enderror"
                                        placeholder="auto-generated (you can edit)" value="{{ old('category_slug') }}">
                                </div>

                                @error('category_slug')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="cat_status">Status</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">

                                    <select id="cat_status" name="status"
                                        class="form-control show-tick @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>

                                @error('status')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" id="catSubmitBtn" class="btn btn-primary">
                        <span id="catBtnText">Create</span>
                        <span id="catBtnSpinner" class="spinner-border spinner-border-sm d-none ml-2"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
