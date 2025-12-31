<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, boolean
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Seed some default keys
        $defaults = [
            ['key' => 'zenopay_api_key', 'value' => '', 'type' => 'text', 'group' => 'zenopay'],
            ['key' => 'zenopay_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'zenopay'],
            
            ['key' => 'usdt_address', 'value' => '', 'type' => 'text', 'group' => 'usdt'],
            ['key' => 'usdt_qr_code', 'value' => '', 'type' => 'image', 'group' => 'usdt'],
            ['key' => 'usdt_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'usdt'],
            
            ['key' => 'bank_details', 'value' => '', 'type' => 'textarea', 'group' => 'bank'],
            ['key' => 'bank_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'bank'],
            
            ['key' => 'paypal_email', 'value' => '', 'type' => 'text', 'group' => 'paypal'],
            ['key' => 'paypal_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'paypal'],
            
            ['key' => 'stripe_key', 'value' => '', 'type' => 'text', 'group' => 'card'],
            ['key' => 'stripe_secret', 'value' => '', 'type' => 'text', 'group' => 'card'],
            ['key' => 'card_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'card'],
        ];

        foreach ($defaults as $default) {
            \DB::table('payment_settings')->insert($default);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
