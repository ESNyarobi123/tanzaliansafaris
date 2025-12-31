@extends('layouts.admin')

@section('title', 'Newsletter Management')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 30px;">
    <!-- Send Announcement -->
    <div>
        <div class="card">
            <h3 style="margin-bottom: 20px; color: var(--primary);">
                <i class="fas fa-paper-plane"></i> Send Announcement
            </h3>
            <p style="color: var(--text-light); margin-bottom: 20px; font-size: 14px;">
                Send an email notification or announcement to selected groups.
            </p>
            
            <form action="{{ route('admin.newsletter.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Send To</label>
                    <select name="target" required>
                        <option value="newsletter">Newsletter Subscribers ({{ $counts['newsletter'] }})</option>
                        <option value="staff">All Staff Members ({{ $counts['staff'] }})</option>
                        <option value="users">All Registered Users ({{ $counts['users'] }})</option>
                        <option value="all">Everyone ({{ $counts['all'] }})</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" required placeholder="e.g. Important Update for Staff">
                </div>
                <div class="form-group">
                    <label>Message Content</label>
                    <textarea name="message" rows="10" required placeholder="Write your announcement here..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-bullhorn"></i> Broadcast Message
                </button>
            </form>
        </div>
    </div>

    <!-- Subscribers List -->
    <div>
        <div class="card">
            <h3 style="margin-bottom: 20px; color: var(--primary);">
                <i class="fas fa-users"></i> Subscribers ({{ count($subscribers) }})
            </h3>
            
            <div class="table-container" style="max-height: 400px; overflow-y: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Email Address</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->email }}</td>
                                <td>{{ $subscriber->created_at->format('M d, Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.newsletter.delete', $subscriber) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this subscriber?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 30px; color: var(--text-light);">
                                    No subscribers found yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Broadcast History -->
<div class="card" style="margin-top: 30px;">
    <h3 style="margin-bottom: 20px; color: var(--primary);">
        <i class="fas fa-history"></i> Broadcast History
    </h3>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Target</th>
                    <th>Subject</th>
                    <th>Sent</th>
                    <th>Failed</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $item)
                    <tr>
                        <td>{{ $item->created_at->format('M d, Y H:i') }}</td>
                        <td><span style="background: #f1f5f9; padding: 4px 8px; border-radius: 4px; font-size: 12px; text-transform: capitalize;">{{ $item->target }}</span></td>
                        <td>{{ $item->subject }}</td>
                        <td style="color: #166534; font-weight: 600;">{{ $item->sent_count }}</td>
                        <td style="color: #991b1b; font-weight: 600;">{{ $item->failed_count }}</td>
                        <td>
                            @if($item->failed_count == 0)
                                <span style="color: #166534;"><i class="fas fa-check-circle"></i> Success</span>
                            @else
                                <span style="color: #f59e0b;"><i class="fas fa-exclamation-triangle"></i> Partial</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-light);">
                            No broadcast history found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
