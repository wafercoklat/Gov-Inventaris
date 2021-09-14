<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Barang </li>
            
            <li> <a href="{{url('Barang')}}"><i class="fa fa-th-list"></i><span class="right-nav-text">Daftar Barang</span></a> </li>
            <li> <a href="{{url('Trans')}}"><i class="fa  fa-exchange"></i><span class="right-nav-text">Pindah Barang</span></a> </li>
            <li> <a href="{{url('Kondisi')}}"><i class="fa fa-pencil-square-o"></i><span class="right-nav-text">Lapor Barang</span></a> </li>
            <li> <a href="{{url('Daftar-Barang-Rusak')}}"><i class="fa fa-cube"></i><span class="right-nav-text">Daftar Barang Rusak</span></a> </li>

            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Lokasi</li>
    
            <li> <a href="{{url('Ruangan')}}"><i class="fa fa-flickr"></i><span class="right-nav-text">Ruangan</span></a> </li>
            <li> <a href="{{url('Lantai')}}"><i class="fa fa-building-o"></i><span class="right-nav-text">Lantai</span></a> </li>
    
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Akun</li>
            
            @if (Auth::User()->role == 'admin')
            <li>
                <a href="{{url('User')}}"><i class="fa  fa-user"></i><span class="right-nav-text">User</span> </a>
            </li>    
            @endif
            <li>
                <a href="{{url('logout')}}"><i class="fa fa-sign-out"></i><span class="right-nav-text">Logout</span> </a>
            </li>
        </ul>
    </div>
</div>