
<header class="main-header">
    <!-- Logo -->
    <a href="/home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>PS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Peta Suara</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('dist/img/avatarumum.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->namauser}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('dist/img/avatarumum.png')}}" class="img-circle" alt="User Image">

                            <p>
                                {{Auth::user()->username}}
                                @if (Auth::user()->role->namarole=="timses")
                                <small>{{Auth::user()->tps->desa->namadesas}} - {{Auth::user()->tps->namatps}}</small>
                                @elseif (Auth::user()->role->namarole=="timdes")
                                <small>{{Auth::user()->tps->desa->namadesas}}</small>
                                @endif
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/changepassword" class="btn btn-default btn-flat">Edit Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
