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
        Schema::create('payment_allocations', function (Blueprint $table) {
            $table->id();
            // Payment
            $table->foreignId('payment_id')
                ->constrained('payments')
                ->cascadeOnDelete();

            // Invoice
            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->restrictOnDelete();

            // Specific invoice item
            $table->foreignId('invoice_item_id')
                ->nullable()
                ->constrained('invoice_items')
                ->restrictOnDelete();

            // Amount allocated from this payment
            $table->decimal('amount', 12, 2);

            $table->timestamps();

            // Useful indexes
            $table->index('payment_id');
            $table->index('invoice_id');
            $table->index('invoice_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_allocations');
    }
};
