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
                                <h4 class="mb-0"> Data Barang </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <a href="{{route('Barang.create')}}" class="btn btn-primary" disabled>Tambah Barang</a>
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
                                                    <th>Lantai</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th>Modify</th>
                                                    <th>Test</th>
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
                                                    <td class="badge badge-success mb-auto">{{ $itemdetail->Stat }}</td>
                                                    <td>{{ $itemdetail->Remark }}</td>
                                                    <td class="text-center">
                                                        <form class="ml-auto pt-3" action="{{ route('Barang.destroy', $itemdetail->IdBarang) }}" method="POST">
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Barang.edit',$itemdetail->IdBarang) }}">Edit</a> @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Pindah{{$itemdetail->IdBarang}}">Pindah</button>
                                                    </td>
                                                    @if ($itemdetail->Req == 'N' or $itemdetail->Req == "") {{--
                                                    <td class="text-center">
                                                        <form class="ml-auto pt-3" action="{{ route('Barang.destroy', $itemdetail->IdBarang) }}" method="POST">
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Barang.edit',$itemdetail->IdBarang) }}">Edit</a> @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Pindah{{$itemdetail->IdBarang}}">Pindah</button>
                                                    </td> --}} @else {{--
                                                    <td class="text-center ml-auto pt-3">
                                                        <button class="btn btn-primary btn-sm" onclick="return confirm('Barang ini sedang dalam proses Request, Mohon untuk menge-check kembali?')">Edit</button>
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Barang ini sedang dalam proses Request, Mohon untuk menge-check kembali?')">Delete</button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Barang ini sedang dalam proses Request, Mohon untuk menge-check kembali?')">Pindah</button>
                                                    </td> --}} @endif {{--
                                                    <td>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Barcode{{$itemdetail->barang}}">Barcode</button>
                                                    </td> --}}
                                                </tr>
                                                {{-- Modal --}}

                                                <div class="modal fade" id="Barcode{{$itemdetail->barang}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content pl-30 pr-30 pt-20">
                                                            <div class="modal-header">
                                                                <div class="modal-title">
                                                                    <div class="mb-10">
                                                                        <h5>Barcode</h5>
                                                                        <h2>{{$itemdetail->barang}}</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>{!!DNS2D::getBarcodeHTML(strval($itemdetail->IdBarang), 'QRCODE')!!}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="modal fade" id="Pindah{{$itemdetail->IdBarang}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content pl-30 pr-30 pt-20">
                                                            <div class="modal-header">
                                                                <div class="modal-title">
                                                                    <div class="mb-10">
                                                                        <h5>PINDAH BARANG</h5>
                                                                        <h2>{{$itemdetail->barang}}</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('Trans.update', $itemdetail->IdBarang)}}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <label><h5>Ke Ruangan</h5></label>
                                                                    <div class="btn-group ml-10 mb-1">
                                                                        <select class="btn btn-secondary dropdown-toggle" name="IdRuangan" id="IdRuangan">
                                                                            @foreach ($Ruangan as $IdRuangan => $Name)
                                                                                <option class="dropdown-menu-right" value="{{$IdRuangan}}">{{$Name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                                    </div>
                                                                </form>
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

    @include('components.foot-script')
</body>

</html>