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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#CreateUser">Tambah User</a>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->

                     {{-- Modal --}}
                     <div class="modal fade" id="CreateUser" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content pl-30 pr-30 pt-20">
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <div class="mb-10">
                                            <h5>TAMBAH USER</h5>
                                            <h6>Description Here</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('register')}}" method="POST">
                                        @csrf 
                                        <div class="btn-group ml-10 mb-1">
                                            <div class="row">
                                                <div class="section-field mb-20 col-sm-12">
                                                    <label class="mb-10" for="">Name* </label>
                                                    <input type="text" placeholder="Name*" id="email" class="form-control" name="name">
                                                </div>
                                                <div class="section-field mb-20 col-sm-12">
                                                    <label class="mb-10" for="">Email* </label>
                                                    <input type="email" placeholder="Email*" id="email" class="form-control" name="email">
                                                </div>
                                                <div class="section-field mb-20 col-sm-12">
                                                    <label class="mb-10" for="">Password* </label>
                                                    <input class="Password form-control" id="password" type="password" placeholder="Password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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