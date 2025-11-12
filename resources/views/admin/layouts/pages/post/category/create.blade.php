<!-- Create Post Category Modal -->
<div class="modal fade" id="createPostCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createPostCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document"> <!-- modal-lg optional -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Post Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="addPostCategoryForm" action="{{ route('post-category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{-- Category Name --}}
                    <div class="row clearfix mb-2">
                        <div class="col-12">
                            <label for="category_name">Category Name <strong class="text-danger">*</strong></label>
                            <input type="text" id="category_name" name="category_name" class="form-control @error('category_name') is-invalid @enderror" placeholder="Category Name" value="{{ old('category_name') }}" required>
                            @error('category_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Category Slug --}}
                    <div class="row clearfix mb-2">
                        <div class="col-12">
                            <label for="category_slug">Category Slug</label>
                            <input type="text" id="category_slug" name="category_slug" class="form-control @error('category_slug') is-invalid @enderror" placeholder="category-slug" value="{{ old('category_slug') }}">
                            <small class="text-muted">Auto generated from name, you can edit.</small>
                            @error('category_slug')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row clearfix mb-2">
                        <div class="col-12">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control show-tick">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
