<!-- Edit Modal -->
<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('service-category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="form-group">
                        <label for="category_name_{{ $category->id }}">Category Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="category_name" class="form-control"
                                    id="category_name_{{ $category->id }}" value="{{ $category->category_name }}"
                                    required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="status_{{ $category->id }}">Status</label>
                        <select name="status" id="status_{{ $category->id }}" class="form-control show-tick">
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
