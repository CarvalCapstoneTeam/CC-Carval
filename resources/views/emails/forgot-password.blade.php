<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Hello, {{ $user->name }},</h2>
    <p>Please input the OTP to continue reset your password:</p>
    <h3>{{ $otp }}</h3>
    <p>This OTP will expire in 60 minutes.</p>
    <p>Thank you,</p>
    <p>Carval</p>
</body>
</html>