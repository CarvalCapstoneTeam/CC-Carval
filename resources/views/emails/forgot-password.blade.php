@extends('emails.layout')

@push('title')
    Reset Password
@endpush

@push('greet')
    Halo {{ $user->name }},
@endpush

@push('command')
    Please enter the following OTP to continue resetting your password:
@endpush

@push('otp-code')
    {{ $otp }}
@endpush

@push('paragraph')
    If you feel that you did not make this request, please disregard this message. This is an automatically generated email, please do not reply to this email.
@endpush