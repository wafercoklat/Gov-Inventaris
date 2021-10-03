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
                    <div class="row">
                        <div class="col-xl-12 mb-30">
                            {{-- BODY --}}
                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <h5 class="card-title">Basic form</h5>
                                    <form action="{{ route('Trans.store') }}" method="POST">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <!-- Capture Gambar -->
                                                    <script src="{{asset('js/instascan.min.js')}}"></script>
                                                    <div class="col-sm-12">
                                                        <video id="preview" class="p-1 border" style="width:100%;"></video>
                                                    </div>

                                                    <script type="text/javascript">
                                                        var arr = [];
                                                        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                                                        var scanner = new Instascan.Scanner({
                                                            video: document.getElementById('preview'),
                                                            scanPeriod: 5,
                                                            mirror: false
                                                        });
                                                        scanner.addListener('scan', function(content) {
                                                            if (content != "") {
                                                                self.check(content);
                                                            }
                                                        });
                                                        Instascan.Camera.getCameras().then(function(cameras) {
                                                            if (cameras.length > 0) {
                                                                if (isMobile) {
                                                                    scanner.start(cameras[1]);
                                                                    $('[name="options"]').on('change', function() {
                                                                        if ($(this).val() == 1) {
                                                                            if (cameras[0] != "") {
                                                                                scanner.start(cameras[0]);
                                                                            } else {
                                                                                alert('No Front camera found!');
                                                                            }
                                                                        } else if ($(this).val() == 2) {
                                                                            if (cameras[1] != "") {
                                                                                scanner.start(cameras[1]);
                                                                            } else {
                                                                                alert('No Back camera found!');
                                                                            }
                                                                        }
                                                                    });
                                                                } else {
                                                                    scanner.start(cameras[0]);
                                                                    document.getElementById("camera").remove();
                                                                }
                                                            } else {
                                                                console.error('No cameras found.');
                                                                alert('No cameras found.');
                                                            }
                                                        }).catch(function(e) {
                                                            console.error(e);
                                                            alert(e);
                                                        });

                                                        var check = function check(content) {
                                                            $flag = 0;
                                                            if (!arr.includes(content.trim())) {
                                                                @foreach($data as $barang)
                                                                if ('{{$barang->barcode}}' == content.trim()) {
                                                                    if ('{{$barang->IdKondisi}}' == 1 || '{{$barang->IdKondisi}}' == 6 || '{{$barang->IdKondisi}}' == 7 || '{{$barang->IdKondisi}}' == 8) {
                                                                        self.add(content, '{{$barang->IdBarang}}', '{{$barang->IdRuangan}}', '{{$barang->barcode}}', '{{$barang->Code}}', '{{$barang->NUP}}', '{{$barang->Name}}');
                                                                        flag = 1;
                                                                    } else {
                                                                        alert('Barang sedang ' + '{{$barang->status}}');
                                                                    }
                                                                }
                                                                @endforeach

                                                                if (flag = 0) {
                                                                    alert('Barang tidak ditemukan');
                                                                }
                                                            } else {
                                                                alert('Barang Sudah Di Scan');
                                                            }
                                                        };

                                                        var add = function add(content, idbarang, idruangan, barcode, code, nup, nama) {
                                                            arr.push(content);
                                                            document.getElementById('repeater').innerHTML +=
                                                                '<div data-repeater-item><div class="col-12 mb-30"><div class="card card-statistics p-10"><div class="form-group col-md-12"><label for="inputEmail4">Satuan Kerja</label><input type="text" class="form-control" value="Pengadilan Agama Jakarta Utara" disabled><input type="text" name="IdBarang[]" value="'+idbarang+'" hidden></div><div class="form-group col-md-12"><label for="inputEmail4">Nama Barang</label><input type="text" class="form-control" id="inputEmail4" placeholder="Nama Barang" value="'+nama+'" disabled></div><div class="form-group col-md-12"><label for="inputEmail4">NUP</label><input type="text" class="form-control" id="inputEmail4" value=" ' + nup + ' "></div><div class="form-group col-md-12"><label for="inputEmail4">Pilih Ruangan</label><br><select class="btn btn-secondary dropdown-toggle col-md-12" name="IdRuangan[]" id="IdRuangan">@foreach ($Ruangan as $IdRuangan => $Name)<option class="dropdown-menu-right" value="{{$IdRuangan}}">{{$Name}}</option>@endforeach</select></div><div class="form-group col-md-12"><label for="inputEmail4">Keterangan</label><textarea type="textarea" class="form-control" id="inputEmail4" placeholder="Keterangan" name="Keterangan[]"></textarea></div><div class="col-lg-12 "><input class="btn btn-danger btn-block " data-repeater-delete type="button" value="Delete"></div></div></div></div>';
                                                        }
                                                    </script>
                                                </div>
                                                <div class="col-xl-12 mb-30" id="camera">
                                                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                                                        <label class="btn btn-primary active">
                                                        <input type="radio" name="options" value="1" autocomplete="off" checked> Kamera Depan
                                                      </label>
                                                        <label class="btn btn-secondary">
                                                        <input type="radio" name="options" value="2" autocomplete="off"> Kamera Belakang
                                                      </label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 mb-30">
                                                    <div class="repeater">
                                                        <div data-repeater-list="data">
                                                            <div class="row col-lg-12" id="repeater">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Pindah Barang</button>
                                    </form>
                                </div>
                            </div>
                            {{-- BODY --}} @include('components.footer')
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