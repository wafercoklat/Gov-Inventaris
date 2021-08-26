<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#barang">
                    <div class="pull-left"><i class="ti-package"></i><span class="right-nav-text">Barang</span></div>
                    <div class="pull-right"><i class="ti-more-alt"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="barang" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{url('/Barang')}}">Daftar Barang</a> </li>
                    <li> <a href="{{url('/Trans')}}">Pindah Barang</a> </li>
                    <li> <a href="{{route('Lapor.create')}}">Lapor Barang</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#lokasi">
                    <div class="pull-left"><i class="fa fa-list"></i><span class="right-nav-text">Lokasi</span></div>
                    <div class="pull-right"><i class="ti-more-alt"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="lokasi" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{url('/Ruangan')}}">Ruangan</a> </li>
                    <li> <a href="{{url('/Lantai')}}">Lantai</a> </li>
                </ul>
            </li>
            <li>
                <a href="{{url('/User')}}"><i class="fa fa-user-circle-o"></i><span class="right-nav-text">User</span> </a>
            </li>
            <li>
                <a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i><span class="right-nav-text">Logout</span> </a>
            </li>
        </ul>
    </div>
</div>