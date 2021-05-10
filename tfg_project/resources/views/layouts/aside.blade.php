<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile"
            style="background: url({{ asset('/assets/images/background/user-info.jpg') }}) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ Auth::user()->avatar }}" alt="user" style="height: 50px;" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown"
                    role="button" aria-haspopup="true"
                    aria-expanded="true">{{ Auth::user()->name . ' ' . Auth::user()->surnames }}<span
                        class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="dropdown-item"><i class="fa fa-power-off"></i>
                        {{ __('tfg.layouts.header.logout') }}</a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                {{-- <li class="nav-small-cap">CONTROL</li> --}}
                <li>
                    <a href="{{ url('/home') }}" aria-expanded="false"><i class="fas fa-home"></i><span
                            class="hide-menu">{{ __('tfg.home') }}</span></a>

                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-user"></i><span
                            class="hide-menu">{{ __('tfg.users.title') }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/users') }}">{{ __('tfg.list') }}</a></li>
                        <li><a href="{{ url('/users/new') }}">{{ __('tfg.users.new') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-gallery"></i><span
                            class="hide-menu">{{ __('tfg.posts.title') }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/categories') }}">{{ __('tfg.categories.title') }}</a></li>
                        <li><a href="{{ url('/posts') }}">{{ __('tfg.posts.list') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-clipboard"></i><span
                            class="hide-menu">{{ __('tfg.routines.title') }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/routineTypes') }}">{{ __('tfg.routines-types.title') }}</a></li>
                        <li><a href="{{ url('/routines') }}">{{ __('tfg.routines.list') }}</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
