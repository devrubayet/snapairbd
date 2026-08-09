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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
             $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            // Visa type
            $table->foreignId('visa_type_id')
                ->constrained('visa_types')
                ->restrictOnDelete();

            // Visa status
            $table->foreignId('visa_status_id')
                ->constrained('visa_statuses')
                ->restrictOnDelete();

            // Visa information
            $table->string('country');
            $table->string('application_no')->nullable();

            $table->date('application_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table->text('notes')->nullable();

          
            // Useful indexes
            $table->index('application_no');
            $table->index('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visas');
    }
};
