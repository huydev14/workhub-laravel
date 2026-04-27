<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/scss/app.scss', 'resources/js/client/main.js'])
</head>
<body>
    <div id="client-app"></div>
</body>
</html>
