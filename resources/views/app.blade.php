<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ mix('css/print.css') }}" rel="stylesheet" type="text/css" media="print">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<div id="app">
    <app></app>
</div>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

@if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
@endif

</body>
</html>