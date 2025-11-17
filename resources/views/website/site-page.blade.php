@extends('website.layouts.app')
@section('title', 'Site Page')
@section('page_id', 'site-page')

@push('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('website_content')

    <section id="service-page-breadcrumb" class="container">
        <div class="breadcrumb-container">
            <h2 class="breadcrumb-title">Our Sites</h2>
            <ul class="breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><span>›</span></li>
                <li class="active">Site</li>
            </ul>
        </div>
    </section>


    <section id="site-page-data-table">
        <div class="container">
            <div class="site-page-title">
                <h4 class="mb-3" style="color:#0d6efd;">Our Sites</h4>
            </div>

            <div class="responsive-table-wrapper">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="tabler-head-design">
                        <tr>
                            <th>ID</th>
                            <th>Website Name</th>
                            <th>Website Url</th>
                            <th>Moz DA</th>
                            <th>Moz PA</th>
                            <th>Ahrefs DR</th>
                            <th>Traffic</th>
                            {{-- <th>Niche</th> --}}
                            <th>G News</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody class="data-table-body">
                        @forelse ($sites as $key => $site)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $site->product_name ?? '' }}</td>
                                <td>{{ $site->website_url ?? '' }}</td>
                                <td>{{ $site->moz_da ?? '' }}</td>
                                <td>{{ $site->moz_pa ?? '' }}</td>
                                <td>{{ $site->ahrefs_dr ?? '' }}</td>
                                <td>{{ $site->traffic ?? '' }}</td>
                                <td>
                                    @if ($site->news == 1)
                                        <span class="custom-badge custom-badge-success">YES</span>
                                    @else
                                        <span class="custom-badge custom-badge-danger">NO</span>
                                    @endif
                                </td>

                                <td><a href="{{ route('contact.page') }}">Contact</a></td>
                            </tr>
                        @empty
                            <tr>
                                data not found
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {

            // fix missing td's (paste this before DataTable init)
            (function() {
                var $table = $('#example');
                var thCount = $table.find('thead th').length;

                $table.find('tbody tr').each(function() {
                    var $tr = $(this);
                    var tdCount = $tr.find('td').length;
                    if (tdCount < thCount) {
                        for (var i = tdCount; i < thCount; i++) {
                            $tr.append('<td></td>');
                        }
                    }
                });
            })();



            $('#example').DataTable({
                "pageLength": 20,
                "lengthMenu": [20, 25, 50, 100],
                "order": [
                    [0, "asc"]
                ],
            });
        });
    </script>
@endpush
