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

            // Card meta
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable(); 
            $table->boolean('is_free')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->unsignedSmallInteger('position')->default(1);

            // CTA
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();

            // Trust badges
            $table->unsignedTinyInteger('trial_days')->default(0);
            $table->unsignedTinyInteger('money_back_days')->default(0);

            // --- PRICES (single table fields) ---
            $table->char('currency', 3)->default('USD');
            $table->decimal('monthly_amount', 10, 2)->default(0);
            $table->decimal('yearly_amount', 10, 2)->default(0);

            // UI labels (চাইলে বদলাতে পারবেন)
            $table->string('monthly_label')->default('mo');
            $table->string('yearly_label')->default('yr');

            // Yearly savings ribbon (optional)
            $table->unsignedTinyInteger('yearly_save_percent')->nullable();
            $table->string('yearly_save_text')->nullable();

            $table->json('features')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
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
