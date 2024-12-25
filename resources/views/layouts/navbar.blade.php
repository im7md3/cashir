<nav class="top-nav not-print py-1 d-none {{!request()->routeIs('invoices.create') ? 'd-sm-block' : ''}}" >
    <div class="container flex-column flex-sm-row">
        <div class="hid-div ms-auto d-none d-md-block">
            <div class="me-auto  d-flex align-items-center gap-2">
                <div class="dropdown-hover" data-show="dropdown-lang">
                    <div class="icon-drop">
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <p class="text">{{ __('site.Employee') }}</p>
                    <div class="arrow-icon">
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <ul class="listis-item" id="dropdown-lang">
                        <li class="item-drop">
                            <a href="#">
                                <p class="text">
                                    <form class="w-100" action="{{ route('logout') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button class="border-0 bg-transparent p-0">
                                            <p class="text"> {{ __('site.logout') }}</p>
                                        </button>
                                    </form>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <h6 class="mb-0 fw-bold">
                {{ setting('website_name') }}
            </h6>
            <ul class="list-unstyled  mb-0">
                <li>
                    <!--digital clock start-->
                    <div class="datetime d-flex gap-2">
                        <div class="date">
                            <span id="dayname">Day</span>,
                            <span id="month">Month</span>
                            <span id="daynum">00</span>,
                            <span id="year">Year</span>
                        </div>
                        <span>|</span>
                        <div class="time">
                            <span id="seconds">00</span>
                            <span id="minutes">00</span>:
                            <span id="hour">00</span>:
                            <span id="period">AM</span>
                        </div>
                    </div>
                    <!--digital clock end-->
                </li>

            </ul>
        </div>
        <div class="ms-sm-auto mx-auto mx-sm-0 d-flex align-items-center gap-2">
            <a href="{{ route('program-additions') }}" class="item" href="">
                {{ __('site.user manual') }}
            </a>
            <a class="item ms-2" href="{{ route('notifications') }}">
                <div class=" position-relative d-flex">
                    <i class="i-item fa-solid fa-bell fs-5"></i>
                    <div class="badge-count position-absolute top-0 start-0 translate-middle">{{ auth()->user()->unreadNotifications->count() }}</div>
                </div>
            </a>


            <div class="dropdown-hover" data-show="dropdown-lang">
                <div class="icon-drop">
                    <i class="fa-solid fa-user icon"></i>
                </div>
                <p class="text">{{ auth()->user()->name }}</p>
                <div class="arrow-icon">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <ul class="listis-item" id="dropdown-lang">
                    <li class="item-drop">
                        <a href="#">
                            <p class="text">
                                <form class="w-100" action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button class="border-0 bg-transparent p-0">
                                        <p class="text">{{ __('site.logout') }}</p>
                                    </button>
                                </form>
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</nav>
