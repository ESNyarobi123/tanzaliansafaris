<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('safari_packages')) {
            Schema::create('safari_packages', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('badge_label', 50)->nullable();
                $table->string('duration_label', 50)->nullable();
                $table->text('short_description')->nullable();
                $table->text('features_text')->nullable();
                $table->decimal('price_amount', 10, 2);
                $table->string('price_suffix', 50)->nullable();
                $table->string('image_path')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->integer('sort_order')->default(0);
                // Schema specifies $timestamps = false in model, but good to check if needed.
                // $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safari_packages');
    }
};
