<!DOCTYPE html>
<html>
<head>
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body>
    <h1>Hi {{ $user->name }},</h1>
    <p>Thank you for registering! We're excited to have you.</p>
</body>
</html>
