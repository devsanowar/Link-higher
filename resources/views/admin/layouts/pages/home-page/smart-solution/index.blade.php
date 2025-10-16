@extends('admin.layouts.app')
@section('title', 'Smart Solution')

@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Smart Solution and real time result</h4>
                    </div>
                    <div class="card-body">
                        <form id="updateSmartSolutionForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Title --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="title">Title <strong class="text-danger">*</strong></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="title" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter title"
                                                value="{{ old('title', $smartSolution->title ?? '') }}" required>
                                        </div>
                                        @error('title')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Subtitle --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="subtitle">Subtitle</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="subtitle" name="subtitle"
                                                class="form-control @error('subtitle') is-invalid @enderror"
                                                placeholder="Enter subtitle"
                                                value="{{ old('subtitle', $smartSolution->subtitle ?? '') }}">
                                        </div>
                                        @error('subtitle')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea id="description" name="description" rows="5"
                                                class="form-control @error('description') is-invalid @enderror" placeholder="Write description...">{{ old('description', $smartSolution->description ?? '') }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image One --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image_one">Image One</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image_one" name="image_one" accept="image/*"
                                                class="form-control @error('image_one') is-invalid @enderror">
                                        </div>
                                        @error('image_one')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Preview --}}
                                        @php
                                            $img1 = !empty($smartSolution->image_one)
                                                ? asset($smartSolution->image_one)
                                                : '#';
                                            $hasImg1 = !empty($smartSolution->image_one);
                                        @endphp
                                        <div class="mt-3">
                                            <img id="imageOnePreview" src="{{ $hasImg1 ? $img1 : '#' }}"
                                                alt="Image One Preview"
                                                class="img-fluid rounded shadow-sm {{ $hasImg1 ? '' : 'd-none' }}"
                                                style="max-width:200px;border:1px solid #ddd;padding:4px;">
                                        </div>
                                        <small class="text-muted d-block mt-2">Allowed: JPG, PNG, GIF, SVG, WebP •
                                            Suggestion: &lt;1MB</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Image Two --}}
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image_two">Image Two</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="image_two" name="image_two" accept="image/*"
                                                class="form-control @error('image_two') is-invalid @enderror">
                                        </div>
                                        @error('image_two')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                        {{-- Preview --}}
                                        @php
                                            $img2 = !empty($smartSolution->image_two)
                                                ? asset($smartSolution->image_two)
                                                : '#';
                                            $hasImg2 = !empty($smartSolution->image_two);
                                        @endphp
                                        <div class="mt-3">
                                            <img id="imageTwoPreview" src="{{ $hasImg2 ? $img2 : '#' }}"
                                                alt="Image Two Preview"
                                                class="img-fluid rounded shadow-sm {{ $hasImg2 ? '' : 'd-none' }}"
                                                style="max-width:200px;border:1px solid #ddd;padding:4px;">
                                        </div>
                                        <small class="text-muted d-block mt-2">Allowed: JPG, PNG, GIF, SVG, WebP •
                                            Suggestion: &lt;1MB</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="row clearfix">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5 rounded-0" id="submitBtn">
                                        <span id="btnText">UPDATE</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4> All Solution Feature </h4>
                        <a href="{{ route('home.goal-progress-insight.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Insight
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($items as $key => $gp)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>
                                                <img src="{{ asset($gp->image ?? '') }}" alt="Goal Image" width="60"
                                                    class="rounded border">
                                            </td>

                                            <td>{{ $gp->title ?? '' }}</td>

                                            <td>{{ Str::limit(strip_tags($gp->description ?? ''), 60, '...') }}</td>

                                            <td>
                                                @if ((int) ($gp->status ?? 0) === 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('home.goal-progress-insight.edit', $gp->id) }}"
                                                    class="btn btn-info btn-sm" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('home.goal-progress-insight.destroy', $gp->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger deleteBtn">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (method_exists($items, 'links'))
                                <div class="mt-3">
                                    {{ $items->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteBtn', function() {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            // Live preview: Image One
            $('#image_one').on('change', function(e) {
                const file = e.target.files[0];
                const $img = $('#imageOnePreview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = ev => $img.attr('src', ev.target.result).removeClass('d-none').hide()
                        .fadeIn(200);
                    reader.readAsDataURL(file);
                }
            });

            // Live preview: Image Two
            $('#image_two').on('change', function(e) {
                const file = e.target.files[0];
                const $img = $('#imageTwoPreview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = ev => $img.attr('src', ev.target.result).removeClass('d-none').hide()
                        .fadeIn(200);
                    reader.readAsDataURL(file);
                }
            });


            $("#updateSmartSolutionForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $('#btnText').text('Processing...');
                $('#btnSpinner').removeClass('d-none');
                $('#submitBtn').prop('disabled', true);

                $.ajax({
                    url: "{{ route('home.smart-solution.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'Goal created successfully.');
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
