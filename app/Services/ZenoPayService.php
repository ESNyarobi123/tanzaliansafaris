<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\PaymentSetting;

class ZenoPayService
{
    protected $apiKey;
    protected $baseUrl = 'https://zenoapi.com/api/payments';

    public function __construct()
    {
        $this->apiKey = PaymentSetting::get('zenopay_api_key');
    }

    public function initiatePayment($data)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/mobile_money_tanzania', [
            'order_id' => $data['order_id'],
            'buyer_email' => $data['buyer_email'],
            'buyer_name' => $data['buyer_name'],
            'buyer_phone' => $data['buyer_phone'],
            'amount' => $data['amount'],
        ]);

        return $response->json();
    }

    public function checkStatus($orderId)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get($this->baseUrl . '/order-status', [
            'order_id' => $orderId,
        ]);

        return $response->json();
    }
}
