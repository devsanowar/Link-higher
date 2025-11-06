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
        Schema::create('package_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('service_categories')
                ->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('slug');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->nullable();
            $table->enum('discount_type', ['percent', 'amount'])->nullable();
            $table->decimal('final_price', 10, 2)->default(0);
            $table->string('currency', 10)->default('USD');
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_plans');
    }
};
