@extends('userpanel.layouts.master')

@section('title', 'Blog - Dashboard')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Blogs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $blogsCount ?? '' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-tachometer-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/user/approvedBlogs') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved Blogs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approvedBlogsCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/user/awaitingBlogs') }}">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Awaiting Blogs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $awaitingBlogsCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>

    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Website Reports</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Blogs
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Approved Blogs
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Awaiting Blogs
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="{{ asset('backend/js/demo/Chart.min.js') }}"></script>
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Blogs", "Approved Blogs", "Awaiting Blogs"],
                datasets: [{
                    data: ["{{$blogsCount}}", "{{$approvedBlogsCount}}", "{{$awaitingBlogsCount}}"],
                    backgroundColor: ['#4e73df', '#1CC88A', '#36B9CC'],
                    hoverBackgroundColor: ['#2d57d3', '#099d68', '#11a3b9'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

    </script>
@endsection
