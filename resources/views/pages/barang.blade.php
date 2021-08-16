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
{{-- ------------------------------------------------------------------------------ --}}
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Data Barang </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <a href="Barang-Tambah" class="btn btn-primary">Tambah Barang</a>
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
                                    <h5 class="card-title border-0 pb-0">Table hover</h5>
                                    <div class="table-responsive">
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>NUP</th>
                                                    <th>Ruangan</th>
                                                    <th>Lantai</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th>Modify</th>
                                                    <th>Pindah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($item as $itemdetail)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $itemdetail->Code }}</td>
                                                    <td>{{ $itemdetail->barang }}</td>
                                                    <td>{{ $itemdetail->nup }}</td>
                                                    <td>{{ $itemdetail->ruangan }}</td>
                                                    <td>{{ $itemdetail->Lantai }}</td>
                                                    <td>{{ $itemdetail->Status }}</td>
                                                    <td>{{ $itemdetail->Remark }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('Barang.destroy', $itemdetail->IdBarang) }}" method="POST">
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Barang.edit',$itemdetail->IdBarang) }}">Edit</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td class="text-center"> 
                                                        <a type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#Pindah{{$itemdetail->IdBarang}}">Pindah {{$itemdetail->IdBarang}}</a>
                                                    </td>
                                                </tr>
                                                 {{-- Modal --}}
                                                <div class="row">
                                                    <div class="col-md-6 mb-30">
                                                        <div class="card card-statistics h-100">
                                                            <div class="card-body">
                                                                <div class="modal fade" id="Pindah{{$itemdetail->IdBarang}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content pl-30 pr-30 pt-20">
                                                                            <div class="modal-header">
                                                                                <div class="modal-title">
                                                                                    <div class="mb-10">
                                                                                        <h5>PINDAH BARANG</h5>
                                                                                        <h2>{{$itemdetail->Name}}</h2>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{route('Trans.update', $itemdetail->IdBarang)}}" method="POST">
                                                                                    @csrf 
                                                                                    @method('PUT')
                                                                                    <label><h5>Ke Ruangan</h5></label>
                                                                                    <div class="btn-group ml-10 mb-1">
                                                                                        <select class="btn btn-secondary dropdown-toggle" name="IdRuangan" id="IdRuangan">
                                                                                            @foreach ($Ruangan as $IdRuangan => $Name)
                                                                                                <option class="dropdown-menu-right" value="{{$IdRuangan}}">{{$Name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-success" >Simpan</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
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
</body>

@include('components.foot-script')
</html>