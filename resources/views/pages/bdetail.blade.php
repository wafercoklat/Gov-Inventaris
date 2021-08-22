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
                                <h4 class="mb-0"> Kondisi Barang </h4>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->

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
                                                    <th>Status</th>
                                                    <th>Kondisi</th>
                                                    <th>Keterangan</th>
                                                    <th>Pelapor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $itemdetail)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $itemdetail->Code }}</td>
                                                    <td>{{ $itemdetail->Name }}</td>
                                                    {{-- <td>{{ $itemdetail->ruangan }}</td> --}}
                                                    <td>{{ $itemdetail->Kondisi }}</td>
                                                    <td>{{ $itemdetail->Status }}</td>                                                
                                                    <td>{{ $itemdetail->Remark }}</td>                                              
                                                    <td>{{ $itemdetail->Pelapor }}</td>
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