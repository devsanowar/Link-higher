@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')
@section('admin_content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard
                    <small class="text-muted">Welcome to {{ $website_settings->website_title ?? 'Link Higher' }}
                        Application</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" target="__blank"><i class="zmdi zmdi-home"></i>
                            Home</a></li>
                    <li class="breadcrumb-item active">Dashboard </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob dial1" value="66" data-width="90" data-height="90" data-thickness="0.2" data-fgColor="#00ced1" readonly>
                        <h6 class="m-t-20">Satisfaction Rate</h6>
                        <small class="displayblock">47% Average <i class="zmdi zmdi-trending-up"></i></small>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#00ced1">5,8,3,4,8,9,7,2,9,5</div>
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($deliveryRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#00c851" readonly>

                        <h6 class="m-t-20">Delivery Success Rate</h6>

                        <small class="displayblock">
                            {{ $deliveredOrders }} Delivered out of {{ $totalOrderCount }}
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#00c851">
                            5,7,3,9,8,6,4,7,8,5
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($pendingRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#ffbb33" readonly>

                        <h6 class="m-t-20">Pending Orders</h6>

                        <small class="displayblock">
                            {{ $pendingOrders }} Pending out of {{ $totalOrderCount }}
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffbb33">
                            4,6,5,8,7,9,5,4,6,3
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($processingRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#33b5e5" readonly>

                        <h6 class="m-t-20">Received Orders</h6>

                        <small class="displayblock">
                            {{ $processingOrders }} Received out of {{ $totalOrderCount }}
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#33b5e5">
                            6,8,5,9,7,6,8,7,9,6
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($revenueRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#8e44ad" readonly>

                        <h6 class="m-t-20">Total Revenue</h6>

                        <small class="displayblock">
                            ৳{{ number_format($totalRevenue) }} Revenue
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#8e44ad">
                            5,8,6,9,7,8,6,7,8,9
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($orderRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#3498db" readonly>

                        <h6 class="m-t-20">Total Orders</h6>

                        <small class="displayblock">
                            {{ $totalOrderCount }} Orders
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#3498db">
                            4,7,5,8,6,9,7,6,8,7
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($userRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#2ecc71" readonly>

                        <h6 class="m-t-20">Total Users</h6>

                        <small class="displayblock">
                            {{ $totalUsers }} Users
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#2ecc71">
                            3,6,4,8,6,9,7,5,6,8
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob" value="{{ round($todayOrderRate) }}" data-width="90"
                            data-height="90" data-thickness="0.2" data-fgColor="#e67e22" readonly>

                        <h6 class="m-t-20">Today Orders</h6>

                        <small class="displayblock">
                            {{ $todayOrders }} Orders Today
                            <i class="zmdi zmdi-trending-up"></i>
                        </small>

                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#e67e22">
                            6,4,8,7,3,5,6,7,4,8
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob dial3" value="76" data-width="90" data-height="90"
                            data-thickness="0.2" data-fgColor="#8fbc8f" readonly>
                        <h6 class="m-t-20">Productivity Goal</h6>
                        <small class="displayblock">75% Average <i class="zmdi zmdi-trending-up"></i></small>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#8fbc8f">6,4,9,8,6,5,4,5,3,2</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <input type="text" class="knob dial4" value="88" data-width="90" data-height="90"
                            data-thickness="0.2" data-fgColor="#00adef" readonly>
                        <h6 class="m-t-20">Total Revenue</h6>
                        <small class="displayblock">54% Average <i class="zmdi zmdi-trending-up"></i></small>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#00adef">3,5,7,9,5,1,4,5,6,8</div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card product-report">
                    <div class="header">
                        <h2>Annual Report <small>Current Year Performance</small></h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Download</a></li>
                                    <li><a href="javascript:void(0);">Export</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="body">

                        <!-- Top Summary Cards -->
                        <div class="row clearfix m-b-15">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="icon l-amber"><i class="zmdi zmdi-chart-donut"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">${{ number_format($annualSales) }}</h4>
                                    <small class="text-muted m-t-0">Sales Report</small>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="icon l-turquoise"><i class="zmdi zmdi-chart"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">${{ number_format($annualRevenue) }}</h4>
                                    <small class="text-muted m-t-0">Annual Revenue</small>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="icon l-parpl"><i class="zmdi zmdi-card"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">${{ number_format($annualProfit) }}</h4>
                                    <small class="text-muted m-t-0">Total Profit</small>
                                </div>
                            </div>
                        </div>

                        <!-- AREA CHART -->
                        <div id="area_chart" class="graph"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Sales <small>Order statistics overview</small></h2>
                    </div>

                    <div class="body">
                        <div class="row">

                            <!-- This Week -->
                            <div class="col-4">
                                <h4 class="m-b-0">{{ $thisWeekOrders }}</h4>
                                <p class="text-muted">
                                    This Week
                                    <small class="m-l-10">
                                        <i class="zmdi zmdi-caret-up text-success"></i>18%
                                    </small>
                                </p>
                            </div>

                            <!-- This Month -->
                            <div class="col-4">
                                <h4 class="m-b-0">{{ $thisMonthOrders }}</h4>
                                <p class="text-muted">
                                    This Month
                                    <small class="m-l-10">
                                        <i class="zmdi zmdi-caret-up text-success"></i>8%
                                    </small>
                                </p>
                            </div>

                            <!-- Average -->
                            <div class="col-4">
                                <h4 class="m-b-0">{{ number_format($averageOrders, 0) }}</h4>
                                <p class="text-muted">
                                    Average
                                    <small class="m-l-10">
                                        <i class="zmdi zmdi-caret-up text-success"></i>5%
                                    </small>
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Chart sparkline (same as before) -->
                    <div class="sparkline" data-type="line" data-spot-Radius="0"
                        data-highlight-Spot-Color="rgb(63, 81, 181)" data-highlight-Line-Color="#222"
                        data-min-Spot-Color="rgb(233, 30, 99)" data-max-Spot-Color="rgb(63, 81, 181)"
                        data-spot-Color="rgb(63, 81, 181, 0.7)" data-width="100%" data-height="50px" data-line-Width="0"
                        data-line-Color="rgba(63, 81, 181, 0)" data-fill-Color="#fcefcb">
                        1,2,3,1,4,3,6,4,4,1
                    </div>

                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12 col-lg-12">
                <div class="card visitors-map">
                    <div class="header">
                        <h2>Visitors Statistics</h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-xl-8 col-lg-7 col-md-12">
                                <div id="world-map-markers" class="jvector-map"></div>
                            </div>
                            <div class="col-xl-4 col-lg-5 col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Contrary</th>
                                                <th>Previous</th>
                                                <th>Recent</th>
                                                <th>Change</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($visitorStats as $row)
                                                @php
                                                    $recent = $row->total_2025;
                                                    $previous = $row->total_2024;

                                                    if ($previous > 0) {
                                                        $change = (($recent - $previous) / $previous) * 100;
                                                    } else {
                                                        $change = 100;
                                                    }

                                                    $icon =
                                                        $change >= 0
                                                            ? 'zmdi-trending-up text-success'
                                                            : 'zmdi-trending-down text-warning';
                                                @endphp

                                                <tr>
                                                    <td>{{ $row->country ?? 'Unknown' }}</td>
                                                    <td>{{ $row->total_2024 }}</td>
                                                    <td>{{ $row->total_2025 }}</td>
                                                    <td>{{ number_format($change, 2) }}% <i
                                                            class="zmdi {{ $icon }}"></i></td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <p class="m-b-0">© {{ $website_settings->footer_copyright_text ?? '' }} by <a href="https://linkhigher.com/"
                                target="black">Link Higher</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var options = {
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Monthly Sales',
                    data: @json($chartData)
                }],
                xaxis: {
                    categories: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    labels: {
                        style: {
                            colors: "#9aa0ac"
                        }
                    }
                },
                colors: ['#4caf50'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.1
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#area_chart"), options);
            chart.render();
        });
    </script>

    <script>
        var mapData = @json($mapData);

        $('#world-map-markers').vectorMap({
            map: 'world_mill',
            backgroundColor: 'transparent',
            series: {
                regions: [{
                    values: mapData,
                    scale: ['#C8EEFF', '#0071A4'],
                    normalizeFunction: 'polynomial'
                }]
            }
        });
    </script>
@endpush
