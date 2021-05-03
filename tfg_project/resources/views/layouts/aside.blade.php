<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url({{ asset('/assets/images/background/user-info.jpg') }}) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ asset('/assets/images/users/1.jpg') }}" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name . ' ' . Auth::user()->surnames }}<span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                    <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">PERSONAL</li>
                <li>
                    <a href="{{ url('/home') }}" aria-expanded="false"><i class="fas fa-home"></i><span class="hide-menu">Inicio</span></a>

                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/users') }}">Listado</a></li>
                        <li><a href="{{ url('/users/new') }}">Añadir Usuario</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-gallery"></i><span class="hide-menu">Posts</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/categories') }}">Categorias</a></li>
                        <li><a href="{{ url('/posts') }}">Listado</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-clipboard"></i><span class="hide-menu">Rutinas</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/routineTypes') }}">Tipos</a></li>
                        <li><a href="{{ url('/routines') }}">Listado</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
