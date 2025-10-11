@extends('admin.layouts.app')
@section('title', 'Services')
@section('admin_content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">All Services</h4>

                        <a href="{{ route('services.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Services
                        </a>
                    </div>


                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $key => $service)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            @php
                                                $rel = ltrim($service->image ?? '', '/');
                                                $abs = $rel ? public_path($rel) : null;
                                                $fallback = asset('backend/assets/images/user.jpg');
                                            @endphp

                                            <img src="{{ !empty($rel) && $rel !== 'default.jpg' && file_exists($abs) ? asset($rel) : $fallback }}"
                                                alt="Services Image" width="48">
                                        </td>

                                        <td>{{ $service->service_title ?? '' }}</td>
                                        <td class="text-center">
                                            <!-- Edit Link -->
                                            <a href="" class="btn btn-sm btn-icon btn-info" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <!-- Delete Link -->
                                            <form action="" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-danger deleteBtn"
                                                data-id="{{ $service->id }}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Bordered Table -->
    </div>
@endsection
