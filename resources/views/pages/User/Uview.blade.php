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
                                            <h5>Tambah User</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('register')}}" method="POST">
                                        @csrf 
                                        <div class="btn-group ml-10 mb-1">
                                            <div class="row">
                                                <div class="section-field mb-20 col-sm-12">
                                                    <label class="mb-10" for="">Nama* </label>
                                                    <input type="text" placeholder="Nama*" id="email" class="form-control" name="name">
                                                </div>
                                                <div class="section-field mb-20 col-sm-8">
                                                    <label class="mb-10" for="">NIP* </label>
                                                    <input type="text" placeholder="NIP*" id="email" class="form-control" name="nip">
                                                </div>
                                                <div class="section-field mb-20 col-sm-4">
                                                    <label class="mb-10" for="">Jabatan* </label>
                                                        <div class="box">
                                                            <select name="role" class="fancyselect">
                                                              <option value="operator">Operator</option>
                                                              <option value="validator">Validator</option>
                                                              <option value="approver">Approver</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="section-field mb-20 col-sm-12">
                                                    <label class="mb-10" for="">Email* </label>
                                                    <input type="email" placeholder="Email*" id="email" class="form-control" name="email">
                                                </div>
                                                <div class="section-field mb-20 col-sm-12">
                                                    <label class="mb-10" for="">Password* </label>
                                                    <input class="Password form-control" id="password" type="text" placeholder="Password" name="password">
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
                                    <div class="table-responsive">
                                        <table id="datatable" class="mb-0 table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>NIP</th>
                                                    <th>Jabatan</th>
                                                    <th>Status</th>
                                                    <th>Non Aktif</th>
                                                    <th>Penyesuaian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($data as $detail)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $detail->name }}</td>
                                                    <td>{{ $detail->username }}</td>
                                                    <td>{{ $detail->role }}</td>
                                                    <td>@if ($detail->NA == 'Y') Tidak Aktif @else Aktif @endif</td>
                                                    <td>
                                                        @if ($detail->NA == 'Y')
                                                            <a class="btn btn-primary btn-sm" href="{{ route('Active',$detail->id)}}">Aktifkan</a> 
                                                        @else
                                                        <a class="btn btn-primary btn-sm" href="{{ route('NActive', $detail->id) }}">Non-Aktifkan</a>
                                                        @endif
                                                    </td>
                                                    <td class="row">
                                                            <div class="col-lg-2 col-md-2 col-sm-3 mr-10 mt-2">
                                                                <a class="btn btn-primary btn-md" href="{{ route('User.show',$detail->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sesuaikan Role User"><i class="fa fa-pencil"></i></a>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <form action="{{ route('User.destroy', $detail->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-md" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus User"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            </div>
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