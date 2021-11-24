@extends('backend.layouts.master')

@section('title', 'Blog - Dashboard')

@section('styles')

@endsection


@section('content')

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/categories') }}">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categoriesCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-cuttlefish fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/tags') }}">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Tags</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagsCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/blogs') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Blogs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $blogsCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-table fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/blogs') }}">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Published Blogs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $publishedBlogsCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/awaitingApproval') }}">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Awaiting Blogs</div>
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

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/all/users') }}">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor" href="{{ url('/contact-message') }}">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Messages</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $messagesCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a class="custom-anchor">
                <div class="card border-left-light shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-black-50 text-uppercase mb-1">Total Blog Views</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $viewsCount ?? '' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Website Report</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Categories
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-secondary"></i> Tags
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Blogs
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Published Blogs
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Awaiting Blogs
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Users
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-dark"></i> Messages
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-light"></i> Views
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="{{ asset('backend/js/demo/Chart.min.js') }}"></script>
{{--    <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script>--}}
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Categories", "Tags", "Blogs", "Published Blogs", "Awaiting Blogs", "Users", "Total Messages", "Total Blog Views"],
                datasets: [{
                    data: ["{{ $categoriesCount  }}", "{{ $tagsCount }}", "{{ $blogsCount }}", "{{ $publishedBlogsCount }}",
                        "{{ $awaitingBlogsCount }}", "{{ $usersCount }}", "{{ $messagesCount }}", "{{ $viewsCount }}"],
                    backgroundColor: ['#4e73df', '#858796', '#1CC88A', '#E74A3B', '#F6C23E', '#36B9CC', '#5A5C69', '#f8f9fc'],
                    hoverBackgroundColor: ['#2d57d3', '#7a7b83', '#0ebb7c', '#cd1c0b', '#ebaf18', '#09abc3', '#44454e', '#e0e4f1'],
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
