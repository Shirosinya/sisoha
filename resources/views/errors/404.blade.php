<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sintasian</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/petro-logo.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-8">
                <div class="form-input-content text-center error-page">
                    <h1 class="error-text font-weight-bold">404</h1>
                    <h4><i class="fa fa-exclamation-triangle text-warning"></i> Laman yang Anda cari tidak ada!</h4>
                    <p>Anda mungkin memiliki typo pada alamat url atau laman telah dipindah.</p>
                    <div>
                        <a class="btn btn-primary" href="{!! url('/home'); !!}">Pulang</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<script src="{{ asset('vendor/global/global.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/deznav-init.js') }}" type="text/javascript"></script>
</body>

</html>