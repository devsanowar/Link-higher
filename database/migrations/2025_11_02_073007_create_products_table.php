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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->onDelete('set null');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('website_url')->nullable();
            $table->integer('ahrefs_dr')->nullable();
            $table->integer('moz_da')->nullable();
            $table->integer('moz_pa')->nullable();
            $table->integer('traffic')->nullable();
            $table->string('target_country')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->longText('product_description')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->tinyInteger('news')->default(0)->comment('1=yes,0=no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
