<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\SafariPackage;
use App\Models\PaymentSetting;
use App\Models\Availability;
use App\Services\ZenoPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        // Check if user is authenticated - show message but allow viewing packages
        $requiresLogin = !Auth::check();
        
        $packages = SafariPackage::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('booking', compact('packages', 'requiresLogin'));
    }

    public function store(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('signin')
                ->with('error', 'Please sign in to book a package.')
                ->with('redirect_after_login', route('booking'));
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:50',
            'country' => 'required|string|max:100',
            'safari_package' => 'required|exists:safari_packages,id',
            'accommodation' => 'required|string|max:150',
            'start_date' => 'required|date|after_or_equal:today',
            'nights' => 'required|integer|min:1',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'payment_method' => 'required|string|max:50',
            'payment_details' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $booking_ref = "TZ-" . strtoupper(Str::random(8));

        $booking = Booking::create([
            'reference' => $booking_ref,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => $validated['country'],
            'package_id' => $validated['safari_package'],
            'accommodation' => $validated['accommodation'],
            'start_date' => $validated['start_date'],
            'nights' => $validated['nights'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'payment_method' => $validated['payment_method'],
            'payment_data' => $validated['payment_details'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        if ($validated['payment_method'] === 'mpesa' && PaymentSetting::get('zenopay_enabled') == '1') {
            $zeno = new ZenoPayService();
            $result = $zeno->initiatePayment([
                'order_id' => $booking_ref,
                'buyer_email' => $validated['email'],
                'buyer_name' => $validated['full_name'],
                'buyer_phone' => $validated['phone'],
                'amount' => 1000, // For testing, or convert package price to TZS
            ]);

            if (isset($result['status']) && $result['status'] === 'success') {
                return redirect()->route('booking.success', ['ref' => $booking_ref, 'pay' => 'zeno']);
            }
        }

        return redirect()->route('booking.success', ['ref' => $booking_ref]);
    }

    public function checkPaymentStatus($ref)
    {
        $zeno = new ZenoPayService();
        $status = $zeno->checkStatus($ref);
        return response()->json($status);
    }

    public function success(Request $request)
    {
        $ref = $request->query('ref');
        return view('booking-success', compact('ref'));
    }

    public function flightBooking()
    {
        return view('flight-booking-coming-soon');
    }

    /**
     * Get availability for a package (AJAX endpoint)
     */
    public function getAvailability(Request $request)
    {
        $packageId = $request->input('package_id');
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Get or generate availability for the month
        $availabilities = Availability::forPackage($packageId)
            ->forDateRange($startDate, $endDate)
            ->get()
            ->keyBy(function ($item) {
                return $item->date->format('Y-m-d');
            });

        // Generate default availability for dates not in database
        $calendar = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dateKey = $currentDate->format('Y-m-d');
            
            if ($availabilities->has($dateKey)) {
                $availability = $availabilities[$dateKey];
            } else {
                // Create default availability
                $availability = new Availability([
                    'package_id' => $packageId,
                    'date' => $currentDate->copy(),
                    'status' => 'available',
                    'spots_total' => 6,
                    'spots_booked' => 0,
                    'spots_remaining' => 6,
                ]);
            }

            $calendar[] = [
                'date' => $dateKey,
                'day' => $currentDate->day,
                'status' => $availability->status,
                'status_label' => $availability->status_label,
                'status_color' => $availability->status_color,
                'spots_remaining' => $availability->spots_remaining,
                'is_available' => $availability->is_available,
                'is_past' => $currentDate->isPast(),
            ];

            $currentDate->addDay();
        }

        return response()->json([
            'success' => true,
            'month' => $month,
            'year' => $year,
            'month_name' => $startDate->format('F Y'),
            'calendar' => $calendar,
        ]);
    }

    /**
     * Get next available dates for a package
     */
    public function getNextAvailableDates(Request $request)
    {
        $packageId = $request->input('package_id');
        $limit = $request->input('limit', 5);

        $availabilities = Availability::forPackage($packageId)
            ->available()
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'dates' => $availabilities->map(function ($avail) {
                return [
                    'date' => $avail->date->format('Y-m-d'),
                    'formatted' => $avail->date->format('M d, Y'),
                    'day_name' => $avail->date->format('l'),
                    'spots_remaining' => $avail->spots_remaining,
                    'status' => $avail->status,
                ];
            }),
        ]);
    }
}
