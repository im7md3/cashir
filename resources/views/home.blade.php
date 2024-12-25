@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
    <h3 class="main-heading">{{ __('site.Home') }}</h3>
    @if (auth()->user()->payment_method_id)
        <div class="alert alert-warning">
            {{ __('The sales screen can only be operated after the cash box is selected for the employee or cashier.') }} <a
                href="{{ route('admins.index') }}">{{ __('here') }}</a></div>
    @endif
    <div class="row g-3 mb-4 row-cols-1 row-cols-sm-2 row-cols-md-4">
        @permission('read_clients')
            <div class="col">
                <a href="{{ route('clients.index') }}" class="btn-box">
                    @lang('site.Clients')
                    <img class="icon" src="{{ asset('img/users.png') }}" alt="icon">
                </a>
            </div>
        @endpermission
        @permission('create_invoices')
            <div class="col">
                <a href="{{ route('invoices.create') }}" class="btn-box info">
                    @lang('site.Sale_Screen')
                    <img class="icon" src="{{ asset('img/casher.png') }}" alt="icon">
                </a>
            </div>
        @endpermission
        @permission('read_invoices')
            <div class="col">
                <a href="{{ route('invoices.index') }}" class="btn-box green">
                    @lang('site.Invoices')
                    <img class="icon" src="{{ asset('img/invoice.png') }}" alt="icon">
                </a>
            </div>
        @endpermission
        @permission('read_purchases')
            <div class="col">
                <a href="{{ route('purchases') }}" class="btn-box purple">
                    @lang('site.Purchases')
                    <img class="icon" src="{{ asset('img/Purchases.png') }}" alt="icon">
                </a>
            </div>
        @endpermission
    </div>
    <div class="status_section mb-5">
        <div class="row g-2">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="status_box blue-box">
                    <div class="data">
                        <h3>{{ setting('capital') }}</h3>
                        <p class="mb-3">{{ __('site.Capital') }} </p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-chart-column blue-icon"></i>
                    </div>
                    <a href="" class="more">
                        <i class="fa-solid fa-circle-arrow-right"></i>
                        {{ __('site.More_Information') }}
                    </a>
                </div>
            </div>
            @permission('read_invoices')
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="status_box success-box">
                        <div class="data">
                            @php
                                $total_invoices = \App\Models\Invoice::where('status', 'paid')->sum('total');
                                $total_purchases = \App\Models\Purchase::sum('total');
                                $total_expenses = \App\Models\Expense::sum('amount');
                            @endphp
                            <h3>{{ number_format($total_invoices, 2) }}</h3>
                            <p class="mb-3">@lang('Total sales')</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-people-roof success-icon"></i>
                        </div>
                        <a href="" class="more">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                            {{ __('site.More_Information') }}
                        </a>
                    </div>
                </div>
            @endpermission
            @permission('read_purchases')
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="status_box danger-box">
                        <div class="data">
                            <h3>{{ number_format($total_expenses, 2) }}</h3>
                            <p class="mb-3">@lang('Total expenses')</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-shield danger-icon"></i>
                        </div>
                        <a href="" class="more">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                            {{ __('site.More_Information') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="status_box warning-box">
                        <div class="data">
                            <h3>{{ number_format($total_purchases, 2) }}</h3>
                            <p class="mb-3">@lang('Total purchases')</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-users-line warning-icon"></i>
                        </div>
                        <a href="" class="more">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                            {{ __('site.More_Information') }}
                        </a>
                    </div>
                </div>
            @endpermission
        </div>
    </div>
    <div class="row row-gap-24 mb-4 justify-content-center boxes-info">
        @permission('read_invoices')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('invoices.index') }}">
                    <div class="box-info blue">
                        <i class="fas fa-money-check-alt bg-icon"></i>
                        <div class="num">{{ \App\Models\Invoice::count() }}
                        </div>
                        <div class="text">
                            {{ __('site.All_Invoices') }}
                        </div>
                    </div>
                </a>
            </div>
        @endpermission

        @permission('read_clients')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('clients.index') }}">
                    <div class="box-info green">
                        <i class="fas fa-user-group bg-icon"></i>
                        <div class="num">
                            {{ \App\Models\Client::count() }}
                        </div>
                        <div class="text">
                            {{ __('site.Clients') }}
                        </div>
                    </div>
                </a>
            </div>
        @endpermission

        @permission('read_admins')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('admins.index') }}">
                    <div class="box-info blue">
                        <i class="fas fa-user-group bg-icon"></i>
                        <div class="num">
                            {{ \App\Models\User::count() }}
                        </div>
                        <div class="text">
                            {{ __('site.Employees') }}
                        </div>
                    </div>
                </a>
            </div>
        @endpermission

        @permission('read_products')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('products') }}">
                    <div class="box-info green">
                        <i class="fas fa-cart-shopping bg-icon"></i>
                        <div class="num">
                            {{ \App\Models\Product::count() }}
                        </div>
                        <div class="text">
                            {{ __('site.Products') }}
                        </div>
                    </div>
                </a>
            </div>
        @endpermission
    </div>
    <div class="row row-gap-24 mb-4 justify-content-start boxes-info">
        @permission('read_departments')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('departments.index') }}">
                    <div class="box-info red">
                        <i class="fas fa-coins bg-icon"></i>
                        <div class="num">{{ \App\Models\Department::count() }}</div>
                        <div class="text">{{ __('site.Departments') }}</div>
                    </div>
                </a>
            </div>
        @endpermission

        @permission('read_purchases')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('expenses') }}">
                    <div class="box-info blue">
                        <i class="fas fa-coins bg-icon"></i>
                        <div class="num">{{ \App\Models\Expense::count() }}</div>
                        <div class="text"> {{ __('site.Expenses') }}</div>
                    </div>
                </a>
            </div>
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('purchases') }}">
                    <div class="box-info red">
                        <i class="fas fa-cart-shopping bg-icon"></i>
                        <div class="num">{{ \App\Models\Purchase::count() }}</div>
                        <div class="text">{{ __('site.Purchases') }}</div>
                    </div>
                </a>
            </div>
        @endpermission
        @permission('read_products')
            <div class=" col-sm-6 col-lg-3">
                <a href="{{ route('products') }}">
                    <div class="box-info red">
                        <i class="fa-solid fa-box bg-icon"></i>
                        <div class="num">{{ \App\Models\Product::sum('quantity') }}</div>
                        <div class="text">{{ __('site.stock') }}</div>
                    </div>
                </a>
            </div>
        @endpermission
    </div>
@endsection
