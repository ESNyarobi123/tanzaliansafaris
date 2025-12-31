<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\SafariPackage;
use App\Models\PaymentSetting;
use App\Services\ZenoPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $packages = SafariPackage::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('booking', compact('packages'));
    }

    public function store(Request $request)
    {
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
}
