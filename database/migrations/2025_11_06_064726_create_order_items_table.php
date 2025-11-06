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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('plan_id')->nullable()->constrained('package_plans')->nullOnDelete();

            $table->string('name'); // snapshot of plan_name
            $table->decimal('price', 14, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('line_total', 14, 2)->default(0);

            // store service info & category & image
            $table->json('meta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
