@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ __('dashboard.welcome') }} 🌙</h5>
                            <p class="mb-4">
                                {{ __('dashboard.overview') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-start">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="badge bg-label-primary p-2"><i class="bx bx-book-open text-primary"></i></span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">{{ __('dashboard.total_fatwas') }}</span>
                            <h3 class="card-title mb-2">1,250</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="badge bg-label-success p-2"><i class="bx bx-message-rounded-dots text-success"></i></span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">{{ __('dashboard.total_azkar') }}</span>
                            <h3 class="card-title mb-2">850</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="badge bg-label-info p-2"><i class="bx bx-category text-info"></i></span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">{{ __('dashboard.total_categories') }}</span>
                            <h3 class="card-title mb-2">45</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="badge bg-label-warning p-2"><i class="bx bx-user text-warning"></i></span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">{{ __('dashboard.total_users') }}</span>
                            <h3 class="card-title mb-2">5,400</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3">{{ __('dashboard.fatwas_per_month') }}</h5>
                        <div id="fatwasChart" class="px-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ __('dashboard.fatwa_status') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="statusChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">{{ __('dashboard.top_categories') }}</h5>
                </div>
                <div class="card-body">
                    <div id="categoriesChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">{{ __('dashboard.content_distribution') }}</h5>
                </div>
                <div class="card-body">
                    <div id="contentChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // 1. Line Chart: Fatwas Published Per Month
    new ApexCharts(document.querySelector("#fatwasChart"), {
        chart: {
            type: 'area',
            height: 300,
            toolbar: { show: false }
        },
        series: [{
            name: 'Fatwas',
            data: [45, 52, 38, 65, 48, 72, 85, 90, 68, 75, 82, 95]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        colors: ['#696cff'],
        stroke: { curve: 'smooth' },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
            }
        }
    }).render();

    // 2. Pie Chart: Fatwa Status
    new ApexCharts(document.querySelector("#statusChart"), {
        chart: {
            type: 'pie',
            height: 350
        },
        labels: ['Published', 'Pending', 'Archived', 'Rejected'],
        series: [60, 20, 15, 5],
        colors: ['#71dd37', '#ffab00', '#8592a3', '#ff3e1d'],
        legend: { position: 'bottom' }
    }).render();

    // 3. Bar Chart: Top Categories
    new ApexCharts(document.querySelector("#categoriesChart"), {
        chart: {
            type: 'bar',
            height: 300,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 4
            }
        },
        series: [{
            name: 'Views',
            data: [2500, 2100, 1800, 1500, 1200]
        }],
        xaxis: {
            categories: ['Prayer', 'Fast', 'Marriage', 'Transactions', 'Inheritance']
        },
        colors: ['#03c3ec']
    }).render();

    // 4. Donut Chart: Content Distribution
    new ApexCharts(document.querySelector("#contentChart"), {
        chart: {
            type: 'donut',
            height: 300
        },
        labels: ['Fatwas', 'Morning Azkar', 'Evening Azkar', 'General Supplications'],
        series: [40, 20, 20, 20],
        colors: ['#696cff', '#03c3ec', '#71dd37', '#ffab00'],
        legend: { position: 'bottom' }
    }).render();
</script>
@endsection
