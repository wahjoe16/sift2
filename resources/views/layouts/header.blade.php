<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>F</b>T</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Fakultas<b>Teknik</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('/user/foto/' . auth()->user()->foto ?? '') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->nama }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('/user/foto/' . auth()->user()->foto ?? '') }}" class="img-circle" alt="User Image">

                            <p>
                                {{ auth()->user()->nama }}
                                <small>{{ auth()->user()->email }}</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="btn-group">
                                <a href="{{ route('user.profil') }}" class="btn btn-default btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
                                <a href="{{ route('user.password') }}" class="btn btn-default btn-flat"><i class="fa fa-lock"></i> Password</a>
                                <a href="#" class="btn btn-default btn-flat" onclick="document.getElementById('logout-form').submit()"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>

                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">@csrf</form>