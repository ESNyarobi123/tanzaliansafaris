@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td style="font-weight: 600;">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge" style="padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; background: {{ $user->role === 'super_admin' ? '#fee2e2; color: #991b1b;' : ($user->role === 'admin' ? '#eff6ff; color: #1e40af;' : '#f1f5f9; color: #475569;') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <span style="color: {{ $user->status === 'active' ? '#22c55e' : '#ef4444' }}; font-weight: 600;">
                            <i class="fas fa-circle" style="font-size: 8px; vertical-align: middle; margin-right: 5px;"></i>
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            @if($user->role !== 'super_admin' && $user->id !== auth()->id())
                                <form action="{{ route('admin.users.role', $user) }}" method="POST" style="display: flex; gap: 5px;">
                                    @csrf
                                    <select name="role" class="btn-sm" style="padding: 4px 8px; width: auto;">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                                
                                <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span style="color: var(--text-light); font-size: 12px; font-style: italic;">No actions</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
