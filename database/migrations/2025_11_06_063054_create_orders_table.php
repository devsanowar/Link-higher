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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // user who placed the order
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // unique order number
            $table->string('order_number')->unique();

            // billing info
            $table->string('billing_name');
            $table->string('billing_email')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_zip')->nullable();
            $table->text('billing_address')->nullable();

            // totals
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);

            // payment info
            $table->string('payment_method')->default('cod'); // cod, paddle, stripe, etc.
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled

            // extra notes
            $table->text('notes')->nullable();

            // meta for future use (payment_gateway_data, etc.)
            $table->json('meta')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
