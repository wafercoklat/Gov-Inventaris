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
                                <h4 class="mb-0"> Input Barang </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Data Table </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            {{-- BODY --}}
                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <h5 class="card-title">Basic form</h5>
                                    <form action="{{ route('Barang.update', $item->IdBarang) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Code Barang</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="Code" value="{{$item->Code}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Barang</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="Name" value="{{$item->Name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">NUP Barang</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NUP" name="NUP" value="{{$item->NUP}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" name="Keterangan" value="{{$item->Keterangan}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                            {{-- BODY --}}
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