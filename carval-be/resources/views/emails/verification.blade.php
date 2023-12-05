<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Hello, {{ $user->name }},</h2>
    <p>Thank you for register. Please verify your email using the following OTP:</p>
    <h3>{{ $otp }}</h3>
    <p>This OTP will expire in 60 minutes.</p>
    <p>Thank you,</p>
    <p>Carval</p>
</body>
</html>