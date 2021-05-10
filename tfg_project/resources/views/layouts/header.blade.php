<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('logo/logo_negro_no_letra.png') }}" alt="homepage" style="height: 30px;" />
                    <!-- Light Logo icon -->
                    {{-- <img src="{{ asset('logo/logo_negro.png') }}" alt="homepage" style="height: 200dp" /> --}}
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="{{ asset('logo/logo_solo_letra.png') }}" alt="homepage" style="height: 30px" />
                    <!-- Light Logo text -->
                    {{-- <img src="{{ asset('/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" /> --}}
                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                        href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item"> <a
                        class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="{{ Auth::user()->avatar }}" alt="user" style="height: 30px" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <img class="rounded mx-auto d-block"src="{{ Auth::user()->avatar }}" alt="user" style="height: 100px; margin-bottom: 10px">
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name . ' ' . Auth::user()->surnames}}</h4>
                                        <p class="text-muted">{{ "@" . Auth::user()->nick }}</p>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                        class="fa fa-power-off"></i>{{ __('tfg.layouts.header.logout') }}</a></li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="flag-icon flag-icon-{{ App::getLocale() ? App::getLocale() : "es" }}"></i></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <a class="dropdown-item" href="{{ route('language', "es") }}"><i
                                class="flag-icon flag-icon-es"></i>{{ __('tfg.layouts.header.spanish') }}</a>
                        <a class="dropdown-item" href="{{ route('language', "us") }}"><i
                                class="flag-icon flag-icon-us"></i>{{ __('tfg.layouts.header.english') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
