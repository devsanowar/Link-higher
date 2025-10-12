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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('case_study_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('client_name')->nullable();
            $table->longText('description');
            $table->longText('overview_challenge')->nullable();
            $table->longText('project_summary')->nullable();
            $table->longText('solution_result')->nullable();
            $table->longText('features');
            $table->string('website_url')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('image')->nullable();
            $table->longText('images')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
