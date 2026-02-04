@extends('layouts.admin')

@section('title', 'Team Members')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    .page-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--secondary-600), var(--secondary-800));
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(22, 163, 74, 0.3);
    }
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }
    .team-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid var(--gray-100);
        transition: all 0.3s ease;
    }
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .team-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .team-info {
        padding: 20px;
    }
    .team-name {
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }
    .team-position {
        font-size: 14px;
        color: var(--primary-600);
        font-weight: 600;
        margin-bottom: 8px;
    }
    .team-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }
    .team-badge {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 500;
    }
    .badge-experience {
        background: #f0fdf4;
        color: #2B5238;
    }
    .badge-languages {
        background: #eff6ff;
        color: #1d4ed8;
    }
    .team-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 12px;
    }
    .status-active {
        background: #e3ebe6;
        color: #2B5238;
    }
    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }
    .team-actions {
        display: flex;
        gap: 8px;
        padding-top: 12px;
        border-top: 1px solid var(--gray-100);
    }
    .btn-action {
        flex: 1;
        padding: 8px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-edit {
        background: #eff6ff;
        color: #3b82f6;
    }
    .btn-edit:hover {
        background: #3b82f6;
        color: white;
    }
    .btn-delete {
        background: #fee2e2;
        color: #ef4444;
        border: none;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
    }
    .empty-state i {
        font-size: 64px;
        color: var(--gray-300);
        margin-bottom: 20px;
    }
    .empty-state h3 {
        color: var(--gray-600);
        margin-bottom: 10px;
    }
    .empty-state p {
        color: var(--gray-400);
        margin-bottom: 24px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1><i class="fas fa-users" style="color: var(--primary-600); margin-right: 12px;"></i>Team Members</h1>
    <a href="{{ route('admin.team-members.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Add Member
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success" style="background: #e3ebe6; color: #2B5238; padding: 16px 20px; border-radius: 10px; margin-bottom: 24px;">
        <i class="fas fa-check-circle" style="margin-right: 8px;"></i>{{ session('success') }}
    </div>
@endif

@if($members->count() > 0)
    <div class="team-grid">
        @foreach($members as $member)
        <div class="team-card">
            <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="team-image">
            <div class="team-info">
                <span class="team-status status-{{ $member->status }}">
                    {{ ucfirst($member->status) }}
                </span>
                <h3 class="team-name">{{ $member->name }}</h3>
                <p class="team-position">{{ $member->position }}</p>
                
                <div class="team-meta">
                    @if($member->experience_years > 0)
                        <span class="team-badge badge-experience">
                            <i class="fas fa-star" style="margin-right: 4px;"></i>{{ $member->experience_years }} Years
                        </span>
                    @endif
                    @if($member->languages)
                        <span class="team-badge badge-languages">
                            <i class="fas fa-language" style="margin-right: 4px;"></i>{{ count($member->languages) }} Languages
                        </span>
                    @endif
                </div>
                
                <div class="team-actions">
                    <a href="{{ route('admin.team-members.edit', $member) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.team-members.delete', $member) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Are you sure you want to delete this team member?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" style="width: 100%;">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-users"></i>
        <h3>No Team Members Yet</h3>
        <p>Add your first team member to display them on the website.</p>
        <a href="{{ route('admin.team-members.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Add First Member
        </a>
    </div>
@endif
@endsection
