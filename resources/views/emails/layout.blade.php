<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CARVAL | @stack('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            color: #718096;
        }

        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }
    </style>
</head>

<body
    style="box-sizing: border-box; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0 1.5rem; background-color: #edf2f7;  width: 100% !important;">

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
        <tr>
            <td align="center" style="box-sizing: border-box; position: relative;">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
                    <tr>
                        <td class="header"
                            style="box-sizing: border-box; position: relative; padding: 25px 0; text-align: center;">
                            <a href="{{ env('APP_URL') }}"
                                style="box-sizing: border-box; position: relative; text-decoration: none; display: inline-block;">
                                <img src="{{ asset('assets/front/img/logo1.png') }}" alt="logo-carval"
                                    height="50" />
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%; border: hidden !important;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation"
                                style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell"
                                        style="box-sizing: border-box; position: relative; max-width: 100vw; padding: 32px;">
                                        <h1
                                            style="box-sizing: border-box; position: relative; color: #202A44; font-size: 16px; font-weight: bold; margin-top: 0; text-align: left;">
                                            @stack('greet')</h1>
                                        <br>
                                        <p
                                            style="box-sizing: border-box; position: relative; font-size: 14px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            @stack('command')</p>
                                        <table class="action" align="center" width="100%" cellpadding="0"
                                            cellspacing="0" role="presentation"
                                            style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
                                            <tr>
                                                <td align="center" style="box-sizing: border-box; position: relative;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="box-sizing: border-box; position: relative;">
                                                        <tr>
                                                            <td align="center"
                                                                style="box-sizing: border-box; position: relative;">
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                    role="presentation"
                                                                    style="box-sizing: border-box; position: relative;">
                                                                    <tr>
                                                                        <td
                                                                            style="box-sizing: border-box; position: relative;">
                                                                            <h1 style="color: #202A44;">
                                                                                @stack('otp-code')</h1>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <p
                                            style="box-sizing: border-box; position: relative; font-size: 14px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            @stack('paragraph')</p>
                                        <br>
                                        <p
                                            style="box-sizing: border-box; position: relative; font-size: 14px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            Thank you,<br>
                                            CARVAL</p>
                                        <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"
                                            role="presentation"
                                            style="box-sizing: border-box; position: relative; border-top: 1px solid #e8e5ef; margin-top: 25px; padding-top: 25px;">
                                            <tr>
                                                <td style="box-sizing: border-box; position: relative;">
                                                    <p
                                                        style="box-sizing: border-box; position: relative; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">
                                                        If you have problems entering the OTP code, please contact
                                                        CARVAL team <a href="mailto:carvalindo23@gmail.com">here</a>.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="box-sizing: border-box; position: relative;">
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation"
                                style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                                <tr>
                                    <td class="content-cell" align="center"
                                        style="box-sizing: border-box; position: relative; max-width: 100vw; padding: 32px;">
                                        <p
                                            style="box-sizing: border-box; position: relative; line-height: 1.5em; margin-top: 0; color: #b0adc5; font-size: 10px; text-align: center;">
                                            © 2023 CARVAL. All rights reserved.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
