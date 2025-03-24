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
        Schema::table('reviews', function (Blueprint $table) {
            Schema::rename('reviews', 'comments');

            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('rating');
                $table->text('comment')->nullable(false)->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            Schema::rename('comments', 'reviews');

            Schema::table('reviews', function (Blueprint $table) {
                $table->integer('rating')->nullable();
                $table->text('comment')->nullable()->change();
            });
        });
    }
};
