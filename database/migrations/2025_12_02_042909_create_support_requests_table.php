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
        Schema::create('support_requests', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->string('phone');
            // $table->string('email')->nullable();
            // $table->text('message');
            // $table->boolean('is_handled')->default(false);
            // $table->timestamps();

            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('service_type')->nullable(); // seo, link building, etc
            $table->string('website_url')->nullable();
            $table->string('budget_range')->nullable();
            $table->text('message');
            $table->boolean('is_handled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_requests');
    }
};
