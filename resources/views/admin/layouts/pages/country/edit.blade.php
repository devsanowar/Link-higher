<!-- Edit Modal -->
<div class="modal fade" id="editCountryModal{{ $country->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCountryModalLabel{{ $country->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editCountryModalLabel{{ $country->id }}">Edit Country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('country.update', $country->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    {{-- Country Name --}}
                    <div class="form-group">
                        <label for="country_name_{{ $country->id }}">Country Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="country_name" class="form-control"
                                    id="country_name_{{ $country->id }}" value="{{ $country->country_name }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status_{{ $country->id }}">Status</label>
                        <select name="status" id="status_{{ $country->id }}" class="form-control show-tick">
                            <option value="0" {{ $country->status == 0 ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ $country->status == 1 ? 'selected' : '' }}>Active</option>
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
