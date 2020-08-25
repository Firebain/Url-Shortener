<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Url Shortener</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" />

    <script src="{{ asset('/js/app.js') }}" defer />
    </script>
</head>

<body>
    <div class="m-auto" id="app">
        <login-component></login-component>
    </div>
</body>

</html>
