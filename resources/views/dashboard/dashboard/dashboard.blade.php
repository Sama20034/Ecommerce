@extends('dashboard.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                <p class="mb-4">
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('dashboard/assets') }}/img/illustrations/man-with-laptop-light.png"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row space-y-6">


                <!-- Total Sales -->
                <div class="col-lg-4 col-md-4 mb-4">
                    <div class="card border shadow-lg">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('dashboard/assets') }}/img/icons/unicons/wallet-info.png"
                                        alt="Credit Card" class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span>Sales</span>
                            <h3 class="card-title text-nowrap mb-1">${{ number_format($totalSales / 100, 2) }}</h3>
                            <small class="fw-semibold"
                                style="color: {{ $salesChangePercentage > 0 ? 'green' : ($salesChangePercentage < 0 ? 'red' : 'gray') }};">
                                <i class="bx bx-up-arrow-alt"></i>
                                {{ number_format($salesChangePercentage, 2) }}%
                            </small>
                        </div>
                    </div>
                </div>


                <!-- Profit -->
                <!-- Profit -->
                <div class="col-lg-4 col-md-4 mb-4">
                    <div class="card border shadow-lg">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('dashboard/assets') }}/img/icons/unicons/chart-success.png"
                                        alt="chart success" class="rounded" />
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Profit</span>
                            <h3 class="card-title mb-2 text-success">${{ number_format($profit, 2) }}</h3>
                            <small class="fw-semibold"
                                style="color: {{ $profitChangePercentage > 0 ? 'green' : ($profitChangePercentage < 0 ? 'red' : 'gray') }};">
                                <i class="bx bx-up-arrow-alt"></i>
                                {{ number_format($profitChangePercentage, 2) }}%
                            </small>
                        </div>
                    </div>
                </div>



                <!-- Sales Growth -->




                <!-- Top Products -->
                <div class="row space-y-6">
                    @foreach ($topProducts->unique('name') as $product)
                        <!-- Ensuring unique products -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card bg-white shadow-lg rounded-lg h-100 border border-gray-100">
                                <div class="card-body px-6 py-8">
                                    <h5 class="card-title text-gray-800 text-lg font-semibold">{{ $product->name }}</h5>
                                    <!-- Product name -->
                                    <p class="card-text text-xl text-gray-600">{{ $product->total_quantity }} sold</p>
                                    <!-- Quantity sold -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <!-- Total Revenue Chart Section -->
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">Total Revenue (2024)</h5>
                            <div id="totalRevenueChart" class="px-2"></div> <!-- Placeholder for the chart -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Include ApexCharts before your custom script -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

            <script>
                // Your custom chart initialization script
                const totalRevenueChartEl = document.querySelector('#totalRevenueChart');
                const totalRevenueChartOptions = {
                    series: [{
                        name: '2024 Revenue',
                        data: salesData2024
                    }],
                    chart: {
                        height: 300,
                        type: 'line',
                        toolbar: {
                            show: false
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3,
                        lineCap: 'round'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        labels: {
                            style: {
                                fontSize: '13px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '13px'
                            }
                        }
                    },
                    grid: {
                        borderColor: '#e1e4e8',
                        padding: {
                            top: 0,
                            bottom: -8,
                            left: 20,
                            right: 20
                        }
                    }
                };

                if (totalRevenueChartEl !== null) {
                    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                    totalRevenueChart.render();
                }
            </script>





            <!-- Growth and Statistics Section -->
            <div class="col-md-4">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ now()->year }} <!-- Current Year -->
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                @for ($i = 0; $i < 5; $i++)
                                    <a class="dropdown-item year-selector"
                                        href="javascript:void(0);">{{ now()->year - $i }}</a>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row space-y-6">

                    <!-- Growth Summary -->
                    <div class="text-center fw-semibold pt-3 mb-2">
                        <h3 class="text-3xl text-green-600 font-bold">
                            {{ $salesGrowth > 0 ? '+' : '' }}{{ number_format($salesGrowth, 2) }}%</h3> Sales Growth
                    </div>

                    <!-- Revenue Comparisons -->
                    <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-primary p-2">
                                    <i class="bx bx-dollar text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>Current Sales (<span id="currentYear">{{ now()->format('Y') }}</span>)</small>
                                <h6 class="mb-0">$<span id="currentSales">{{ number_format($currentSales, 2) }}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-info p-2">
                                    <i class="bx bx-wallet text-info"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>Total Profit (<span id="profitYear">{{ now()->format('Y') }}</span>)</small>
                                <h6 class="mb-0">$<span id="totalProfit">{{ number_format($profit, 2) }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Order Statistics</h5>
                            <small class="text-muted">${{ number_format($totalSales, 2) }} Total Sales</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orderStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $totalOrders }}</h2>
                                <span>Total Orders</span>
                            </div>
                            <div id="orderStatisticsChart"></div>
                        </div>
                        <ul class="p-0 m-0">
                            @forelse ($salesByCategory as $category)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-mobile-alt"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $category->category }}</h6>
                                            <small class="text-muted">Sales: ${{ number_format($category->total_sales, 2) }}</small>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p>No categories found for sales.</p>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
            <!--/ Order Statistics -->

            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Profile Report</h5>
                                    <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                </div>
                                <div class="mt-sm-auto">
                                    <small class="text-success text-nowrap fw-semibold">
                                        <i class="bx bx-chevron-up"></i>
                                        {{ $salesGrowth > 0 ? number_format($salesGrowth, 2) . '%' : 'No Growth' }}
                                    </small>
                                    <h3 class="mb-0">${{ number_format($totalSales / 1000, 2) }}k</h3>
                                    <!-- Showing sales in 'k' for thousands -->
                                </div>
                            </div>
                            <div id="profileReportChart"></div> <!-- You can add chart here -->
                        </div>
                    </div>
                </div>
            </div>



           <!-- Expense Overview -->
<div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-tabs-line-card-income"
                        aria-controls="navs-tabs-line-card-income" aria-selected="true">
                        Income
                    </button>

            </ul>
        </div>
        <div class="card-body px-0">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets') }}/img/icons/unicons/wallet.png"
                                alt="User" />
                        </div>
                        <div>
                            <small class="text-muted d-block">Total Balance</small>
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1">${{ number_format($totalBalance, 2) }}</h6>
                                <small class="text-success fw-semibold">
                                    <i class="bx bx-chevron-up"></i>
                                    {{ $salesGrowth }}%
                                </small>
                            </div>
                        </div>
                    </div>
                    <div id="incomeChart"></div>
                    <div class="d-flex justify-content-center pt-4 gap-2">
                        <div class="flex-shrink-0">
                            <div id="expensesOfWeek"></div>
                        </div>
                        <div>
                            <p class="mb-n1 mt-1">Total income</p>
                            <small class="text-muted">${{ number_format($totalBalance, 2) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Expense Overview -->

        @endsection
