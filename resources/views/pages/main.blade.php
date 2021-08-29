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
                                <h4 class="mb-0"> Transaksi </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <a data="toggle" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Pindah Barang</a>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="mb-0 table table-striped p-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Transaksi</th>
                                                    <th>Nama Barang</th>
                                                    <th>Dari</th>
                                                    <th>Ke</th>
                                                    <th>Lantai</th>
                                                    <th>Pemindah</th>
                                                    <th>Approve</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($trans as $item)   
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$item->transaksi}}</td>
                                                    <td>{{$item->barang}}</td>
                                                    <td>{{$item->ruangan}}</td>
                                                    <td>{{$item->ruangan2}}</td>
                                                    <td>{{$item->Lantai}}</td>
                                                    <td>{{$item->User}}</td>
                                                    <td>
                                                    <a href="{{ route('Update', $item->IdTrans) }}"">
                                                        <button type="button" class="btn btn-success btn-sm mt-1 mb-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Approve</button>
                                                    </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @include('components.footer')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content pl-30 pr-30 pt-20">
                    <div class="modal-header">
                        <div class="modal-title">
                            <div class="mb-10">
                                <h5>Pilih Metode Pindah</h5>
                                <h2>Nama Barang</h2>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-footer">
                            <a class="btn btn-primary" href="{{route('Scan')}}">SCAN</a>
                            <a class="btn btn-success" href="{{route('Barang.index')}}">Daftar Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('components.foot-script')
</body>
</html>