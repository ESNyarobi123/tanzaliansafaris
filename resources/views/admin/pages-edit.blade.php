@extends('layouts.admin')

@section('title', 'Edit ' . ucfirst($slug) . ' Page')

@section('content')
<div class="card">
    <form action="{{ route('admin.pages.update', $slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @if($slug === 'home')
            <div class="form-group">
                <label>Hero Title</label>
                <input type="text" name="hero_title" value="{{ $contents['hero_title'] ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Hero Subtitle</label>
                <textarea name="hero_subtitle" rows="3">{{ $contents['hero_subtitle'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Hero Background Image</label>
                @if(isset($contents['hero_image']))
                    <img src="{{ asset($contents['hero_image']) }}" style="max-width: 300px; border-radius: 10px; margin-bottom: 10px; display: block;">
                @endif
                <input type="file" name="hero_image" accept="image/*">
            </div>
            
            <hr style="margin: 30px 0; border: 0; border-top: 1px solid var(--border);">
            
            <div class="form-group">
                <label>CTA Title</label>
                <input type="text" name="cta_title" value="{{ $contents['cta_title'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>CTA Subtitle</label>
                <input type="text" name="cta_subtitle" value="{{ $contents['cta_subtitle'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>CTA Text</label>
                <textarea name="cta_text" rows="2">{{ $contents['cta_text'] ?? '' }}</textarea>
            </div>
        @endif

        @if($slug === 'about')
            <div class="form-group">
                <label>About Title</label>
                <input type="text" name="about_title" value="{{ $contents['about_title'] ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>About Kicker (Small text above title)</label>
                <input type="text" name="about_kicker" value="{{ $contents['about_kicker'] ?? '' }}">
            </div>
            <div class="form-group">
                <label>About Subtitle</label>
                <textarea name="about_subtitle" rows="2">{{ $contents['about_subtitle'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Paragraph 1</label>
                <textarea name="about_paragraph1" rows="4">{{ $contents['about_paragraph1'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Paragraph 2</label>
                <textarea name="about_paragraph2" rows="4">{{ $contents['about_paragraph2'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Mission Text</label>
                <textarea name="mission_text" rows="3">{{ $contents['mission_text'] ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>About Pills (Comma separated)</label>
                <input type="text" name="about_pills" value="{{ $contents['about_pills'] ?? '' }}" placeholder="e.g. Private Safaris, Group Trips, Zanzibar">
            </div>
            <div class="form-group">
                <label>About Image</label>
                @if(isset($contents['about_image']))
                    <img src="{{ asset($contents['about_image']) }}" style="max-width: 300px; border-radius: 10px; margin-bottom: 10px; display: block;">
                @endif
                <input type="file" name="about_image" accept="image/*">
            </div>
        @endif

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="{{ route('admin.pages') }}" class="btn" style="background: #f1f5f9; color: var(--text);">Cancel</a>
        </div>
    </form>
</div>
@endsection
