@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('styles')
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }
    .gallery-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.02);
        border: 1px solid var(--border);
        transition: transform 0.3s;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
    }
    .gallery-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .gallery-info {
        padding: 20px;
    }
    .gallery-info h4 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        margin-bottom: 5px;
    }
    .gallery-info p {
        color: var(--text-light);
        font-size: 13px;
        margin-bottom: 15px;
    }
    .gallery-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }
</style>
@endsection

@section('content')
<div class="card" style="margin-bottom: 40px;">
    <h3 style="margin-bottom: 20px; font-family: 'Playfair Display', serif;">Upload New Image</h3>
    <form action="{{ route('admin.gallery.upload') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required placeholder="e.g. Serengeti Sunset">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="subtitle" placeholder="e.g. Wildlife Experience">
            </div>
        </div>
        <div class="form-group">
            <label>Image File</label>
            <input type="file" name="image" required accept="image/*">
            <p style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Recommended: 1200x800px, Max 5MB</p>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-upload"></i> Upload to Gallery
        </button>
    </form>
</div>

<div class="gallery-grid">
    @foreach($images as $image)
    <div class="gallery-card">
        <img src="{{ asset('uploads/gallery/' . $image->image_path) }}" class="gallery-img" alt="{{ $image->title }}">
        <div class="gallery-info">
            <h4>{{ $image->title }}</h4>
            <p>{{ $image->subtitle }}</p>
            <div class="gallery-actions">
                <form action="{{ route('admin.gallery.toggle', $image) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $image->status === 'active' ? 'btn-primary' : 'btn-secondary' }}" style="background: {{ $image->status === 'active' ? '' : '#64748b' }}">
                        <i class="fas {{ $image->status === 'active' ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                        {{ ucfirst($image->status) }}
                    </button>
                </form>
                
                <form action="{{ route('admin.gallery.delete', $image) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
