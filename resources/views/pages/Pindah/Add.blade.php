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
                                <h4 class="mb-0"> Pindah Barang </h4>
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
                    <form action="{{ route('Trans.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 mb-30">
                                {{-- BODY --}}
                                <div class="card card-statistics mb-30">
                                    <div class="card-body">
                                        <h5 class="card-title">Pindah Barang </h5>
                                        <div class="repeater-trans">
                                            <div data-repeater-list="data">
                                                <div data-repeater-item>
                                                    <form class="row mb-30">
                                                        <div class="col-lg-2">
                                                            <div class="box">
                                                                <select name="IdBarang">
                                                                <option selected>Choose...</option>
                                                                    @foreach ($data as $barang)
                                                                        <option value="{{$barang->IdBarang}}">{{$barang->Name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="box">
                                                                <select name="IdRuangan">
                                                                    <option selected>Choose...</option>
                                                                        @foreach ($Ruangan as $IdRuangan => $Name)
                                                                            <option class="dropdown-menu-right" value="{{$IdRuangan}}">{{$Name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-2">
                                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="Delete" />
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row mt-20">
                                                <div class="col-12">
                                                    <input class="button" data-repeater-create type="button" value="Add new" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                {{-- BODY --}} @include('components.footer')
                            </div>
                        </div>
                    </form>
                </div>
                {{-- ------------------------------------------------------------------------------ --}}
            </div>
        </div>
    </div>
    @include('components.foot-script')
</body>

</html>