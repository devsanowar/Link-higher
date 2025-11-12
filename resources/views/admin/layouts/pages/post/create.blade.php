@extends('admin.layouts.app')
@section('title', 'Create Post')
@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <style>
        /* editor editable area ke native-textarea moto resize-able kore dilam */
        .ck-editor__editable_inline {
            /* minimum height will be set dynamically from rows, but keep fallback */
            min-height: 180px;
            max-height: 900px;
            /* optional: max limit so it won't grow forever */
            overflow: auto;
            /* show scrollbar when content exceed height */
            resize: vertical;
            /* enable bottom-right drag to resize vertically */
        }

        /* optional: make outer editor container not overflow when resized */
        .ck-editor {
            max-width: 100%;
        }
    </style>
@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Add Post</h4>
                        <a href="{{ route('post.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> All Posts
                        </a>
                    </div>

                    <div class="body table-responsive">
                        <form id="addPostForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('post.store') }}">
                            @csrf

                            {{-- Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 form-control-label">
                                    <label for="title">Title <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group" style="border:1px solid #ddd; padding:0 10px">
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Post title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- Excerpt --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 form-control-label">
                                    <label for="excerpt">Excerpt</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <textarea style="border:1px solid #ddd; padding:0 10px" name="excerpt" id="excerpt" rows="3"
                                            class="form-control" placeholder="Short excerpt...">{{ old('excerpt') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Content (WYSIWYG) --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 form-control-label">
                                    <label for="long_description">Content <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <textarea name="long_description" id="customCKEditor" rows="5" class="form-control"
                                            placeholder="Write post content...">{{ old('long_description') }}</textarea>

                                        @error('long_description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 form-control-label">
                                    <label for="category_id">Category</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <select id="category_id" name="category_id" class="form-control show-tick">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Featured Image --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 form-control-label">
                                    <label for="featured_image">Featured Image</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <input type="file" id="featured_image" name="featured_image" class="form-control"
                                            accept="image/*" style="border:1px solid #ccc; padding-left:10px;">
                                        <img id="previewImage" src="#" alt="Preview Image"
                                            class="mt-2 border rounded d-none" width="150">
                                    </div>
                                </div>
                            </div>

                            {{-- Meta title & description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 form-control-label">
                                    <label for="meta_title">Meta Title</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" id="meta_title" name="meta_title" class="form-control"
                                        value="{{ old('meta_title') }}" placeholder="SEO meta title...">
                                </div>
                            </div>

                            <div class="row clearfix mt-2">
                                <div class="col-lg-3 form-control-label">
                                    <label for="meta_description">Meta Description</label>
                                </div>
                                <div class="col-lg-9">
                                    <textarea name="meta_description" id="meta_description" rows="2" class="form-control"
                                        placeholder="SEO meta description...">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="row clearfix mt-2">
                                <div class="col-lg-3 form-control-label">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-lg-9">
                                    <select id="status" name="status" class="form-control show-tick">
                                        <option value="1" {{ old('status', 0) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status', 0) == 0 ? 'selected' : '' }}>DeActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix mt-3">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">CREATE POST</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
    // make editor instance global so we can use it in submit/reset handlers
    let ckEditorInstance = null;

    window.addEventListener('load', function() {
        const textarea = document.querySelector('#customCKEditor');

        ClassicEditor
            .create(textarea, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                    'bulletedList', 'numberedList', 'blockQuote', '|',
                    'insertTable', 'undo', 'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .then(editor => {
                ckEditorInstance = editor;

                // set initial height so it doesn't collapse
                const editable = editor.ui.view.editable.element;
                editable.style.minHeight = '240px';
                editable.style.overflow = 'auto';
            })
            .catch(error => {
                console.error(error);
            });
    });

    // Image preview (keep as before)
    (function() {
        const input = document.getElementById('featured_image');
        const preview = document.getElementById('previewImage');
        if (input && preview) {
            input.addEventListener('change', function() {
                const file = this.files?.[0];
                if (!file) {
                    preview.src = '#';
                    preview.classList.add('d-none');
                    return;
                }
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            });
        }
    })();

    $(document).ready(function() {
        $("#addPostForm").submit(function(e) {
            e.preventDefault();

            // --- IMPORTANT: sync CKEditor data into textarea BEFORE creating FormData ---
            if (ckEditorInstance) {
                // put editor data into the underlying textarea so FormData picks it up
                $('#customCKEditor').val( ckEditorInstance.getData() );
            }

            let formElement = this;
            let formData = new FormData(formElement);

            // UI feedback
            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        // Reset native form fields
                        $("#addPostForm")[0].reset();

                        // Reset CKEditor content
                        if (ckEditorInstance) {
                            ckEditorInstance.setData(''); // clears the editor UI and internal data
                        }

                        // Reset select (category) and trigger change if any select plugin listens
                        $('#category_id').val('').trigger('change');

                        // Clear file input (featured image) and hide preview
                        $('#featured_image').val('');
                        $('#previewImage').attr('src', '#').addClass('d-none');

                        toastr.success(response.message || 'Post created successfully');
                        if (response.redirectUrl) {
                            // optional redirect if server returns one
                            window.location.href = response.redirectUrl;
                        }
                    } else {
                        toastr.error(response.message ?? 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // validation errors
                        const errors = xhr.responseJSON.errors || {};
                        // show each error via toastr and optionally focus first invalid
                        let firstKey = null;
                        $.each(errors, function(key, value) {
                            if (!firstKey) firstKey = key;
                            toastr.error(value[0]);
                        });

                        // If the validation was about long_description, ensure the editor still shows content.
                        // (We already synced editor -> textarea before submit.)
                        if (firstKey) {
                            // map server field names to form inputs if you want to focus:
                            if (firstKey === 'long_description') {
                                // focus CKEditor editable
                                if (ckEditorInstance) {
                                    ckEditorInstance.editing.view.focus();
                                }
                            } else {
                                const field = $('[name="'+firstKey+'"]');
                                if (field.length) field.focus();
                            }
                        }
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                },
                complete: function() {
                    // restore button
                    $('#btnText').text('CREATE POST');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
    });
</script>

@endpush
