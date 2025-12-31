@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<section style="min-height: 80vh; display: flex; align-items: center; background: #f8f5f0; padding: 60px 0;">
    <div class="container">
        <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; color: var(--secondary-color); margin-bottom: 10px;">Forgot Password?</h2>
                <p style="color: var(--text-light);">Enter your email to receive a 6-digit OTP code.</p>
            </div>

            <form action="{{ route('password.otp') }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Email Address</label>
                    <input type="email" name="email" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; outline: none;" placeholder="Enter your email">
                </div>

                <button type="submit" style="width: 100%; padding: 14px; background: var(--secondary-color); color: #fff; border: none; border-radius: 50px; font-weight: 700; cursor: pointer; transition: all 0.3s;">
                    Send OTP Code
                </button>
            </form>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('signin') }}" style="color: var(--primary-color); text-decoration: none; font-size: 14px; font-weight: 600;">Back to Sign In</a>
            </div>
        </div>
    </div>
</section>
@endsection
