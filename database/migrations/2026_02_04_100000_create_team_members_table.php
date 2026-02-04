<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('team_members')) {
            Schema::create('team_members', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('position');
                $table->string('role')->nullable();
                $table->integer('experience_years')->default(0);
                $table->text('bio')->nullable();
                $table->string('image_path')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->json('specialties')->nullable();
                $table->json('languages')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
