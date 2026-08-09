<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
             // Basic information
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Personal information
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();

            // Passport information
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry')->nullable();

            // Address
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // Emergency contact
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();

            // Additional information
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
