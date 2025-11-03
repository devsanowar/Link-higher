 <!-- Modal -->
 <div class="modal fade" id="createServiceCategoryModal" tabindex="-1" role="dialog"
     aria-labelledby="createServiceCategoryModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-md" role="document"> <!-- modal-lg optional -->
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="createServiceCategoryModalLabel">Create Category</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <!-- এখানে তুমি form যোগ করবে পরে -->
                 <form id="addServiceForm" method="POST" enctype="multipart/form-data">
                     @csrf

                     {{-- Service Title --}}
                     <div class="row clearfix">
                         <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                             <label for="category_name">Category Name <strong class="text-danger">*</strong></label>
                         </div>
                         <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                             <div class="form-group">
                                 <div class="form-line">
                                     <input type="text" id="category_name" name="category_name"
                                         class="form-control @error('category_name') is-invalid @enderror"
                                         placeholder="Category Name" value="{{ old('service_title') }}" required>
                                 </div>
                                 @error('category_name')
                                     <span class="text-danger small">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>


                     {{-- Status --}}
                     <div class="row clearfix">
                         <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                             <label for="status">Status</label>
                         </div>
                         <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                             <div class="form-group">
                                 <select id="status" name="status" class="form-control show-tick">
                                     <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                         Active</option>
                                     <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>
                                         Inactive</option>
                                 </select>

                                 @error('status')
                                     <span class="text-danger small">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>

                     {{-- Submit --}}
                     <div class="row clearfix">
                         <div class="col-lg-12 d-flex justify-content-end">
                             <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                 <span id="btnText">CREATE CATEGORY</span>
                                 <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
