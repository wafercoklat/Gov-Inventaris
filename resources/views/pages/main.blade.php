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
                                                    <th>Code</th>
                                                    <th>Barang</th>
                                                    <th>NUP</th>
                                                    <th>Ruangan Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Pemindah</th>
                                                    <th>Approval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($trans as $item)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$item->transaksi}}</td>
                                                    <td>{{$item->Code}}</td>
                                                    <td>{{$item->barang}}</td>
                                                    <td>{{$item->NUP}}</td>
                                                    <td>{{$item->ruangan}}</td>
                                                    <td>{{$item->ruangan2}}</td>
                                                    <td>{{$item->User}}</td>
                                                    @if ($item->Req == 'Y')
                                                        <td>
                                                            <a href="{{ route('Update', $item->IdTrans) }}" ">
                                                            <button type="button " class="btn btn-success btn-sm mt-1 mb-1 " onclick="return confirm( 'Apakah Anda yakin ingin menghapus data ini?') ">Approve</button>
                                                        </a>
                                                        <form action="{{ route( 'Trans.destroy', $item->IdTrans) }}" method="POST"> @csrf @method('DELETE')
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
            <div class="modal fade" id="exampleModalCenter" role="dialog" aria-hidden="true" style="overflow:hidden;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title">
                                <div class="mb-10">
                                    <h4>Apakah Anda Ingin Pindah Barang?</h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('Trans.store') }}" method="post">
                            @csrf
                        <div class="modal-body">
                            <div class="col-auto my-1 mb-10">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"><h4>Pilih Barang</h4></label>
                                <select id="select2insidemodal" class="custom-select mr-sm-2" name="IdBarang">
                                <option selected>Choose...</option>
                                @foreach ($data as $barang)
                                    <option class="dropdown-menu-right" value="{{$barang->IdBarang}}">{{$barang->Name}}</option>
                                @endforeach
                                </select>
                            </div>
                            
                            <div class="col-auto my-1">
                                <label class="mr-sm-2" id="select-state" for="inlineFormCustomSelect"><h4>Ruangan Tujuan</h4></label>
                                <select class="custom-select mr-sm-2" id="select2insidemodal" name="IdRuangan">
                                <option selected>Choose...</option>
                                @foreach ($Ruangan as $IdRuangan => $Name)
                                    <option class="dropdown-menu-right" value="{{$IdRuangan}}">{{$Name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Scan</button>
                            <button type="submit" class="btn btn-secondary"">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('components.foot-script')
        </div>
</body>

</html>