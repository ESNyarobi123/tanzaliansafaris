@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="card">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 30px;">
            <h3 style="margin-bottom: 20px; color: var(--primary); border-bottom: 2px solid var(--border); padding-bottom: 10px;">
                <i class="fas fa-envelope"></i> Email Configuration (SMTP)
            </h3>
            <p style="color: var(--text-light); margin-bottom: 20px; font-size: 14px;">
                Configure the official email used for sending OTPs, welcome emails, and newsletters.
            </p>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>SMTP Host</label>
                    <input type="text" name="mail_host" value="{{ $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_host')->first()->value ?? 'mail.tanzalian-safaris.com' : 'mail.tanzalian-safaris.com' }}" placeholder="e.g. mail.example.com">
                </div>
                <div class="form-group">
                    <label>SMTP Port</label>
                    <input type="text" name="mail_port" value="{{ $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_port')->first()->value ?? '465' : '465' }}" placeholder="e.g. 465 or 587">
                </div>
                <div class="form-group">
                    <label>SMTP Username</label>
                    <input type="text" name="mail_username" value="{{ $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_username')->first()->value ?? 'info@tanzalian-safaris.com' : 'info@tanzalian-safaris.com' }}">
                </div>
                <div class="form-group">
                    <label>SMTP Password</label>
                    <input type="password" name="mail_password" value="{{ $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_password')->first()->value ?? 'ESNyarobi@1234' : 'ESNyarobi@1234' }}">
                </div>
                <div class="form-group">
                    <label>Mail Encryption</label>
                    <select name="mail_encryption">
                        @php $enc = $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_encryption')->first()->value ?? 'ssl' : 'ssl'; @endphp
                        <option value="ssl" {{ $enc == 'ssl' ? 'selected' : '' }}>SSL</option>
                        <option value="tls" {{ $enc == 'tls' ? 'selected' : '' }}>TLS</option>
                        <option value="none" {{ $enc == 'none' ? 'selected' : '' }}>None</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>From Address</label>
                    <input type="email" name="mail_from_address" value="{{ $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_from_address')->first()->value ?? 'info@tanzalian-safaris.com' : 'info@tanzalian-safaris.com' }}">
                </div>
                <div class="form-group">
                    <label>From Name</label>
                    <input type="text" name="mail_from_name" value="{{ $settings['mail'] ?? '' ? $settings['mail']->where('key', 'mail_from_name')->first()->value ?? 'Tanzalian Safari\'s' : 'Tanzalian Safari\'s' }}">
                </div>
            </div>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="margin-bottom: 20px; color: var(--primary); border-bottom: 2px solid var(--border); padding-bottom: 10px;">
                <i class="fas fa-globe"></i> General Settings
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" name="site_name" value="{{ $settings['general'] ?? '' ? $settings['general']->where('key', 'site_name')->first()->value ?? 'Tanzalian Safari\'s' : 'Tanzalian Safari\'s' }}">
                </div>
                <div class="form-group">
                    <label>Contact Phone</label>
                    <input type="text" name="contact_phone" value="{{ $settings['general'] ?? '' ? $settings['general']->where('key', 'contact_phone')->first()->value ?? '+255 691 111 111' : '+255 691 111 111' }}">
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="email" name="contact_email" value="{{ $settings['general'] ?? '' ? $settings['general']->where('key', 'contact_email')->first()->value ?? 'info@tanzalian-safaris.com' : 'info@tanzalian-safaris.com' }}">
                </div>
                <div class="form-group">
                    <label>Office Address</label>
                    <input type="text" name="office_address" value="{{ $settings['general'] ?? '' ? $settings['general']->where('key', 'office_address')->first()->value ?? 'Dar es salaam, Tanzania' : 'Dar es salaam, Tanzania' }}">
                </div>
            </div>
        </div>

        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>
    </form>
</div>

<div class="card" style="background: #f0fdf4; border-color: #bbf7d0;">
    <h3 style="color: #2B5238; margin-bottom: 15px;"><i class="fas fa-info-circle"></i> Note on Email Settings</h3>
    <p style="color: #2B5238; font-size: 14px;">
        These settings will be used across the entire platform for:
        <ul style="margin-left: 20px; margin-top: 10px; color: #2B5238; font-size: 14px;">
            <li>Sending OTPs for password resets</li>
            <li>Welcome emails for new registrations</li>
            <li>Newsletter announcements and updates</li>
            <li>Booking confirmation notifications</li>
        </ul>
    </p>
</div>
@endsection
