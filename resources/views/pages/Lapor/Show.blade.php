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
                                <h4 class="mb-0"> Daftar Lapor Barang </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <a href="{{route('Kondisi.create')}}" class="btn btn-primary" disabled>Lapor Barang</a>
                                </ol>
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
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-hover p-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Barang</th>
                                                    <th>NUP</th>
                                                    <th>Ruangan</th>
                                                    <th>Kondisi</th>
                                                    <th>Pelapor</th>
                                                    <th>Tanggal</th>
                                                    <th>Approval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $itemdetail)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $itemdetail->Code }}</td>
                                                    <td>{{ $itemdetail->barang }}</td>
                                                    <td>{{ $itemdetail->NUP }}</td>
                                                    <td>{{ $itemdetail->ruangan }}</td>
                                                    <td>{{ $itemdetail->Status}}</td>
                                                    <td>{{ $itemdetail->Pelapor}}</td>
                                                    <td>{{ date('d M Y', strtotime($itemdetail->tanggal))}}</td>
                                                    @if ($itemdetail->verified == 'Y')
                                                    <td>Done</td>                                                        
                                                    @else
                                                    <td><button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Update{{$itemdetail->IdBarangDetail}}">Update Kondisi</button>
                                                    @endif
                                                </tr>

                                                {{-- Modal --}}
                                                <div class="modal fade" id="Update{{$itemdetail->IdBarangDetail}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content pl-30 pr-30 pt-20">
                                                            <div class="modal-header">
                                                                <div class="modal-title">
                                                                    <div class="mb-10">
                                                                        <h5>Update Kondisi Barang</h5>
                                                                        <h2>{{$itemdetail->barang}}</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form action="{{route('Kondisi.update', $itemdetail->IdBarangDetail)}}" method="POST"> 
                                                                @csrf 
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="modal-footer">
                                                                    <select class="btn btn-secondary dropdown-toggle" name="Kondisi" id="Kondisi">
                                                                    @foreach ($kondisi as $id => $status)
                                                                        <option class="dropdown-menu-right" value="{{$id}}">{{$status}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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
                {{-- ------------------------------------------------------------------------------ --}}
            </div>
        </div>
    </div>
    @include('components.foot-script')
</body>

</html>