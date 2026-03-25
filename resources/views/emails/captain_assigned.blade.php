<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Captain Appointment</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #eeeeee; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" bgcolor="#2563eb" style="padding: 40px 0 30px 0; color: #ffffff;">
                            <h1 style="margin: 0; font-size: 28px;">Congratulations!</h1>
                            <p style="margin: 5px 0 0 0; font-size: 16px; opacity: 0.9;">Official Class Captain Appointment</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #1f2937; font-size: 18px; padding-bottom: 20px;">
                                        Dear <strong>{{ $details['name'] }}</strong>,
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #4b5563; font-size: 16px; line-height: 24px;">
                                        We are pleased to inform you that you have been appointed as the <strong>Class Captain</strong> for <strong>{{ $details['section'] }}</strong>. Your leadership and responsibility will play a vital role in our academic management.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 30px 0 30px 0;">
                                        <div style="background-color: #f8fafc; border-left: 4px solid #2563eb; padding: 20px; border-radius: 4px;">
                                            <h3 style="margin: 0 0 15px 0; color: #1e40af; font-size: 16px;">Login Credentials</h3>
                                            <p style="margin: 5px 0; color: #4b5563;"><strong>Login Email:</strong> {{ $details['email'] }}</p>
                                            <p style="margin: 5px 0; color: #4b5563;"><strong>Temporary Password:</strong> <code style="background: #e2e8f0; padding: 2px 5px; border-radius: 3px; font-weight: bold; color: #1e293b;">{{ $details['password'] }}</code></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/admin/login') }}" style="background-color: #2563eb; color: #ffffff; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Login to Dashboard</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #ef4444; font-size: 14px; padding-top: 30px; font-style: italic;">
                                        * For security reasons, please change your password immediately after your first login.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#f9fafb" style="padding: 30px 30px; border-top: 1px solid #eeeeee;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #9ca3af; font-size: 12px; text-align: center;">
                                        &copy; {{ date('Y') }} Student Management System. All rights reserved.
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