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
                    <!-- main body -->

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            <div class="col-xl-8 mb-30">
                                <div class="card card-statistics h-100">
                                  <div class="p-4 text-center bg-warning">
                                     <h5 class="mb-60 text-white">{{$data[0]->name}} </h5>
                                      <div class="btn-group info-drop">
                                        <button type="button" class="btn btn-primary btn-md" style="background:green !important;">Ubah Password</button>
                                      </div>
                                  </div>
                                  <div class="card-body text-center">
                                    <div class="avatar-top">
                                      <img class="img-fluid w-25 rounded-circle " src="images/team/12.jpg" alt="">
                                     </div>
                                     <p class="mt-10"><span><h3>{{$data[0]->username}}</h3></span></p>
                                     <p class="mt-20">{{$data[0]->email}}</p>
                                     <div class="divider mt-20"></div>
                                     <div class="row">
                                        <div class="col-6 col-sm-4 mt-30">
                                           <b>Hak Ruangan</b>
                                           <h4 class="text-success mt-10">09</h4>
                                        </div>
                                        <div class="col-6 col-sm-4 mt-30">
                                          <b>Jabatan</b>
                                           <h4 class="text-danger mt-10">{{$data[0]->role}}</h4>
                                        </div>
                                        <div class="col-12 col-sm-4 mt-30">
                                          <b>Status</b>
                                           <h4 class="text-warning mt-10">@if ($data[0]->NA == 'Y') Tidak Aktif @else Aktif @endif</h4>
                                        </div>
                                      </div>
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