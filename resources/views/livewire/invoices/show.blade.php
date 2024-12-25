@extends('layouts.app')
@if (is_null($invoice))
    <h2>لا يوجد فاتورة <a class="btn btn-primary" href="{{ route('notifications') }}">عودة لصفحة الاشعارات</a></h2>
    @php
        return;
    @endphp
@endif
@section('content')
    <section class="invoice-section">
        <div class="invoice-content bg-white shadow rounded-3 p-5">

            <div class="in-print d-none d-b">
                <div class="logo-holder m-auto text-center mb-2">
                    <img class="the_image mx-auto rounded-3" src="{{ display_file(setting('logo_img')) }}" alt="logo"
                        width="150">
                </div>
                <p class=" text-center top-fs mb-1">
                    فاتورة ضريبية مبسطة
                </p>
                <p class="tax number text-center mb-1 top-fs">
                    رقم الفاتورة: {{ $invoice->id }}
                </p>
                <hr class="w-75 mx-auto my-2">
                {{-- <div class="mb-1 text-center b-fs">
                    <b>العنوان: </b> {{ setting('address') }} - {{ setting('street') }} - {{ setting('building_no') }}
                </div>
                <div class="mb-1 text-center b-fs">
                    <b>رقم الجوال:</b> {{ setting('phone') }}
                </div> --}}
                {{-- @if (setting('active_tax'))
                    <div class="text-center mb-2 b-fs">
                        <b>الرقم الضريبي: </b> {{ setting('tax_no') }}
                    </div>
                @endif --}}
                <div class="the_date d-flex align-items-center justify-content-evenly mb-2">

                    <div class="date-holder b-fs">
                        {{ __('Date') }}: {{ $invoice->date }}
                    </div>
                    <div class="date-holder b-fs">
                        الوقت: {{ $invoice->created_at->format('h:i a') }}
                    </div>
                </div>
            </div>

            <h1 class="invoice-name text-center rounded-3 fw-bold mb-0 pt-2 not-print">
                فاتورة ضريبية مبسطة
                <br>
                #{{ $invoice->id }}
            </h1>
            {{-- <div class="box-header-invoice d-block not-print">
                <div class="row">
                    <div class="col-12">
                        <p class="text-center">{{ setting('website_name') }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if (setting('active_tax'))
                            <small class="mb-1 d-block">الرقم الضريبي: {{ setting('tax_no') }}</small>
                        @endif
                        <small class="mb-1 d-block">
                            العنوان: {{ setting('address') }} - {{ setting('street') }} - {{ setting('building_no') }}
                        </small>
                        <small class="mb-1 d-block">الهاتف: {{ setting('phone') }}</small>
                    </div>
                    <div class="text-center col-md-4 d-flex align-items-center justify-content-center">
                        <img class="the_image mx-auto h-auto rounded-3" src="{{ display_file(setting('logo_img')) }}"
                            width="80" alt="logo">
                        <img src="{{ display_file(setting('logo')) }}" alt="" width="70">
                    </div>
                </div>
            </div> --}}
            <x-header-invoice />
            <div class="the_date d-flex align-items-center justify-content-evenly mb-3 not-print">
                <div class="date-holder ">
                    <small>{{ $invoice->date }}</small>
                </div>
                <div class="date-holder ">
                    <small>{{ $invoice->created_at->format('h:i a') }}</small>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table main-table text-center rounded-3 w-100">
                    <thead class="border-0">
                        <tr>

                            <th class="">
                                <div>{{ __('site.Description') }}</div>
                                <div class="">Description</div>
                            </th>

                            <th class="">
                                <div class="">{{ __('site.price') }}</div>
                                <div class="">price</div>
                            </th>

                            <th>
                                <div class="">{{ __('site.Quantity') }}</div>
                                <div class="">Qty</div>
                            </th>
                            @if (setting('active_tax'))
                                <th>
                                    <div class="">{{ __('site.The_Tax') }}</div>
                                    <div class="">Vat</div>
                                </th>
                            @endif
                            <th>
                                <div class="">{{ __('site.Total') }}</div>
                                <div class="">Total</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->items as $item)
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td title="{{ $item->price }}">
                                    {{ round($item->price, 2) }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                @if (setting('active_tax'))
                                    <td title="{{ $item->tax }}">
                                        {{ round($item->tax, 2) }}
                                    </td>
                                @endif
                                <td>
                                    {{ $item->total }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="table-responsive second-responsive mt-2">
                <table class="table main-table second-table" id="data-table">
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-end ">
                                <div class="text-center spechial-text">{{ __('site.Total_before_discount_and_tax') }}</div>
                                <div class="text-center spechial-text">Total before deduction and tax</div>
                            </td>
                            <td colspan="2"> {{ $invoice->price }}</td>
                        </tr>
                        @if (setting('active_tax'))
                            <tr>
                                <td colspan="2" class="text-end ">
                                    <div class="text-center spechial-text">{{ __('site.value_added_tax') }}</div>
                                    <div class="text-center spechial-text">value added tax</div>
                                </td>
                                <td colspan="2"> {{ $invoice->tax }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="text-end ">
                                <div class="text-center spechial-text"> {{ __('site.Discount') }} Disc</div>
                                <!-- <div class="text-center spechial-text"></div> -->
                            </td>
                            <td colspan="2"> {{ $invoice->discount }}</td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-end ">
                                <div class="text-center spechial-text"> {{ __('site.cash_Money') }} Cash</div>
                                <!-- <div class="text-center spechial-text"></div> -->
                            </td>
                            <td colspan="2"> {{ $invoice->cash }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end ">
                                <div class="text-center spechial-text"> {{ __('site.Network_pay') }} Card</div>
                                <!-- <div class="text-center spechial-text"></div> -->
                            </td>
                            <td colspan="2"> {{ $invoice->card }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end ">
                                <div class="text-center spechial-text"> {{ __('site.rest') }} Rest</div>
                                <!-- <div class="text-center spechial-text"></div> -->
                            </td>
                            <td colspan="2"> {{ $invoice->rest }}</td>
                        </tr>

                        <tr class="">
                            <td colspan="1" class="text-end ">
                                <div class="text-center spechial-text"> {{ __('site.Total') }} Total</div>
                                <!-- <div class="text-center spechial-text"></div> -->
                            </td>
                            <td colspan="3 " class="">{{ $invoice->total }}</td>
                        </tr>
                        <tr class="">
                            <td colspan="1" class="text-end ">
                                <div class="text-center spechial-text"> {{ setting('message_invoice') }} </div>
                                <!-- <div class="text-center spechial-text"></div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="bar_code_holder text-center">
                {!! $qrCode !!}
            </div>
            <div class="d-flex justify-content-center not-print mt-3">
                <button class="btn btn-sm btn-info" onclick="print()">{{ __('site.Print') }}</button>
            </div>

        </div>
        {{-- <div class="watermark ">
            {{-- <img class="w-100" src="{{ asset('img/const-tech.png') }}" alt=""> 
            Const-Tech
        </div> --}}

    </section>
@endsection


{{-- @push('css')
    <style>
        body {
            position: relative;
        }

        .watermark {
            position: fixed;
            bottom: 30%;
            left: 20%;
            font-size: 80px;
            color: #424141;
            opacity: 0.3;
            transform: rotate(-45deg);
            z-index: -1;
        }
    </style>
@endpush --}}
