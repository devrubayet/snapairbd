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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // Client who made the payment
            $table->foreignId('client_id')
                ->constrained('clients')
                ->restrictOnDelete();

            // Payment information
            $table->decimal('amount', 12, 2);

            $table->string('payment_method')->nullable();

            $table->string('transaction_id')->nullable();

            $table->string('reference')->nullable();

            $table->date('payment_date');

            $table->text('notes')->nullable();

            $table->timestamps();

            // Useful indexes
            $table->index('payment_date');
            $table->index('payment_method');
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
