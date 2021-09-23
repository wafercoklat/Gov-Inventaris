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
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Daftar Barang Rusak </h4>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="tab round">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="home-07-tab" data-toggle="tab" href="#home-07" role="tab" aria-controls="home-07" aria-selected="true"> <i class="fa fa-home"></i> Daftar Barang Rusak Ringan</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-07-tab" data-toggle="tab" href="#profile-07" role="tab" aria-controls="profile-07" aria-selected="false"><i class="fa fa-user"></i> Daftar Barang Rusak Berat </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="home-07" role="tabpanel" aria-labelledby="home-07-tab">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="datatable" class="table table-striped table-hover p-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode</th>
                                                                    <th>Barang</th>
                                                                    <th>Ruangan</th>
                                                                    <th>Kondisi</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Status</th>
                                                                    <th>Update</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($rusakringan as $itemdetail)
                                                                <tr>
                                                                    <td>{{ ++$i }}</td>
                                                                    <td>{{ $itemdetail->Code }}</td>
                                                                    <td>{{ $itemdetail->barang }}</td>
                                                                    <td>{{ $itemdetail->ruangan }}</td>
                                                                    <td></td>
                                                                    <td>{{ $itemdetail->Remark }}</td>
                                                                    <td>{{ $itemdetail->Status}}</td>
                                                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{route('Daftar-Barang-Rusak.edit', $itemdetail->IdBarang)}}">Hapus</a>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile-07" role="tabpanel" aria-labelledby="profile-07-tab">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="datatable" class="table table-striped table-hover p-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode</th>
                                                                    <th>Barang</th>
                                                                    <th>Ruangan</th>
                                                                    <th>Kondisi</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Status</th>
                                                                    <th>Update</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($rusakberat as $itemdetail)
                                                                <tr>
                                                                    <td>{{ ++$i }}</td>
                                                                    <td>{{ $itemdetail->Code }}</td>
                                                                    <td>{{ $itemdetail->barang }}</td>
                                                                    <td>{{ $itemdetail->ruangan }}</td>
                                                                    <td></td>
                                                                    <td>{{ $itemdetail->Remark }}</td>
                                                                    <td>{{ $itemdetail->Status}}</td>
                                                                    <td><a class="btn btn-outline-secondary btn-sm" href="{{route('Daftar-Barang-Rusak.edit', $itemdetail->IdBarang)}}">Hapus</a>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('components.footer')
                        </div>
                    </div>
                </div>
                {{-- ------------------------------------------------------------------------------ --}}
            </div>
        </div>
    </div>
    @include('components.foot-script')
</body>

</html>