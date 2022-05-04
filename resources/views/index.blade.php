<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Cavite State University') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

    <!-- Styles -->
</head>

<body>
    sample

    @env('local')
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endenv

    <script>
        var botmanWidget = {
            frameEndpoint: '/botman/chat',
            dateTimeFormat: 'm/d/yy HH:MM',
            title: 'CvSU Bot',
            introMessage: "Welcome to Cavite State University! Type 'Hi' to start conversation.",
            displayMessageTime: true,
            mainColor: '#10b981',
            bubbleBackground: '#10b981',
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>

</html>
