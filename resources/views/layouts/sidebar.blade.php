
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('dist/img/avatarumum.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->namauser}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigasi Utama</li>
            @if (Auth::user()->role->namarole=="superadmin")
            <li>
                <a href="/home">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>User</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/user"><i class="fa fa-circle-o"></i> Manajemen User</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>Lokasi</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/lokasi"><i class="fa fa-circle-o"></i> Manajemen Lokasi</a></li>
                </ul>
            </li>
            @elseif (Auth::user()->role->namarole=="timses")
            <li>
                <a href="/home">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
            <li>
                <a href="/people">
                    <i class="fa fa-users"></i> <span>Pemilih</span>
                    
                </a>
            </li>
            @else
            <li class="treeview">
                <a href="/home">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>

            @endif
        </ul>
</aside>
