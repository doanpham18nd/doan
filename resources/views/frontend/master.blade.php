<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href={{ asset("frontend/css/bootstrap.min.css") }} rel="stylesheet">
    <link href={{ asset("frontend/css/font-awesome.min.css") }} rel="stylesheet">
    <link href={{ asset("frontend/css/prettyPhoto.css") }} rel="stylesheet">
    <link href={{ asset("frontend/css/price-range.css") }} rel="stylesheet">
    <link href={{ asset("frontend/css/animate.css") }} rel="stylesheet">
    <link href={{ asset("frontend/css/main.css") }} rel="stylesheet">
    <link href={{ asset("frontend/css/responsive.css") }} rel="stylesheet">
    <link rel="shortcut icon" href="css/frontend/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="css/frontend/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="css/frontend/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="css/frontend/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="css/frontend/images/ico/apple-touch-icon-57-precomposed.png">
    <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">
    <script type="text/javascript">
        window.Laravel = {!! json_encode([
                'baseUrl' => url('/'),
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>
</head><!--/head-->

<body>
<div id="app"></div>
<script type="text/javascript" src="{{ asset('js/frontend.js') }}"></script>
<script src={{ asset("frontend/js/jquery.js") }}></script>
<script src={{ asset("frontend/js/bootstrap.min.js") }}></script>
<script src={{ asset("frontend/js/jquery.scrollUp.min.js") }}></script>
<script src={{ asset("frontend/js/jquery.prettyPhoto.js") }}></script>
<script src={{ asset("frontend/js/main.js") }}></script>
</body>
</html>