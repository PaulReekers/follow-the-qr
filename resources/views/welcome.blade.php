<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Follow the QR</title>
    </head>
    <body>
        <div id="app"></div>
        <script>
            window.API_KEY = '{!! env("GOOGLE_API_KEY") !!}';
        </script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
