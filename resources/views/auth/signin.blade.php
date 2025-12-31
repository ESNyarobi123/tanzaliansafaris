<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - Tanzalian Safari's</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #d4a373;
            --secondary-color: #2c5530;
            --dark-color: #1a1a1a;
            --light-color: #f8f5f0;
            --accent-color: #ff6b35;
            --text-dark: #333;
            --text-light: #666;
        }
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg,#0b1f16,#2c5530);
            min-height:100vh;
            display:flex;align-items:center;justify-content:center;
            padding:20px;
        }
        .auth-wrapper{
            max-width:950px;width:100%;
            background:#fff;
            border-radius:24px;
            box-shadow:0 20px 60px rgba(0,0,0,0.35);
            display:grid;grid-template-columns:1.1fr 1fr;
            overflow:hidden;
        }
        .auth-hero{
            background:linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.85)),
                url('https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-12_16_42-am.png') center/cover;
            color:#fff;padding:40px 40px 50px;
            display:flex;flex-direction:column;justify-content:space-between;
        }
        .brand{display:flex;align-items:center;gap:10px;}
        .brand-icon{
            width:46px;height:46px;border-radius:50%;
            background:rgba(212,163,115,0.2);
            display:flex;align-items:center;justify-content:center;
            font-size:22px;color:var(--primary-color);
        }
        .brand-text{display:flex;flex-direction:column;}
        .brand-text span:first-child{
            font-family:'Playfair Display',serif;
            font-weight:900;font-size:20px;
        }
        .brand-text span:last-child{font-size:12px;opacity:0.8;}

        .auth-hero-main{margin-top:40px;}
        .auth-hero-main h1{
            font-family:'Playfair Display',serif;
            font-size:30px;margin-bottom:12px;
        }
        .auth-hero-main p{font-size:14px;color:#e5e7eb;line-height:1.7;}

        .hero-pills{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px;}
        .hero-pill{
            font-size:11px;padding:6px 11px;border-radius:999px;
            border:1px solid rgba(212,163,115,0.6);color:#fbbf77;
        }
        .auth-hero-footer{font-size:12px;opacity:0.8;}

        .auth-form-side{
            padding:38px 36px 28px;
            background:#fdfaf6;
            display:flex;flex-direction:column;justify-content:space-between;
        }
        .auth-header{margin-bottom:22px;}
        .auth-header h2{
            font-size:24px;color:var(--secondary-color);
            font-family:'Playfair Display',serif;margin-bottom:4px;
        }
        .auth-header p{font-size:13px;color:var(--text-light);}
        form{margin-top:8px;}
        .form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:14px;}
        label{font-size:13px;color:var(--text-dark);font-weight:500;}
        input[type="email"],input[type="password"]{
            padding:10px 12px;border-radius:10px;border:1px solid #e5e7eb;
            font-size:14px;outline:none;transition:all .2s;background:#fff;
        }
        input:focus{
            border-color:var(--primary-color);
            box-shadow:0 0 0 1px rgba(212,163,115,0.4);
        }
        .alert{
            padding:10px 12px;border-radius:10px;font-size:13px;margin-bottom:12px;
        }
        .alert-error{
            background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;
        }
        .alert ul{margin-left:18px;margin-top:6px;}

        .inline-row{
            display:flex;align-items:center;justify-content:space-between;
            font-size:12px;
        }
        .inline-row-left{
            display:flex;align-items:center;gap:6px;color:var(--text-light);
        }
        .inline-row-left input[type="checkbox"]{width:14px;height:14px;margin:0;}
        .inline-row a{color:var(--accent-color);text-decoration:none;font-weight:500;}

        button[type="submit"]{
            margin-top:16px;width:100%;border:none;border-radius:999px;
            padding:11px 16px;background:var(--secondary-color);
            color:#fff;font-weight:600;font-size:15px;
            display:inline-flex;align-items:center;justify-content:center;
            gap:8px;cursor:pointer;
            box-shadow:0 13px 30px rgba(15,23,42,0.35);
            transition:all .25s;
        }
        button[type="submit"]:hover{
            transform:translateY(-1px);
            box-shadow:0 16px 36px rgba(15,23,42,0.45);
        }
        .divider{display:flex;align-items:center;margin:18px 0 12px;}
        .divider span{flex:1;height:1px;background:#e5e7eb;}
        .divider p{
            margin:0 10px;font-size:11px;color:var(--text-light);
            text-transform:uppercase;letter-spacing:1px;
        }
        .social-row{display:flex;gap:10px;}
        .social-btn{
            flex:1;border-radius:999px;border:1px solid #e5e7eb;background:#fff;
            font-size:12px;padding:8px 10px;
            display:inline-flex;align-items:center;justify-content:center;
            gap:6px;color:var(--text-dark);cursor:pointer;
        }
        .auth-footer-text{
            margin-top:16px;font-size:11px;color:var(--text-light);text-align:center;
        }
        .auth-footer-text a{color:var(--accent-color);text-decoration:none;font-weight:500;}
        .back-home{margin-top:10px;text-align:center;}
        .back-home a{font-size:12px;color:var(--secondary-color);text-decoration:none;}
        .back-home a i{margin-right:5px;}

        @media(max-width:900px){
            .auth-wrapper{grid-template-columns:1fr;max-width:480px;}
            .auth-hero{display:none;}
            body{background:#f3f4f6;}
        }
        @media(max-width:480px){
            .auth-form-side{padding:26px 18px 20px;}
            .auth-header h2 { font-size: 20px; }
            .social-row { flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-hero">
        <div>
            <div class="brand">
                <div class="brand-icon"><i class="fas fa-mountain-sun"></i></div>
                <div class="brand-text">
                    <span>Tanzalian Safari's</span>
                    <span>Welcome Back, Traveler</span>
                </div>
            </div>
            <div class="auth-hero-main">
                <h1>Sign in to manage your trips</h1>
                <p>Access your saved itineraries, upcoming safari bookings, and special offers tailored to your interests in Tanzania.</p>
                <div class="hero-pills">
                    <div class="hero-pill">Manage bookings</div>
                    <div class="hero-pill">Save favourite packages</div>
                    <div class="hero-pill">Faster checkout</div>
                    <div class="hero-pill">Local support</div>
                </div>
            </div>
        </div>
        <p class="auth-hero-footer">
            Need help signing in? Contact us at <strong>info@tanzaliansafaris.com</strong> or WhatsApp <strong>+255691111111</strong>.
        </p>
    </div>

    <div class="auth-form-side">
        <div>
            <div class="auth-header">
                <h2>Sign In</h2>
                <p>Enter your details to access your Tanzalian Safari's account.</p>
            </div>

            @if (session('success'))
                <div class="alert" style="background: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Login failed:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('signin') }}" method="post" novalidate>
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password" required>
                </div>

                <div class="inline-row">
                    <div class="inline-row-left">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" style="font-weight:400;">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>

                <button type="submit">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>

                <div class="divider">
                    <span></span>
                    <p>or continue with</p>
                    <span></span>
                </div>

                <div class="social-row">
                    <button type="button" class="social-btn">
                        <i class="fab fa-google"></i> Google
                    </button>
                    <button type="button" class="social-btn">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </button>
                </div>

                <p class="auth-footer-text">
                    Don't have an account yet?
                    <a href="{{ route('signup') }}">Create one now</a>
                </p>
            </form>
        </div>

        <div class="back-home">
            <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to Homepage</a>
        </div>
    </div>
</div>
</body>
</html>
