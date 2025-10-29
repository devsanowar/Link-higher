@extends('admin.layouts.app')
@section('title', 'Return And Refund Policy')
@push('styles')
<style>
    .ck-editor__editable {
    resize: vertical;
    overflow: auto;
}
</style>
@endpush
@section('admin_content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Update Return And Refund Policy</h4>
                </div>
                <div class="body">
                    <form id="returnAndRefundPolicyForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="return_refund_policy"><b>Page Content</b></label>
                            <textarea rows="5" id="return_refund_policy" name="return_refund_policy">{!! $return_refund->return_refund_policy ?? '' !!}</textarea>
                        </div>

                        <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-3 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE</span>
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
window.addEventListener('load', function() {
    ClassicEditor
        .create(document.querySelector('#return_refund_policy'), {
            toolbar: [
                'heading',
                '|',
                'bold', 'italic', 'underline', 'strikethrough', 'link',
                '|',
                'bulletedList', 'numberedList', 'blockQuote',
                '|',
                'insertTable', 'undo', 'redo'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            }
        })
        .then(editor => {
            const editable = editor.ui.view.editable.element;
            editable.style.height = '300px';
            editable.style.minHeight = '300px';
            editable.style.overflow = 'auto';
        })
        .catch(error => {
            console.error(error);
        });
});
</script>


<script>
    $(document).ready(function() {
        $("#returnAndRefundPolicyForm").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $('#btnText').text('Processing...');
            $('#btnSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: "{{ route('return.refund.policy.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message || 'Return Refund updated successfully.');
                        if (response.redirect) {
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 800);
                        }
                    } else {
                        toastr.error(response.message ?? 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $('#btnText').text('UPDATED');
                    $('#btnSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
    });
</script>


@endpush
