@extends('layouts.admin')

@section('title', 'Safari Packages')

@section('content')
<div class="card" style="margin-bottom: 40px;">
    <h3 style="margin-bottom: 20px; font-family: 'Playfair Display', serif;">Add New Package</h3>
    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Package Name</label>
                <input type="text" name="name" required placeholder="e.g. 7-Day Serengeti & Ngorongoro">
            </div>
            <div class="form-group">
                <label>Badge Label</label>
                <input type="text" name="badge_label" placeholder="e.g. Best Seller">
            </div>
            <div class="form-group">
                <label>Duration</label>
                <input type="text" name="duration_label" placeholder="e.g. 7 Days / 6 Nights">
            </div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Price Amount</label>
                <input type="number" name="price_amount" required placeholder="e.g. 1500">
            </div>
            <div class="form-group">
                <label>Price Suffix</label>
                <input type="text" name="price_suffix" value="/person">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="0">
            </div>
        </div>
        <div class="form-group">
            <label>Short Description</label>
            <textarea name="short_description" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label>Features (One per line)</label>
            <textarea name="features_text" rows="4" placeholder="Full Board Accommodation&#10;Professional Guide&#10;Park Fees Included"></textarea>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Package Image</label>
                <input type="file" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Create Package
        </button>
    </form>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                    <td>
                        <img src="{{ asset('uploads/safari_packages/' . $package->image_path) }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td style="font-weight: 600;">{{ $package->name }}</td>
                    <td>${{ number_format($package->price_amount) }}{{ $package->price_suffix }}</td>
                    <td>
                        <span class="badge" style="padding: 4px 10px; border-radius: 20px; font-size: 11px; background: {{ $package->status === 'active' ? '#e3ebe6; color: #2B5238;' : '#F7F7F7; color: #555555;' }}">
                            {{ ucfirst($package->status) }}
                        </span>
                    </td>
                    <td>{{ $package->sort_order }}</td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-primary btn-sm" onclick="editPackage({{ $package->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.packages.delete', $package) }}" method="POST" onsubmit="return confirm('Delete this package?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
