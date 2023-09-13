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
        Schema::table('categories', function (Blueprint $table) {
            // $table->change('parent_id', 'integer')->nullable()->default(0);
            // $table->integer('parent_id')->default(0)->change();
            $table->integer('parent_id')->nullable(false)->default(0)->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // $table->change('parent_id', 'integer')->nullable()->default(null);
            // $table->integer('parent_id')->nullable()->default(null)->change();
            $table->integer('parent_id')->nullable(true)->default(null)->change();
            
        });
    }
};
