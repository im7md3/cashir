@extends('layouts.app')
@section('title', 'الموردين')
@section('content')
<section class=" ">
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('site.suppliers') }}</h4>
        <div class="section-content bg-white rounded-3 p-4 shadow">
            <div class="btn-holder-option d-flex align-items-center justify-content-between mb-2">
                <button data-bs-toggle="modal" data-bs-target="#create" class="btn btn-success btn-sm" >اضافة مورد</button>
                <!-- <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                    <i class="fa-solid fa-print"></i>
                </button> -->
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content-">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الجوال</th>
                            <th>الشركة</th>
                            <th>الشارع</th>
                            <th>الرقم الضريبي</th>
                            <th class="text-center not-print">{{ __('site.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button class="btn btn-sm btn-info text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('suppliers.create')
        </div>
    </div>
</section>
@endsection
