<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2c5530; }
        .content { margin-bottom: 30px; text-align: center; }
        .otp-code { font-size: 32px; font-weight: bold; color: #d4a373; letter-spacing: 5px; margin: 20px 0; padding: 10px; background: #f8f5f0; border-radius: 5px; display: inline-block; }
        .footer { text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset OTP</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Use the following OTP code to reset your password. This code is valid for 10 minutes.</p>
            <div class="otp-code">{{ $otp }}</div>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Tanzalian Safari's. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
