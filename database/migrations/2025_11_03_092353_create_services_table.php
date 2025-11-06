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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')
                ->nullable()
                ->constrained('service_categories')
                ->nullOnDelete();

            $table->string('service_title');
            $table->string('service_slug');
            $table->text('service_short_description')->nullable();
            $table->longText('service_long_description')->nullable();
            $table->longText('service_features');
            $table->string('image');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
