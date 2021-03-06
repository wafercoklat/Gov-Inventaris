<!doctype html>
<html lang="en-US">

@include('components.head-meta')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>How to use Instascan an HTML5 QR scanner</title>
    <link rel="shortcut icon" href="https://learncodeweb.com/demo/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5">
                <!-- Capture Gambar -->
                <input type="file" accept="image/*" capture="camera" />
                <script src="{{asset('js/instascan.min.js')}}"></script>
                <div class="col-sm-12">
                    <video id="preview" class="p-1 border" style="width:100%;"></video>
                </div>
                <script type="text/javascript">
                    var scanner = new Instascan.Scanner({
                        video: document.getElementById('preview'),
                        scanPeriod: 5,
                        mirror: false
                    });
                    scanner.addListener('scan', function(content) {
                        alert(content);
                        //window.location.href = content;
                    });
                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.start(cameras[0]);
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
                            console.error('No cameras found.');
                            alert('No cameras found.');
                        }
                    }).catch(function(e) {
                        console.error(e);
                        alert(e);
                    });
                </script>
                <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                    <label class="btn btn-primary active">
					<input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
				  </label>
                    <label class="btn btn-secondary">
					<input type="radio" name="options" value="2" autocomplete="off"> Back Camera
				  </label>
                </div>
            </div>
        </div>
    </div>

</body>

</html>