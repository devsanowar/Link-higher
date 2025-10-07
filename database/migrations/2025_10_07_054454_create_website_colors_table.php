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
        Schema::create('website_colors', function (Blueprint $table) {
            $table->id();

            // 🔹 Core Theme Colors
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('heading_color')->nullable();
            $table->string('link_color')->nullable();
            $table->string('link_hover_color')->nullable();
            $table->string('dark_color')->default('#000000');
            $table->string('light_color')->default('#FFFFFF');
            $table->string('button_background_color')->nullable();
            $table->string('button_hover_color')->nullable();
            $table->string('button_text_color')->nullable();


            // 🔹 Header & Footer Specific
            $table->string('header_background_color')->nullable();
            $table->string('header_text_color')->nullable();
            $table->string('footer_background_color')->nullable();
            $table->string('footer_text_color')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_colors');
    }
};
