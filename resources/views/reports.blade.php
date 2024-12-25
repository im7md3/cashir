@extends('layouts.app')
@section('content')
        <h4 class="main-heading"> {{ __('site.General_report') }}</h4>
        <div class="Financial-report-content box-content">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-3">
                <div class="form-group mb-2 mb-md-0 gap-3">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="small-label mb-2">{{ __('site.From') }}</label>
                                <input type="date" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="small-label mb-2">{{ __('site.To') }}</label>
                                <input type="date" class="form-control" >
                            </div>
                        </div>
                    </div>

                </div>

                <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between ">
                    <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
                        <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                                 <i class="fa-solid fa-print"></i>
                            <span>{{ __('site.Print') }}</span>
                        </button>
                        <button class="btn btn-sm btn-outline-info" id="export-btn">
                                <i class="fa-solid fa-file-excel"></i>
                            <span>{{ __('site.Excel_export') }}</span>
                        </button>
                    </div>
                </div>
            </div>
            <div id="prt-content">


                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('site.The_Employee') }}</th>
                                <th>تسجيل المرضي</th>
                                <th>حجوزات الزائرين</th>
                                <th>{{ __('site.The_number_of_bills_paid') }}</th>
                                <th>{{ __('site.The_number_of_unpaid_bills') }}</th>
                                <th>{{ __('site.cash_Money') }}</th>
                                <th>{{ __('site.Network_pay') }}</th>
                                <th>اضافة المواعيد</th>
                            </tr>
                        </thead>
                        <tbody>
                                                        <tr>
                                <td>1</td>
                                <td>استقبال</td>
                                <td>0</td>
                                <td>0</td>
                                <td><a href="">0</a></td>
                                <td><a href="">0</a></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                @endsection
