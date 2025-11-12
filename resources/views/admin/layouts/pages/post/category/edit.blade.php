<!-- Edit Modal for a single category -->
<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('post-category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- Category Name --}}
                    <div class="form-group">
                        <label for="category_name_{{ $category->id }}">Category Name <strong class="text-danger">*</strong></label>
                        <input style="border:1px solid #ddd; padding: 0 10px" type="text" id="category_name_{{ $category->id }}" name="category_name" data-id="{{ $category->id }}"
                               class="form-control edit-category-name @error('category_name') is-invalid @enderror"
                               placeholder="Category Name" value="{{ old('category_name', $category->category_name) }}" required>
                        @error('category_name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Category Slug --}}
                    <div class="form-group">
                        <label for="category_slug_{{ $category->id }}">Category Slug</label>
                        <input style="border:1px solid #ddd; padding: 0 10px" type="text" id="category_slug_{{ $category->id }}" name="category_slug"
                               class="form-control @error('category_slug') is-invalid @enderror"
                               placeholder="category-slug" value="{{ old('category_slug', $category->category_slug) }}">
                        <small class="text-muted">Auto generated from name, you can edit.</small>
                        @error('category_slug')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status_{{ $category->id }}">Status</label>
                        <select id="status_{{ $category->id }}" name="status" class="form-control show-tick">
                            <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
