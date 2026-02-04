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
        if (!Schema::hasTable('availabilities')) {
            Schema::create('availabilities', function (Blueprint $table) {
                $table->id();
                $table->foreignId('package_id')->constrained('safari_packages')->onDelete('cascade');
                $table->date('date');
                $table->enum('status', ['available', 'booked', 'limited', 'unavailable'])->default('available');
                $table->integer('spots_total')->default(6);
                $table->integer('spots_booked')->default(0);
                $table->integer('spots_remaining')->default(6);
                $table->text('notes')->nullable();
                $table->timestamps();

                // Index for faster queries
                $table->index(['package_id', 'date']);
                $table->index('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
