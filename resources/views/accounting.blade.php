@extends('layouts.app')
@section('title', 'المحاسبة')
@section('content')
<section class="">
    <div class="container">
        <div class="d-flex align-items-md-center justify-content-between gap-3 flex-column flex-sm-row mb-3">
            <h4 class="main-heading mb-0">{{ __('site.Accounting') }}</h4>
                @include('menu')
            <h4 class="main-heading mb-0 pe-none opacity-0 d-none d-md-block">{{ __('site.Accounting') }}</h4>
        </div>
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="row">
                <div class="col-12- col-md-8">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4 ">
                            <a href="{{ route('reports.general') }}" class="translate">
                                <div class="box-report">
                                    <p class="mb-0">{{ __('site.General_account_statement') }}</p>
                                    <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 ">
                            <a href="{{ route('reports.client') }}" class="translate">
                                <div class="box-report">
                                    <p class="mb-0">{{ __('site.Client_report') }}</p>
                                    <img src="{{ asset('img/report-11.png') }}" alt="report img" class="report-img">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 ">
                            <a href="{{ route('reports.user') }}" class="translate">
                                <div class="box-report">
                                    <p class="mb-0">{{ __('site.Employee_report') }}</p>
                                    <img src="{{ asset('img/report-4.png') }}" alt="report img" class="report-img">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 ">
                            <a href="{{ route('reports.treasury') }}" class="translate">
                                <div class="box-report">
                                    <p class="mb-0">{{ __('site.Treasury_report') }}</p>
                                    <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 ">
                            <a href="{{ route('reports.salesReport') }}" class="translate">
                                <div class="box-report">
                                    <p class="mb-0">@lang('sales report')</p>
                                    <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4 ">
                            <a href="{{ route('reports.financial-sessions') }}" class="translate">
                                <div class="box-report">
                                    <p class="mb-0">@lang('Follow up financial sessions')</p>
                                    <img src="{{ asset('img/report-11.png') }}" alt="report img" class="report-img">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12- col-md-4">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: false,
            animationEnabled: true,
            // title: {
            // 	text: "Desktop Browser Market Share in 2016"
            // },
            data: [{
                type: "pie",
                startAngle: 25,
                toolTipContent: "<b>{label}</b>: {y}%",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - {y}%",
                dataPoints: [{
                        y: 51.08,
                        label: "@lang('general_account_statement')"
                    },
                    {
                        y: 27.34,
                        label: "@lang('customer_report')"
                    },
                    {
                        y: 10.62,
                        label: "@lang('employee_report')"
                    },
                    {
                        y: 5.02,
                        label: "@lang('treasury_report')"
                    },
                    {
                        y: 4.07,
                        label: "@lang('expense_report')"
                    },
                    {
                        y: 1.22,
                        label: "@lang('sales_report')"
                    },
                ]
            }]
        });
        chart.render();

    }
</script>
