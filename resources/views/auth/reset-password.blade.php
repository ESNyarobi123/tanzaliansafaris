@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<section style="min-height: 80vh; display: flex; align-items: center; background: #f8f5f0; padding: 60px 0;">
    <div class="container">
        <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; color: var(--secondary-color); margin-bottom: 10px;">Reset Password</h2>
                <p style="color: var(--text-light);">Enter the OTP sent to your email and your new password.</p>
            </div>

            <form action="{{ route('password.reset.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">OTP Code</label>
                    <input type="text" name="otp" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; outline: none; text-align: center; letter-spacing: 5px; font-weight: bold; font-size: 20px;" placeholder="XXXXXX">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">New Password</label>
                    <input type="password" name="password" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; outline: none;" placeholder="Min 8 characters">
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; outline: none;" placeholder="Confirm your password">
                </div>

                <button type="submit" style="width: 100%; padding: 14px; background: var(--secondary-color); color: #fff; border: none; border-radius: 50px; font-weight: 700; cursor: pointer; transition: all 0.3s;">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
