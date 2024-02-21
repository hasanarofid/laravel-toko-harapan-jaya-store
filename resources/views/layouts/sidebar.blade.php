<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Master</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>


            <li class="active"><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>Customer</span></a></li>
            <li class="active"><a href="{{ route('sales.index') }}"><i class="fa fa-user"></i> <span>Sales</span></a></li>
            <li class="active"><a href="{{ route('suppliers.index') }}"><i class="fa fa-user-circle-o"></i> <span>Supplier</span></a></li>

            <li class="header">Data Barang</li>
            <li class="active"><a href="{{ route('categories.index') }}"><i class="fa fa-list-ol"></i> <span>Category</span></a></li>
            <li class="active"><a href="{{ route('products.index') }}"><i class="fa fa-cube"></i> <span>Product</span></a></li>
            <li class="active"><a href="{{ route('productsIn.index') }}"><i class="fa fa-sign-in"></i> <span>Product In</span></a></li>
            <li class="active"><a href="{{ route('productsOut.index') }}"><i class="fa fa-sign-out"></i> <span>Product Out</span></a></li>

        @if(auth()->user()->role == 'admin')
            <li class="header">Laporan</li>
            <li class="{{ request()->routeIs('api.laporan') ? 'active' : '' }}">
                <a href="{{ route('api.laporan') }}">
                    <i class="fa fa-address-book"></i> <span>Cetak Laporan</span>
                </a>
            </li>
        @endif
        



        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
