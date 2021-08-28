<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        {{--<li class="nav-item d-none d-sm-inline-block">
            <a href="../index3.html" class="nav-link">Home</a>
        </li>--}}
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="/img/man.png" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-light">
                    <img src="/img/man.png" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{Auth::user()->name}}
                    </p>
                </li>
            <!-- Menu Footer-->
                <li class="user-footer">
                    {{--                    <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                    {{--                    <a href="#" class="btn btn-default btn-flat float-right">Sign out</a>--}}
                    <a href="" class="btn btn-outline-danger float-right"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                </li>
                <form id="logout-form" class="d-block" action="{{ route('logout') }}" method="POST"
                      style="display:none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

