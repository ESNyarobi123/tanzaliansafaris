@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('styles')
<style>
    .page-header {
        margin-bottom: 30px;
    }
    .page-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
    }
    .page-header p {
        color: var(--text-light);
        margin-top: 8px;
    }
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid var(--gray-100);
        max-width: 800px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 8px;
        font-size: 14px;
    }
    .form-group label span {
        color: var(--primary-600);
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--gray-200);
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-500);
        box-shadow: 0 0 0 3px rgba(212, 106, 69, 0.1);
    }
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
    .current-image {
        width: 150px;
        height: 150px;
        border-radius: 12px;
        object-fit: cover;
        margin-top: 10px;
        border: 2px solid var(--gray-200);
    }
    .image-preview {
        width: 150px;
        height: 150px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px dashed var(--gray-300);
        display: none;
        margin-top: 10px;
    }
    .btn-group {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-100);
    }
    .btn-submit {
        background: linear-gradient(135deg, var(--secondary-600), var(--secondary-800));
        color: white;
        padding: 12px 32px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(22, 163, 74, 0.3);
    }
    .btn-cancel {
        background: var(--gray-100);
        color: var(--gray-700);
        padding: 12px 32px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .btn-cancel:hover {
        background: var(--gray-200);
    }
    .help-text {
        font-size: 12px;
        color: var(--gray-500);
        margin-top: 6px;
    }
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
    }
    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1><i class="fas fa-user-edit" style="color: var(--primary-600); margin-right: 12px;"></i>Edit Team Member</h1>
    <p>Update {{ $member->name }}'s profile information.</p>
</div>

@if($errors->any())
    <div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 16px 20px; border-radius: 10px; margin-bottom: 24px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-card">
    <form action="{{ route('admin.team-members.update', $member) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Full Name <span>*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $member->name) }}" required>
            </div>
            <div class="form-group">
                <label for="position">Position <span>*</span></label>
                <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $member->position) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="role">Role/Title (Optional)</label>
                <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $member->role) }}">
            </div>
            <div class="form-group">
                <label for="experience_years">Years of Experience</label>
                <input type="number" name="experience_years" id="experience_years" class="form-control" value="{{ old('experience_years', $member->experience_years) }}" min="0">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email (Optional)</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $member->email) }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone (Optional)</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $member->phone) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="bio">Bio/Description (Optional)</label>
            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $member->bio) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="specialties">Specialties (comma separated)</label>
                <input type="text" name="specialties" id="specialties" class="form-control" value="{{ old('specialties', $member->specialties_list) }}">
                <p class="help-text">Separate multiple specialties with commas</p>
            </div>
            <div class="form-group">
                <label for="languages">Languages (comma separated)</label>
                <input type="text" name="languages" id="languages" class="form-control" value="{{ old('languages', $member->languages_list) }}">
                <p class="help-text">Separate multiple languages with commas</p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $member->sort_order) }}" min="0">
                <p class="help-text">Lower numbers appear first</p>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $member->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Profile Photo</label>
            @if($member->image_path)
                <div style="margin-bottom: 12px;">
                    <p class="help-text">Current Photo:</p>
                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="current-image">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
            <p class="help-text">Upload new photo to replace. Recommended size: 400x400px. Max 2MB.</p>
            <img id="image-preview" class="image-preview">
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save" style="margin-right: 8px;"></i>Update Member
            </button>
            <a href="{{ route('admin.team-members') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
