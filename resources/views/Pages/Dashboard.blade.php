<html lang="{{ app()->getLocale() }}">

@include('components.head-meta')

<body>
    <div class="wrapper">

        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>
        @include('components.header')

        <div class="container-fluid">
            <div class="row">
                @include('components.side') {{-- ------------------------------------------------------------------------------ --}}
                <div class="content-wrapper header-info">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-15 text-white"> Selamat Datang, {{Auth::user()->username}} </h3>
                                <span class="mb-10 mb-md-30 text-white d-block">Dashboard Sistem</span>
                            </div>
                        </div>
                    </div>
                    <!-- widgets -->
                    <div class="row account-overview mb-30">
                        <div class="col-12">
                            <div class="card card-statistics h-100">
                                <div class="card-body bg-white">
                                    <h5 class="card-title">Laporan Langsung</h5>
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-7 col-7 align-self-center">
                                                    <span>Total Barang</span>
                                                    <h5 class="text-danger fw-6 mt-10">Keseluruhan</h5>
                                                </div>
                                                <div class="col-md-5 col-sm-5 col-5 align-self-center text-right">
                                                    <span class="round-chart mb-0" data-percent="{{$barang[0]->a}}" data-size="80" data-width="0" data-color="#fff"> <span class="percent"></span> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-7 col-7 align-self-center">
                                                    <span>Laporan Pindah</span>
                                                    <h5 class="text-danger fw-6 mt-10">Sedang Request</h5>
                                                </div>
                                                <div class="col-md-5 col-sm-5 col-5 align-self-center text-right">
                                                    <span class="round-chart mb-0" data-percent="{{$trans[0]->a}}" data-size="80" data-width="0" data-color="#fff"> <span class="percent"></span> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-7 col-7 align-self-center">
                                                    <span>Laporan Rusak</span>
                                                    <h6 class="text-danger fw-6 mt-10">Rusak Ringan</h6>
                                                </div>
                                                <div class="col-md-5 col-sm-5 col-5 align-self-center text-right">
                                                    <span class="round-chart mb-0" data-percent="{{$ringan[0]->a}}" data-size="80" data-width="0" data-color="#fff"> <span class="percent"></span> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-7 col-7 align-self-center">
                                                    <span>Laporan Rusak</span>
                                                    <h6 class="text-danger fw-6 mt-10">Rusak Berat</h6>
                                                </div>
                                                <div class="col-md-5 col-sm-5 col-5 align-self-center text-right">
                                                    <span class="round-chart mb-0" data-percent="{{$berat[0]->a}}" data-size="80" data-width="0" data-color="#fff"> <span class="percent"></span> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <h5 class="mb-15 pb-0 border-0 card-title">Daftar Laporan</h5>
                                    <!-- action group -->
                                    <div class="btn-group info-drop">
                                        <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#"><i class="text-success ti-files"></i> Approved</a>
                                            <a class="dropdown-item" href="#"><i class="text-warning ti-pencil-alt"></i> Pending</a>
                                            <a class="dropdown-item" href="#"><i class="text-danger ti-user"></i> Rejected</a>
                                            <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i> Refresh</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table center-aligned-table mb-10">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th>No</th>
                                                    <th>Barang</th>
                                                    <th>Transaksi</th>
                                                    <th>Kategori</th>
                                                    <th>Ruangan</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$item->Name}}</td>
                                                    <td>{{$item->Trans}}</td>
                                                    <td>
                                                    @if($item->Type == 0) 
                                                        <label class="badge badge-light">Pindah</label> 
                                                    @elseif($item->Type == 1) 
                                                        <label class="badge badge-light">Rusak</label> 
                                                    @else
                                                        <label class="badge badge-light">Baru Ditambahkan</label> 
                                                    @endif
                                                    </td>
                                                    <td>{{$item->ruangan}}</td>
                                                    <td>{{$item->user}}</td>
                                                    <td>
                                                    @if($item->kondisi == 2)
                                                        <label class="badge badge-primary">Sedang DiPerbaiki</label>    
                                                    @elseif($item->kondisi == 5) 
                                                        <label class="badge badge-warning">Request Pindah</label>  
                                                    @elseif($item->kondisi == 3 and $item->Type == 1) 
                                                        <label class="badge badge-warning">Lapor Rusak Ringan</label>
                                                    @elseif($item->kondisi == 4 and $item->Type == 1) 
                                                        <label class="badge badge-secondary">Rusak Berat</label>    
                                                    @elseif(($item->kondisi == 6 and $item->Done == 'Y') or ($item->Status == 5 and $item->Done == 'Y')) 
                                                        <label class="badge badge-success">Berhasil Pindah</label> 
                                                    @elseif($item->Done == 'R') 
                                                        <label class="badge badge-danger">Ditolak</label> 
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="bg-white p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center text-md-left">
                                    <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="text-center text-md-right">
                                    <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
                                    <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
                                    <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
                                </ul>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    @include('components.foot-script')
</body>

</html>