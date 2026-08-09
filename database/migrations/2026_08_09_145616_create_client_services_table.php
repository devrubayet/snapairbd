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
        Schema::create('client_services', function (Blueprint $table) {
            $table->id();
             // Client
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            // Service
            $table->foreignId('service_id')
                ->constrained('services')
                ->restrictOnDelete();

            // Optional: service can be related to a specific visa
            $table->foreignId('visa_id')
                ->nullable()
                ->constrained('visas')
                ->nullOnDelete();

            // Actual price charged to this client
            $table->decimal('price', 12, 2);

            // Quantity
            $table->unsignedInteger('quantity')->default(1);

            // Date of service
            $table->date('service_date')->nullable();

            // Additional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Useful indexes
            $table->index(['client_id', 'service_id']);
            $table->index('visa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_services');
    }
};
