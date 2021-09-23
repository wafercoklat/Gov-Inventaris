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
                                                    @if ($item->Verified == 'Y')
                                                        <td>
                                                            <form action="{{route('UpdateLaporan', [$item->DetailID, $item->IdTrans, 'Fin', $item->IdBarang])}}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="button " class="btn btn-success btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin ingin menghapus data ini?') ">Selesai</button>
                                                            </form>
                                                        </td>
                                                    @elseif ($item->Req == 'Y')
                                                    <td>
                                                    <form action="{{route('UpdateLaporan', [$item->DetailID, $item->IdTrans, 'Fin', $item->IdBarang])}}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="button " class="btn btn-success btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin ingin menghapus data ini?') ">Approve</button>
                                                        </form>
                                                        
                                                        <form action="{{ route( 'Trans.destroy', $item->DetailID) }}" method="POST"> @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Reject</button>
                                                        </form>
                                                    </td>
                                                    @else
                                                        <td class="badge badge-success mb-auto">Approved </td>
                                                    @endif
                                                </tr>
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