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
        Schema::table('posts', function (Blueprint $table) {
            // Add user_id foreign key after id
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->nullOnDelete(); // Same as onDelete('set null') but cleaner in Laravel 12

            // Add views and likes counters after featured_image
            $table->unsignedBigInteger('views')
                ->default(0)
                ->after('featured_image');

            $table->unsignedBigInteger('likes')
                ->default(0)
                ->after('views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);

            // Drop columns
            $table->dropColumn(['user_id', 'views', 'likes']);
        });
    }
};
