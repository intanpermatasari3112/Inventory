<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris</title>
      <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.4/datatables.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"> -->
                        <a class="nav-link" href="#" onclick="$(this).closest('form').submit()" role="button">
                          <i class="fas fa-sign-out-alt"> Logout</i>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{asset('assets/index3.html')}}" class="brand-link">
                <img src="{{asset('assets/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Inventaris<br><small>PT Lauwba Techno Indonesia</small></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('assets/dist/img/admin.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard/" class="nav-link {{ request()->is('dashboard') ? 'active':'' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->level=='PENGGUNA')
                        <li class="nav-header">MANAJEMEN DATA</li>
                        <li class="nav-item">
                            <a href="/barangkeluar/" class="nav-link {{ request()->is('barangkeluar') ? 'active':'' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->level=='ADMIN')
                        <li class="nav-header">MANAJEMEN DATA</li>
                        <li class="nav-item">
                            <a href="/barang/" class="nav-link {{ request()->is('barang') ? 'active':'' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/barangkeluar/" class="nav-link {{ request()->is('barangkeluar') ? 'active':'' }}">
                                <i class="nav-icon ion ion-bag"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jenis/" class="nav-link {{ request()->is('jenis') ? 'active':'' }}">
                                <i class="nav-icon  fas fa-bookmark"></i>
                                <p>
                                    Jenis Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/stok/" class="nav-link {{ request()->is('stok') ? 'active':'' }}">
                                <i class="nav-icon ion ion-pie-graph"></i>
                                <p>
                                    Stok
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/supplier/" class="nav-link {{ request()->is('supplier') ? 'active':'' }}">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                        @endif
                        @if(in_array(Auth::user()->level, ['ADMIN']))
                        <li class="nav-item">
                            <a href="/user/" class="nav-link {{ request()->is('user') ? 'active':'' }}">
                                <i class=" nav-icon ion ion-person-add"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(in_array(Auth::user()->level, ['ADMIN', 'MANAGER']))
                        <li class="nav-header">LAPORAN</li>
                        <li class="nav-item">
                            <a href="/laporan/" class="nav-link {{ request()->is('laporan') ? 'active':'' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>Laporan Inventaris</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2022 <a href="https://www.lauwba.com">PT. LTI</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    @stack('js')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.4/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.myTable').DataTable();
    });
</script>

</html>