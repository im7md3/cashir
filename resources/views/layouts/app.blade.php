@include('layouts.head')

<!-- Start nav in mobile screen -->
<nav class="top-nav-mob py-2 not-print d-sm-none">
    <div class="container-md">
        <div class="nav-content">
            <div class="navbar">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="offcanvas offcanvas-end" id="offcanvasNavbar">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item nav-img">
                                <img src="{{ asset('img/profile-picture.webp') }}" class="img-user" alt="">
                                <h5>{{ __('site.Employee') }}</h5>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/') }}">
                                    <i class="i-item fa-solid fa-house"></i>
                                    {{ __('site.Home') }}
                                </a>
                            </li>
                            @if (auth()->user()->hasPermission('read_settings'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('settings.index') }}">
                                    <i class="i-item fas fa-wrench"></i>
                                    {{ __('site.Settings') }}
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->hasPermission('read_purchases'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('purchases') }}">
                                    <i class="fas fa-cart-shopping i-item"></i>
                                    {{ __('site.Purchases') }}
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('expenses') }}">
                                    <i class="i-item fa-solid fa-file-invoice-dollar"></i>
                                    {{ __('site.Expenses') }}
                                </a>
                            </li>

                            @if (auth()->user()->hasPermission('read_admins'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clients.index') }}">
                                    <i class="i-item fas fa-user-large"></i>
                                    {{ __('site.Clients') }}
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('units') }}">
                                    <i class="fa-solid fa-bag-shopping i-item"></i>
                                    الوحدات
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mt-5">
                            @if (auth()->user()->hasPermission('read_products'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products') }}">
                                    <i class="fa-solid fa-bag-shopping i-item"></i>
                                    {{ __('site.Products') }}
                                </a>
                            </li>
                            @endif
                            @if (auth()->user()->hasPermission('read_offers'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('offers') }}">
                                    <i class="fa-solid fa-bag-shopping i-item"></i>
                                    {{ __('site.offers') }}
                                </a>
                            </li>
                            @endif
                            @if (auth()->user()->hasPermission('read_invoices'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('invoices.index') }}">
                                    <i class="i-item fa-solid fa-chart-line"></i>
                                    {{ __('site.Invoices') }}
                                </a>
                            </li>
                            @endif
                            @if (auth()->user()->hasPermission('create_invoices'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('invoices.create') }}">
                                    <i class="i-item fa-solid fa-cash-register"></i>
                                    {{ __('site.Sale_Screen') }}
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('LabelMaker') }}">
                                    <i class="i-item fa-solid fa-tag"></i>
                                    صانع الملصقات
                                </a>
                            </li>
                            @if (auth()->user()->hasPermission('read_reservations'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reservations.index') }}">
                                    <i class="i-item fa-solid fa-calendar-days"></i>
                                    {{ __('site.Reservations') }}
                                    <div class="badge-count">{{ \App\Models\Reservation::count() }}</div>
                                </a>
                            </li>
                            @endif
                            @if (auth()->user()->hasPermission('read_reports'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('accounting') }}">
                                    <i class="i-item fa-solid fa-bars-progress"></i>
                                    {{ __('site.Accounting') }}
                                </a>
                            </li>
                            @endif
                        </ul>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mt-5">
                            <li class="nav-item">
                                <form class="w-100" action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button class="nav-link bg-transparent w-100">
                                        <i class="fa-solid fa-door-open"></i>
                                        {{ __('site.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="image-holder">
                        <a href="{{ route('notifications') }}">
                            <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                            <img src="{{ asset('img/Notification.png') }}" alt="Notification" width="22"
                                height="26">
                        </a>
                    </div>
                    @if (app()->getLocale() == 'ar')
                    <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="d-flex lang">
                        <i class="fa-solid fa-language"></i>
                    </a>
                    @else
                    <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="d-flex lang">
                        <i class="fa-solid fa-language"></i>
                    </a>
                    @endif
                </div>
            </div>
            <div class="img-holder">
                <h1 class="m-0">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/LOGO3.png') }}" alt="" width="40" />
                    </a>
                </h1>
            </div>
        </div>
    </div>
</nav>
<!-- Start nav in mobile screen -->

@if (!View::hasSection('full_screen'))
    @include('layouts.navbar')
    @include('layouts.navbar-bottom')
@endif

<div class="loader-holder not-print"></div>

<section class="home section-mobile {{  View::hasSection('full_screen') ? '' : 'main-section'}}">
    <div class="{{  View::hasSection('full_screen') ? '' : 'container'}}">
        @include('sweetalert::alert')
        @yield('content')
    </div>
</section>

@if (!View::hasSection('full_screen'))
    <header class="header not-print d-sm-none" id="header">
        <nav class="navbar main-nav py-1">
            <div class="container-md">
                <ul class="navbar-nav nav-menu align-items-center" id="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="nav-icon fa-solid fa-house"></i>
                            <span class="nav-name">{{ __('site.Home') }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('invoices.index') }}">
                            <i class="nav-icon fa-solid fa-chart-line"></i>
                            <span class="nav-name">{{ __('site.Invoices') }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('accounting') }}">
                            <i class="nav-icon fa-solid fa-bars-progress"></i>
                            <span class="nav-name">{{ __('site.Accounting') }}</span>
                        </a>
                        <a class="nav-link" href="{{ route('invoices.create') }}">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <span class="nav-name">{{ __('site.Sale_Screen') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
@endif
@include('layouts.footer')
