<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #2c5530; }
        .content { margin-bottom: 30px; }
        .footer { text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 20px; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #d4a373; color: #fff; text-decoration: none; border-radius: 50px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Tanzalian Safari's!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            <p>Thank you for joining our community! We are thrilled to have you with us.</p>
            <p>At Tanzalian Safari's, we are dedicated to providing you with the most authentic and breathtaking adventures in East Africa.</p>
            <p>You can now log in to your dashboard to manage your bookings and explore our exclusive safari packages.</p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('signin') }}" class="btn">Log In to Your Account</a>
            </div>
            <p>If you have any questions, feel free to reply to this email or contact our support team.</p>
            <p>Best Regards,<br>The Tanzalian Safari's Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Tanzalian Safari's. All rights reserved.</p>
            <p>Arusha, Tanzania</p>
        </div>
    </div>
</body>
</html>
