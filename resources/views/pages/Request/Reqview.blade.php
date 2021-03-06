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
                                <h4 class="mb-0"> Data Ruangan </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <a href="{{route('Ruangan.create')}}" class="btn btn-primary" disabled> </a>
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
                                                    <th>Kode Ruangan</th>
                                                    <th>Nama Ruangan</th>
                                                    <th>NUP</th>
                                                    <th>Lantai</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($data as $itemdetail)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $itemdetail->Code }}</td>
                                                    <td>{{ $itemdetail->Ruangan }}</td>
                                                    <td>{{ $itemdetail->NUP }}</td>
                                                    <td>{{ $itemdetail->Lantai }}</td>
                                                    <td>{{ $itemdetail->Keterangan }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('Ruangan.destroy', $itemdetail->IdRuangan) }}" method="POST">
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Ruangan.edit',$itemdetail->IdRuangan) }}">Edit</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                        </form>
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
{{-- ------------------------------------------------------------------------------ --}}
            </div>
        </div>
    </div>

    @include('components.foot-script')
</body>

</html>