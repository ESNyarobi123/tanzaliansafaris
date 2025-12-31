<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gallery;
use App\Models\SafariPackage;
use App\Models\Booking;
use App\Models\PageContent;
use App\Models\PaymentSetting;
use App\Models\SiteSetting;
use App\Models\Newsletter;
use App\Models\BroadcastHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_supers' => User::where('role', 'super_admin')->count(),
            'active_gallery' => Gallery::where('status', 'active')->count(),
            'hidden_gallery' => Gallery::where('status', '!=', 'active')->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        if ($user->role === 'super_admin') {
            return back()->with('error', 'You cannot change the role of a super admin.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        if ($user->role === 'super_admin') {
            return back()->with('error', 'You cannot delete a super admin.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function gallery()
    {
        $images = Gallery::orderBy('created_at', 'desc')->get();
        return view('admin.gallery', compact('images'));
    }

    public function uploadGalleryImage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $image = $request->file('image');
        $filename = 'img_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $image->getClientOriginalExtension();
        
        // Ensure directory exists
        $path = public_path('uploads/gallery');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $image->move($path, $filename);

        Gallery::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_path' => $filename,
            'status' => 'active',
        ]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function toggleGalleryStatus(Gallery $image)
    {
        $newStatus = $image->status === 'active' ? 'inactive' : 'active';
        $image->update(['status' => $newStatus]);

        return back()->with('success', 'Gallery item status updated.');
    }

    public function deleteGalleryImage(Gallery $image)
    {
        $filePath = public_path('uploads/gallery/' . $image->image_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $image->delete();

        return back()->with('success', 'Gallery item deleted.');
    }

    public function pages()
    {
        return view('admin.pages');
    }

    public function editPageContent($slug)
    {
        $allowed = ['home', 'about'];
        if (!in_array($slug, $allowed)) abort(404);

        $contents = PageContent::where('page_slug', $slug)->get()->pluck('content', 'section_key')->toArray();
        
        return view('admin.pages-edit', compact('slug', 'contents'));
    }

    public function updatePageContent(Request $request, $slug)
    {
        $data = $request->except(['_token', 'hero_image', 'about_image']);

        foreach ($data as $key => $value) {
            PageContent::updateOrCreate(
                ['page_slug' => $slug, 'section_key' => $key],
                ['content' => $value]
            );
        }

        // Handle Image Uploads
        if ($request->hasFile('hero_image')) {
            $this->handlePageImage($request->file('hero_image'), $slug, 'hero_image');
        }
        if ($request->hasFile('about_image')) {
            $this->handlePageImage($request->file('about_image'), $slug, 'about_image');
        }

        return back()->with('success', 'Page content updated successfully.');
    }

    private function handlePageImage($file, $slug, $key)
    {
        $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = public_path('uploads/pages');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }
        $file->move($path, $filename);
        
        PageContent::updateOrCreate(
            ['page_slug' => $slug, 'section_key' => $key],
            ['content' => 'uploads/pages/' . $filename]
        );
    }

    public function packages()
    {
        $packages = SafariPackage::orderBy('sort_order', 'asc')->get();
        return view('admin.packages', compact('packages'));
    }

    public function storePackage(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'badge_label' => 'nullable|string|max:50',
            'duration_label' => 'nullable|string|max:50',
            'short_description' => 'nullable|string',
            'features_text' => 'nullable|string',
            'price_amount' => 'required|numeric',
            'price_suffix' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'pkg_' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/safari_packages');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image->move($path, $filename);
            $data['image_path'] = $filename;
        }

        unset($data['image']);
        SafariPackage::create($data);

        return back()->with('success', 'Package created successfully.');
    }

    public function updatePackage(Request $request, SafariPackage $package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'badge_label' => 'nullable|string|max:50',
            'duration_label' => 'nullable|string|max:50',
            'short_description' => 'nullable|string',
            'features_text' => 'nullable|string',
            'price_amount' => 'required|numeric',
            'price_suffix' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($package->image_path && File::exists(public_path('uploads/safari_packages/' . $package->image_path))) {
                File::delete(public_path('uploads/safari_packages/' . $package->image_path));
            }

            $image = $request->file('image');
            $filename = 'pkg_' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/safari_packages');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image->move($path, $filename);
            $data['image_path'] = $filename;
        }

        unset($data['image']);
        $package->update($data);

        return back()->with('success', 'Package updated successfully.');
    }

    public function deletePackage(SafariPackage $package)
    {
        if ($package->image_path && File::exists(public_path('uploads/safari_packages/' . $package->image_path))) {
            File::delete(public_path('uploads/safari_packages/' . $package->image_path));
        }
        $package->delete();

        return back()->with('success', 'Package deleted successfully.');
    }

    public function bookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function approveBooking(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        return back()->with('success', 'Booking approved.');
    }

    public function deleteBooking(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Booking deleted.');
    }

    public function paymentSettings()
    {
        $settings = PaymentSetting::all()->groupBy('group');
        return view('admin.payment-settings', compact('settings'));
    }

    public function updatePaymentSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = 'pay_' . $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('uploads/payments');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0755, true);
                }
                $file->move($path, $filename);
                $value = 'uploads/payments/' . $filename;
            }

            PaymentSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Payment settings updated successfully.');
    }

    public function siteSettings()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function updateSiteSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Site settings updated successfully.');
    }

    public function newsletter()
    {
        $subscribers = Newsletter::orderBy('created_at', 'desc')->get();
        $history = BroadcastHistory::orderBy('created_at', 'desc')->get();
        
        $counts = [
            'newsletter' => Newsletter::count(),
            'staff' => User::whereIn('role', ['staff', 'admin', 'super_admin'])->count(),
            'users' => User::count(),
            'all' => (Newsletter::pluck('email')->merge(User::pluck('email')))->unique()->count(),
        ];

        return view('admin.newsletter', compact('subscribers', 'history', 'counts'));
    }

    public function deleteNewsletter(Newsletter $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed.');
    }

    public function sendAnnouncement(Request $request)
    {
        $request->validate([
            'target' => 'required|in:newsletter,staff,users,all',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $emails = collect();

        if (in_array($request->target, ['newsletter', 'all'])) {
            $emails = $emails->merge(Newsletter::pluck('email'));
        }

        if (in_array($request->target, ['staff', 'all'])) {
            $emails = $emails->merge(User::whereIn('role', ['staff', 'admin', 'super_admin'])->pluck('email'));
        }

        if (in_array($request->target, ['users', 'all'])) {
            $emails = $emails->merge(User::pluck('email'));
        }

        // Remove duplicates and empty emails
        $emails = $emails->unique()->filter();

        if ($emails->isEmpty()) {
            return back()->with('error', 'No recipients found for the selected target.');
        }
        
        // In a real app, you'd use a Job/Queue for this
        $sentCount = 0;
        $failedCount = 0;
        foreach ($emails as $email) {
            try {
                Mail::raw($request->message, function ($mail) use ($email, $request) {
                    $mail->to($email)
                         ->subject($request->subject);
                });
                $sentCount++;
            } catch (\Exception $e) {
                $failedCount++;
                \Log::error("Failed to send broadcast email to $email: " . $e->getMessage());
            }
        }

        // Save to history
        BroadcastHistory::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'target' => $request->target,
            'sent_count' => $sentCount,
            'failed_count' => $failedCount,
        ]);

        return back()->with('success', "Announcement sent successfully to $sentCount recipients" . ($failedCount > 0 ? " ($failedCount failed)." : "."));
    }
}
