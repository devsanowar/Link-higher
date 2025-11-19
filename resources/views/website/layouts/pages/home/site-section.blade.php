<section id="site-page-data-table">
        <div class="container">
            <div class="site-page-title" style="margin-block: 20px;">
                <h4 class="mb-3" style="color:#0d6efd;">Our Sites</h4>
            </div>

            <div class="responsive-table-wrapper">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead class="tabler-head-design" style="background: linear-gradient(135deg, #5229f2, #a91063);">
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
            <div class="text-center my-4 site-button">
            <a href="{{ route('site.page') }}" class="btn btn-primary btn-lg custom-arrow-btn" style="margin-top: 0">
                More Site
                <span class="arrow"></span>
            </a>
        </div>
        </div>
    </section>
