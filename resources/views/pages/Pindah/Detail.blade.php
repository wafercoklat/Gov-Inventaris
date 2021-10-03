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
                                    <a href="{{route('PrintPindah',$trans[0]->IdTrans)}}" class="btn btn-primary">Print</a>
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
                                                    <th>Code Ruangan</th>
                                                    <th>Ruangan Asal</th>
                                                    <th>Code Ruangan</th>
                                                    <th>Ruangan Tujuan</th>
                                                    <th>Keterangan</th>
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
                                                    <td>{{$item->codeRuangan}}</td>
                                                    <td>{{$item->ruangan}}</td>
                                                    <td>{{$item->codeRuangan2}}</td>
                                                    <td>{{$item->ruangan2}}</td>
                                                    <td>{{$item->Remark}}</td>
                                                    @if ($item->Req == 'Y')
                                                        @if (Auth::User()->role == 'validator' or Auth::User()->role == 'admin')
                                                            <td>
                                                                <form action="{{route('Check',[$item->DetailID, $item->IdBarang, $item->IdRuangan, $item->IdTrans])}}" method="POST">
                                                                @csrf 
                                                                @method('POST')
                                                                <button type="button " class="btn btn-primary btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin menyetujui barang ini dipindahkan?') ">Check</button>
                                                                </form>
                                                                
                                                                <form action="{{ route( 'Trans.destroy', $item->DetailID) }}" method="POST"> 
                                                                @csrf 
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak barang ini dipindahkan?')">Reject</button>
                                                                </form>
                                                            </td>
                                                        @else
                                                            <td> <h5><span class="badge badge-info mb-auto">Sedang Direquest</span></h5> </td>
                                                        @endif
                                                    @elseif ($item->Checked == 'Y' and $item->Done == 'N')
                                                        @if (Auth::User()->role == 'approver' or Auth::User()->role == 'admin')
                                                            <td>
                                                                <form action="{{route('Approve',[$item->DetailID, $item->IdBarang, $item->IdRuangan, $item->IdTrans])}}" method="POST">
                                                                @csrf 
                                                                @method('POST')
                                                                <button type="button " class="btn btn-success btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin menyetujui barang ini dipindahkan?') ">Approve</button>
                                                                </form>
                                                                
                                                                <form action="{{ route( 'Trans.destroy', $item->DetailID) }}" method="POST"> 
                                                                @csrf 
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak barang ini dipindahkan?')">Reject</button>
                                                                </form>
                                                            </td>
                                                        @else
                                                        <td> <h5><span class="badge badge-info mb-auto">Menunggu Approve</span></h5> </td>
                                                        @endif
                                                    @elseif ($item->Done == 'Y')
                                                        <td> <h5><span class="badge badge-success mb-auto">Approved</span></h5> </td>
                                                    @else
                                                        <td> <h5><span class="badge badge-danger mb-auto">Ditolak</span></h5></td>
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