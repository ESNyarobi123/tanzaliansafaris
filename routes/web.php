<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Placeholder routes for other pages
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/packages', [PackageController::class, 'index'])->name('packages');
Route::get('/packages/{id}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/services', function () { return view('services'); })->name('services');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', function () { return view('blog'); })->name('blog');
Route::get('/destinations', function () { return view('destinations'); })->name('destinations');
Route::get('/faqs', function () { return view('faqs'); })->name('faqs');
Route::get('/privacy', function () { return view('privacy'); })->name('privacy');
Route::get('/terms', function () { return view('terms'); })->name('terms');
Route::get('/travel-guide', function () { return view('travel-guide'); })->name('travel-guide');
Route::get('/travel-tips', function () { return view('travel-tips'); })->name('travel-tips');
Route::get('/testimonials', function () { return view('testimonials'); })->name('testimonials');
Route::get('/guides', function () { return view('guides'); })->name('guides');
Route::get('/packing-list', function () { return view('packing-list'); })->name('packing-list');
Route::get('/packing-list/download', function () {
    // For now, redirect to print view - PDF generation can be added later
    return redirect()->route('packing-list');
})->name('packing-list.download');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->middleware('auth')->name('booking.store');
Route::get('/booking/success', [BookingController::class, 'success'])->middleware('auth')->name('booking.success');
Route::get('/booking/status/{ref}', [BookingController::class, 'checkPaymentStatus'])->middleware('auth')->name('booking.status');
Route::get('/booking/availability', [BookingController::class, 'getAvailability'])->name('booking.availability');
Route::get('/booking/next-available', [BookingController::class, 'getNextAvailableDates'])->name('booking.next-available');
Route::get('/flight-booking', [BookingController::class, 'flightBooking'])->name('flight.booking');
Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
Route::post('/signin', [AuthController::class, 'signin']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // For ease of use

// Password Reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOTP'])->name('password.otp');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset.submit');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Gallery
    Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
    Route::post('/gallery/upload', [AdminController::class, 'uploadGalleryImage'])->name('gallery.upload');
    Route::post('/gallery/{image}/toggle', [AdminController::class, 'toggleGalleryStatus'])->name('gallery.toggle');
    Route::delete('/gallery/{image}', [AdminController::class, 'deleteGalleryImage'])->name('gallery.delete');
    
    // Team Members
    Route::get('/team-members', [AdminController::class, 'teamMembers'])->name('team-members');
    Route::get('/team-members/create', [AdminController::class, 'createTeamMember'])->name('team-members.create');
    Route::post('/team-members/store', [AdminController::class, 'storeTeamMember'])->name('team-members.store');
    Route::get('/team-members/{member}/edit', [AdminController::class, 'editTeamMember'])->name('team-members.edit');
    Route::put('/team-members/{member}/update', [AdminController::class, 'updateTeamMember'])->name('team-members.update');
    Route::delete('/team-members/{member}', [AdminController::class, 'deleteTeamMember'])->name('team-members.delete');
    
    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
    Route::get('/pages/{slug}/edit', [AdminController::class, 'editPageContent'])->name('pages.edit');
    Route::post('/pages/{slug}/update', [AdminController::class, 'updatePageContent'])->name('pages.update');
    
    // Packages
    Route::get('/packages', [AdminController::class, 'packages'])->name('packages');
    Route::post('/packages/store', [AdminController::class, 'storePackage'])->name('packages.store');
    Route::post('/packages/{package}/update', [AdminController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{package}', [AdminController::class, 'deletePackage'])->name('packages.delete');
    
    // Bookings
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{booking}/approve', [AdminController::class, 'approveBooking'])->name('bookings.approve');
    Route::delete('/bookings/{booking}', [AdminController::class, 'deleteBooking'])->name('bookings.delete');

    // Payment Settings
    Route::get('/payment-settings', [AdminController::class, 'paymentSettings'])->name('payment-settings');
    Route::post('/payment-settings', [AdminController::class, 'updatePaymentSettings'])->name('payment-settings.update');

    // Site Settings
    Route::get('/settings', [AdminController::class, 'siteSettings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSiteSettings'])->name('settings.update');

    // Newsletter
    Route::get('/newsletter', [AdminController::class, 'newsletter'])->name('newsletter');
    Route::delete('/newsletter/{subscriber}', [AdminController::class, 'deleteNewsletter'])->name('newsletter.delete');
    Route::post('/newsletter/send', [AdminController::class, 'sendAnnouncement'])->name('newsletter.send');

    // Hero Images
    Route::get('/hero-images', [AdminController::class, 'heroImages'])->name('hero-images');
    Route::post('/hero-images/upload', [AdminController::class, 'uploadHeroImage'])->name('hero-images.upload');
    Route::post('/hero-images/{image}/update', [AdminController::class, 'updateHeroImage'])->name('hero-images.update');
    Route::post('/hero-images/{image}/toggle', [AdminController::class, 'toggleHeroStatus'])->name('hero-images.toggle');
    Route::delete('/hero-images/{image}', [AdminController::class, 'deleteHeroImage'])->name('hero-images.delete');
    Route::post('/hero-images/reorder', [AdminController::class, 'reorderHeroImages'])->name('hero-images.reorder');
});
