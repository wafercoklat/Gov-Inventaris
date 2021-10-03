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
                @include('components.side')
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Transaksi = {{$trans[0]->transaksi}} </h4>
                                <h5 class="mb-0"> Tanggal = {{$trans[0]->tanggal}}</h5>
                                <h5 class="mb-0"> Pemindah = {{$trans[0]->User}}</h5>                                
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <a href="{{route('PrintLaporan', $trans[0]->IdTrans)}}" class="btn btn-primary">Print</a>
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
                                                    <th>Nama Barang</th>
                                                    <th>Code Barang</th>
                                                    <th>NUP Barang</th>
                                                    <th>Ruangan</th>
                                                    <th>Lantai</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal</th>
                                                    <th>Approve</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($trans as $item)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$item->barang}}</td>
                                                    <td>{{$item->Code}}</td>
                                                    <td>{{$item->NUP}}</td>
                                                    <td>{{$item->ruangan}}</td>
                                                    <td>{{$item->Lantai}}</td>
                                                    <td>{{$item->Kondisi}}</td>
                                                    <td>{{$item->Remark}}</td>
                                                    <td>{{$item->tanggal}}</td>
                                                        @if ($item->Req == 'Y' and $item->Checked == 'N')
                                                            @if (Auth::User()->role == 'validator' or Auth::User()->role == 'admin')
                                                            <td>
                                                                <form action="{{route('Selesai', [$item->DetailID, $item->IdTrans, 'Req', $item->IdBarang])}}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="button " class="btn btn-info btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin ingin memeriksa barang ini?') ">Periksa</button>
                                                                </form>
                                                                    
                                                                <form action="{{ route( 'Kondisi.destroy', $item->DetailID) }}" method="POST"> @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak barang ini?')">Menolak</button>
                                                                </form>
                                                            </td>
                                                            @else
                                                                <td> <h5><span class="badge badge-info mb-auto">Sedang Direquest </span></h5> </td>
                                                            @endif
                                                        @elseif ($item->Checked == 'Y' and $item->Verified == 'N')
                                                            @if (Auth::User()->role == 'validator' or Auth::User()->role == 'admin')
                                                            <td>
                                                                <form action="{{route('Selesai', [$item->DetailID, $item->IdTrans, 'Che', $item->IdBarang])}}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="button " class="btn btn-success btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin ingin menyetujui barang ini?') ">Setuju</button>
                                                                </form>

                                                                <form action="{{ route( 'Kondisi.destroy', $item->DetailID) }}" method="POST"> @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak laporan ini?')">Menolak</button>
                                                                </form>
                                                            </td>
                                                            @else
                                                            <td> <h5><span class="badge badge-info mb-auto">Menunggu Persetujuan</span></h5> </td>
                                                            @endif
                                                        @elseif ($item->Verified == 'Y' and $item->Done == 'N')
                                                            @if (Auth::User()->role == 'validator' or Auth::User()->role == 'admin')
                                                            <td>
                                                                <form action="{{route('Selesai', [$item->DetailID, $item->IdTrans, 'Fin', $item->IdBarang])}}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="button " class="btn btn-success btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin barang ini selesai diperbaiki?') ">Selesai</button>
                                                                </form>
                                                                    
                                                                <form action="{{route('RusakBerat', [$item->DetailID, $item->IdTrans, 'Bad', $item->IdBarang])}}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="button " class="btn btn-warning btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin bahwa barang ini rusak berat?') ">Rusak Berat</button>
                                                                </form>

                                                                <form action="{{ route( 'Kondisi.destroy', $item->DetailID) }}" method="POST"> @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak laporan ini?')">Menolak</button>
                                                                </form>
                                                            </td>
                                                            @else
                                                            <td> <h5><span class="badge badge-info mb-auto">Sedang Diperbaiki</span></h5> </td>
                                                            @endif
                                                        @elseif ($item->stat == '4' and $item->Done == 'Y')
                                                            <td> <h5><span class="badge badge-success mb-auto">Rusak Berat</span></h5> </td>
                                                        @elseif ($item->Done == 'Y' and $item->stat != '4')
                                                            <td> <h5><span class="badge badge-success mb-auto">Selesai Diperbaiki</span></h5> </td>
                                                        @else
                                                            <td> <h5><span class="badge badge-danger mb-auto">Ditolak</span></h5> </td>
                                                        @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('components.footer')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.foot-script')
        </div>
</body>

</html>