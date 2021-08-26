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
                                <h4 class="mb-0"> Data User </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <a href="{{route('Ruangan.create')}}" class="btn btn-primary" disabled>Tambah User</a>
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
                                        <table id="datatable" class="mb-0 table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>User</th>
                                                    <th>Non Aktif</th>
                                                    <th>Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($d as $detail)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $detail->name }}</td>
                                                    <td>@if ($detail->NA == 'Y') Tidak Aktif @else Aktif @endif</td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="{{ route('User.show',$detail->id) }}">Lihat Role</a>
                                                        @if ($detail->NA == 'Y')
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Active',$detail->id)}}">Aktifkan</a> 
                                                        @else
                                                        <a class="btn btn-primary btn-sm" href="{{ route('NActive', $detail->id) }}">Non-Aktifkan</a>
                                                        @endif
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