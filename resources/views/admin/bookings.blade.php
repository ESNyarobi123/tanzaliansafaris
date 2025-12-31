@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ref #</th>
                    <th>Customer</th>
                    <th>Package</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td style="font-weight: 700; color: var(--primary);">#{{ $booking->id }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $booking->full_name }}</div>
                        <div style="font-size: 12px; color: var(--text-light);">{{ $booking->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ $booking->package_id }}</div>
                        <div style="font-size: 11px; color: var(--text-light);">{{ $booking->accommodation }}</div>
                    </td>
                    <td>
                        <div>{{ $booking->start_date }}</div>
                        <div style="font-size: 11px; color: var(--text-light);">{{ $booking->nights }} Nights</div>
                    </td>
                    <td>
                        <span class="badge" style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: {{ $booking->status === 'approved' ? '#dcfce7; color: #166534;' : ($booking->status === 'pending' ? '#fff7ed; color: #9a3412;' : '#f1f5f9; color: #475569;') }}">
                            {{ strtoupper($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            @if($booking->status === 'pending')
                                <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.bookings.delete', $booking) }}" method="POST" onsubmit="return confirm('Delete this booking?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm" style="background: var(--dark); color: white;" onclick="viewDetails({{ $booking->id }})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
