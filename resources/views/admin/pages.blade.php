@extends('layouts.admin')

@section('title', 'Page Content Management')

@section('content')
<div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
    <div class="card" style="text-align: center; padding: 40px;">
        <div style="font-size: 50px; color: var(--primary); margin-bottom: 20px;">
            <i class="fas fa-home"></i>
        </div>
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 10px;">Home Page</h2>
        <p style="color: var(--text-light); margin-bottom: 25px;">Manage hero section, titles, and main images of the landing page.</p>
        <a href="{{ route('admin.pages.edit', 'home') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Content
        </a>
    </div>

    <div class="card" style="text-align: center; padding: 40px;">
        <div style="font-size: 50px; color: var(--secondary); margin-bottom: 20px;">
            <i class="fas fa-info-circle"></i>
        </div>
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 10px;">About Page</h2>
        <p style="color: var(--text-light); margin-bottom: 25px;">Manage company history, mission, and team information.</p>
        <a href="{{ route('admin.pages.edit', 'about') }}" class="btn btn-primary" style="background: var(--secondary);">
            <i class="fas fa-edit"></i> Edit Content
        </a>
    </div>
</div>
@endsection
