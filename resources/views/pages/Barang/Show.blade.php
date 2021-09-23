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
                                    <a href="{{route('Barang.create')}}" class="btn btn-primary">Tambah Barang</a>
                                    <a href="{{route('Scan')}}" class="btn btn-primary">Scan Barang</a>
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
                                                    {{-- @if (Auth::role() != 'admin') --}}
                                                        <th>Modify</th> 
                                                    {{-- @endif --}}
                                                </tr>{{Auth::check('role')}}
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
                                                    <td class="badge badge-success mb-auto">
                                                        @if ($itemdetail->Req == "Y")
                                                            Request Pindah
                                                        @else
                                                        {{ $itemdetail->status }}</td>
                                                        @endif
                                                    <td>{{ $itemdetail->Remark }}</td>
                                                    {{-- @if (Auth::role() != 'admin') --}}
                                                    <td class="text-center">
                                                        <form class="ml-auto pt-3" action="{{ route('Barang.destroy', $itemdetail->IdBarang) }}" method="POST">
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Barang.edit',$itemdetail->IdBarang) }}">Edit</a> @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                        </form>
                                                    </td>
                                                    {{-- @endif --}}
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