@extends('emails.layout')

@push('title')
    Email Verification
@endpush

@push('greet')
    Halo {{ $user->name }},
@endpush

@push('command')
    Thank you for register. Please verify your email using the following OTP:
@endpush

@push('otp-code')
    {{ $otp }}
@endpush

@push('paragraph')
    If you feel that you did not make this request, please disregard this message. This is an automatically generated email, please do not reply to this email.
@endpush
