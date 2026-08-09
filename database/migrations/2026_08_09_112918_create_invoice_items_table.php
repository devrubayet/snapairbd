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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
             // Invoice
            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->cascadeOnDelete();

            // Service
            $table->foreignId('service_id')
                ->constrained('services')
                ->restrictOnDelete();

            // Related visa (optional)
            $table->foreignId('visa_id')
                ->nullable()
                ->constrained('visas')
                ->restrictOnDelete();

            // Item information
            $table->string('description')->nullable();

            $table->decimal('quantity', 10, 2)->default(1);
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->timestamps();

            // Useful indexes
            $table->index('invoice_id');
            $table->index('service_id');
            $table->index('visa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
