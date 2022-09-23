@extends('layouts.app')

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Dashboard</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Dashboard Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Total Waiting</h5>

                                    <div class="mt-4">
                                        <p class="text-muted">{{ count($waiting) }}</p>
                                    </div>
                                </div>

                                <div class="col-5 ml-auto">
                                    <div>
                                        <img src="assets/images/widget-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Total Approve</h5>

                                    <div class="mt-4">
                                        <p class="text-muted">{{ count($approve) }}</p>
                                    </div>
                                </div>

                                <div class="col-5 ml-auto">
                                    <div>
                                        <img src="assets/images/widget-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Total Decline</h5>

                                    <div class="mt-4">
                                        <p class="text-muted">{{ count($decline) }}</p>
                                    </div>
                                </div>

                                <div class="col-5 ml-auto">
                                    <div>
                                        <img src="assets/images/widget-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Complaint</h4>

                            <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>                              
                        </div>
                    </div><!--end card-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script>
    var data = {!! json_encode($month) !!}
    var options = {
        chart: {
            height: 380,
            type: "line",
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            }
        },
        colors: ["#00a7e1"],
        dataLabels: {
            enabled: !0
        },
        stroke: {
            width: [3, 3],
            curve: "straight"
        },
        series: [{
            name: "High - 2018",
            data: data
        },],
        title: {
            text: "Total complaint / Month",
            align: "left"
        },
        grid: {
            row: {
                colors: ["transparent", "transparent"],
                opacity: .2
            },
            borderColor: "#f1f1f1"
        },
        markers: {
            style: "inverted",
            size: 6
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "August", "Sep", "Oct", "Nov", "Dec"],
            title: {
                text: "Month"
            }
        },
        yaxis: {
            title: {
                text: "Temperature"
            },
            min: 0,
            max: 50
        },
        legend: {
            position: "top",
            horizontalAlign: "right",
            floating: !0,
            offsetY: -25,
            offsetX: -5
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    toolbar: {
                        show: !1
                    }
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options)).render()
</script>
@endsection