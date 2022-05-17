<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Cavite State University') }}</title>
</head>
<body>
    <h3>Greetings Mr/Ms {{ $results['name'] }}</h3>
    <p>This is {{$results['regards']}}.</p>
    <p>Congratulations! You are {{$results['status']}} to enroll in {{$results['course']}} program. Please proceed on completing the enrollment process</p>
    <h4>Thank you!</h4>
    <p>Regards,</p>
    <p>{{$results['regards']}}</p>
</body>
</html>