<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Cavite State University') }}</title>

</head>

<body>
    <h1>{{ $results['greetings'] }}</h1>
    <p>{{ $results['body'] }}</p>
    <p>{{ $results['thanks'] }}</p>
</body>

</html>
