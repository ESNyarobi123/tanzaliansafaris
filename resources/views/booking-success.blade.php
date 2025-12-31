@extends('layouts.app')

@section('title', 'Booking Successful - Tanzalian Safari\'s')

@section('styles')
<style>
    .success-wrapper {
        background: #f8fafc;
        padding: 100px 0;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }
    .success-card {
        background: white;
        padding: 60px;
        border-radius: 30px;
        max-width: 700px;
        margin: 0 auto;
        text-align: center;
        box-shadow: 0 30px 60px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    .success-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(to right, #d4a373, #2c5530);
    }
    .success-icon {
        width: 100px;
        height: 100px;
        background: #d1fae5;
        color: #059669;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin: 0 auto 30px;
        animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }
    .success-card h1 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        color: #0f172a;
        margin-bottom: 20px;
    }
    .success-card p {
        font-size: 18px;
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 40px;
    }
    .ref-container {
        background: #f1f5f9;
        padding: 25px;
        border-radius: 20px;
        margin-bottom: 40px;
    }
    .ref-label {
        font-size: 14px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    .ref-value {
        font-family: 'Poppins', sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: #d4a373;
        letter-spacing: 2px;
    }
    .action-btns {
        display: flex;
        gap: 20px;
        justify-content: center;
    }
    .btn-primary {
        background: #d4a373;
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
    }
    .btn-secondary {
        background: #0f172a;
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
    }
    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    @media (max-width: 640px) {
        .success-card { padding: 40px 20px; }
        .action-btns { flex-direction: column; }
        .success-card h1 { font-size: 32px; }
    }
</style>
@endsection

@section('content')
<div class="success-wrapper">
    <div class="container">
        <div class="success-card" data-aos="zoom-in">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1>Asante Sana!</h1>
            <p>Your booking request has been received. Our safari experts are already working on your itinerary and will contact you within 24 hours.</p>
            
            <div class="ref-container">
                <div class="ref-label">Booking Reference</div>
                <div class="ref-value">{{ $ref }}</div>
            </div>

            @if(request()->query('pay') === 'zeno')
                <div id="payment-status-box" style="margin-bottom: 30px; padding: 20px; border-radius: 15px; background: #fffbeb; border: 1px solid #fef3c7;">
                    <div id="status-spinner" style="margin-bottom: 15px;">
                        <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #d97706;"></i>
                    </div>
                    <h3 id="status-text" style="font-size: 16px; color: #92400e;">Waiting for Mobile Money Payment...</h3>
                    <p style="font-size: 14px; color: #b45309; margin-top: 5px;">Please check your phone for the PIN prompt.</p>
                </div>
            @endif

            @php
                $paymentMethod = \App\Models\Booking::where('reference', $ref)->first()->payment_method ?? '';
            @endphp

            @if($paymentMethod === 'usdt')
                <div style="margin-bottom: 40px; padding: 30px; background: #f8fafc; border-radius: 20px; border: 1px solid #e2e8f0;">
                    <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 15px;">Pay with USDT (TRC20)</h3>
                    @if(\App\Models\PaymentSetting::get('usdt_qr_code'))
                        <img src="{{ asset(\App\Models\PaymentSetting::get('usdt_qr_code')) }}" alt="USDT QR" style="max-width: 200px; margin-bottom: 15px; border-radius: 10px;">
                    @endif
                    <div style="background: white; padding: 12px; border-radius: 10px; border: 1px solid #cbd5e1; font-family: monospace; font-size: 14px; word-break: break-all;">
                        {{ \App\Models\PaymentSetting::get('usdt_address') }}
                    </div>
                    <p style="font-size: 13px; color: #64748b; margin-top: 10px;">Send exactly the amount to the address above and notify us.</p>
                </div>
            @elseif($paymentMethod === 'bank_swift')
                <div style="margin-bottom: 40px; padding: 30px; background: #f8fafc; border-radius: 20px; border: 1px solid #e2e8f0; text-align: left;">
                    <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 15px; text-align: center;">Bank Transfer Details</h3>
                    <div style="white-space: pre-line; color: #475569; font-size: 15px; line-height: 1.6;">
                        {{ \App\Models\PaymentSetting::get('bank_details') }}
                    </div>
                </div>
            @endif
            
            <div class="action-btns">
                <a href="{{ route('dashboard') }}" class="btn-primary">View My Dashboard</a>
                <a href="{{ route('home') }}" class="btn-secondary">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    @if(request()->query('pay') === 'zeno')
    let checkCount = 0;
    const maxChecks = 30; // 5 minutes (10s intervals)
    
    function checkPaymentStatus() {
        fetch("{{ route('booking.status', $ref) }}")
            .then(res => res.json())
            .then(data => {
                if (data.result === 'SUCCESS' || (data.data && data.data[0].payment_status === 'COMPLETED')) {
                    document.getElementById('payment-status-box').style.background = '#d1fae5';
                    document.getElementById('payment-status-box').style.borderColor = '#10b981';
                    document.getElementById('status-spinner').innerHTML = '<i class="fas fa-check-circle" style="font-size: 32px; color: #059669;"></i>';
                    document.getElementById('status-text').innerText = 'Payment Successful!';
                    document.getElementById('status-text').style.color = '#065f46';
                } else {
                    checkCount++;
                    if (checkCount < maxChecks) {
                        setTimeout(checkPaymentStatus, 10000);
                    } else {
                        document.getElementById('status-text').innerText = 'Payment timeout. Please contact support if you have paid.';
                    }
                }
            })
            .catch(err => console.error(err));
    }
    
    setTimeout(checkPaymentStatus, 5000);
    @endif
</script>
@endsection
