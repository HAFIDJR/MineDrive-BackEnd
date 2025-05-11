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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driver_id')->nullable()->constrained('users');
            $table->foreignId('approver_level1_id')->nullable()->constrained('users');
            $table->foreignId('approver_level2_id')->nullable()->constrained('users');
            $table->enum('status_level1', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status_level2', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->text('purpose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
