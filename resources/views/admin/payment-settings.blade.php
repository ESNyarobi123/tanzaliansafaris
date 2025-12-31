@extends('layouts.admin')

@section('title', 'Payment Settings')

@section('content')
<div class="card">
    <form action="{{ route('admin.payment-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @foreach($settings as $group => $groupSettings)
            <div style="margin-bottom: 40px; border-bottom: 1px solid #f1f5f9; padding-bottom: 20px;">
                <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 20px; color: var(--primary); text-transform: uppercase; font-size: 18px; letter-spacing: 1px;">
                    {{ $group }} Settings
                </h2>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    @foreach($groupSettings as $setting)
                        <div class="form-group">
                            <label>{{ str_replace('_', ' ', ucfirst($setting->key)) }}</label>
                            
                            @if($setting->type === 'boolean')
                                <select name="{{ $setting->key }}">
                                    <option value="1" {{ $setting->value == '1' ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $setting->value == '0' ? 'selected' : '' }}>Disabled</option>
                                </select>
                            @elseif($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" rows="4">{{ $setting->value }}</textarea>
                            @elseif($setting->type === 'image')
                                @if($setting->value)
                                    <div style="margin-bottom: 10px;">
                                        <img src="{{ asset($setting->value) }}" alt="QR Code" style="max-width: 150px; border-radius: 10px; border: 1px solid #ddd;">
                                    </div>
                                @endif
                                <input type="file" name="{{ $setting->key }}">
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection
