<nav class="bottom-nav not-print d-none  {{ !request()->routeIs('invoices.create') ? 'd-sm-block' : '' }}">
    <div class="container">
        <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <div class="nav-holder d-flex align-items-center justify-content-between">
            <ul class="list-item">
                <li class="">
                    <a class="item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                        {{ __('site.Home') }}
                        <i class="i-item fa-solid fa-house"></i>
                    </a>
                </li>
                @if (auth()->user()->hasPermission('read_settings'))
                    <li>
                        <a class="item {{ request()->routeIs('settings.index') ? 'active' : '' }}"
                            href="{{ route('settings.index') }}">
                            {{ __('site.Settings') }}
                            <i class="i-item fas fa-wrench"></i>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_products'))
                    <li>
                        <a href="{{ route('products') }}"
                            class="item {{ request()->routeIs('products') ? 'active' : '' }}" href="">
                            {{ __('site.stock') }}
                            <i class="fa-solid fa-bag-shopping i-item"></i>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_admins'))
                    <li>
                        <a href="{{ route('clients.index') }}"
                            class="item {{ request()->routeIs('clients.index') ? 'active' : '' }}" href="">
                            {{ __('site.Clients') }}
                            <i class="i-item fas fa-user-large"></i>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_invoices'))
                    <li>
                        <a href="{{ route('invoices.index') }}"
                            class="item {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                            {{ __('site.Invoices') }}
                            <i class="i-item fa-solid fa-chart-line"></i>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('read_reports'))
                    <li>
                        <a href="{{ route('accounting') }}"
                            class="item {{ request()->routeIs('accounting') ? 'active' : '' }}">
                            {{ __('site.Accounting') }}
                            <i class="i-item fa-solid fa-file-invoice-dollar"></i>
                        </a>
                    </li>
                @endcan

                @if (auth()->user()->hasPermission('read_invoices') and setting('active_free_invoice'))
                    <li>
                        <a href="{{ route('invoices.free') }}"
                            class="item {{ request()->routeIs('invoices.free') ? 'active' : '' }}" href="">
                            عملاء الفاتورة المجانية
                            <i class="i-item fa-solid fa-chart-line"></i>
                            <div class="badge-count position-absolute translate-middle" style="left:-8px;top:25%;">
                                {{ App\Models\Client::free()->count() }}</div>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('create_invoices'))
                    <li>
                        <a href="{{ route('invoices.create') }}"
                            class="item  {{ request()->routeIs('invoices.create') ? 'active' : '' }}"
                            href="">
                            {{ __('site.Sale_Screen') }}
                            <i class="i-item fa-solid fa-cash-register"></i>
                        </a>
                    </li>
                @endif

                {{-- <li>
                    <a href="{{ route('const') }}" class="item  {{ request()->routeIs('const') ? 'active' : '' }}">
                        {{ __('const') }}
                        <i class="i-item fa-solid fa-code"></i>
                    </a>
                </li> --}}
        </ul>
        <div class="d-flex">
            <ul class="list-item">
                <li {{ request()->routeIs('settings.index') ? 'active' : '' }}>
                    @if (app()->getLocale() == 'ar')
                        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="d-flex lang">
                            <i class="fa-solid fa-language"></i>
                        </a>
                    @else
                        <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="d-flex lang">
                            <i class="fa-solid fa-language"></i>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
</nav>
