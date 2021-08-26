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
                                    <h5 class="card-title border-0 pb-0">User :  {{$user->name}}</h5>
                                    <h5 class="card-title border-0 pb-0">Status : @if ($user->NA == 'Y') Tidak Aktif @else Aktif @endif</h5>
                                    <form action="{{route('User.store')}}" method="POST">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Izinkan</th>
                                                    <th>Check</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($ruangan as $detail)
                                                <tr class="p-10">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $detail->Name }}</td>
                                                    <td><input value="{{$detail->IdRuangan}}" type="checkbox" name="role[]" class="form-check-input m-auto " id="exampleCheck1" 
                                                        @if($detail->userId != NULL or $detail->userId != "") checked="true" @endif
                                                        @if($user->NA == "Y") disabled @endif>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>                                           
                                        </table>
                                        <div>
                                            <button type="submit" class="btn btn-primary btn-sm" name="userid" value="{{$id}}">Save</a>
                                        </div>
                                    </div>
                                    </form>
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