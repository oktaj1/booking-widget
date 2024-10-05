<!-- resources/views/vendor/notifications/verify_email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>aaVerify Email</title>
</head>
<body>
    <h1>{{ $greeting ?? 'Hello!!' }}</h1>
    <p>{{ $line }}</p>
    <a href="{{ $url }}">{{ $action }}</a>
    <p>{{ $thanks ?? 'Thank you for using our application!' }}</p>
</body>
</html>
