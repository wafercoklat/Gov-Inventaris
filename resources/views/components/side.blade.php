<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <li>
                <a href="{{url('/Trans')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Transaksi</span> </a>
            </li>
            <li>
                <a href="{{url('/Barang')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Barang</span> </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                    <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Lokasi</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="index.html">Ruangan</a> </li>
                    <li> <a href="index-02.html">Lantai</a> </li>
                </ul>
            </li>
            <li>
                <a href="todo-list.html"><i class="ti-menu-alt"></i><span class="right-nav-text">User</span> </a>
            </li>
            <li>
                <a href="{{url('/logout')}}"><i class="ti-menu-alt"></i><span class="right-nav-text">Logout</span> </a>
            </li>
        </ul>
    </div>
</div>