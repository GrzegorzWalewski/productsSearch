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
        Schema::table('variants', function (Blueprint $table) {
            $table->float('weight')->nullable()->change();
            $table->float('diameter')->nullable()->change();
            $table->bigInteger('length')->nullable()->change();
            $table->bigInteger('width')->nullable()->change();
            $table->bigInteger('height')->nullable()->change();
            $table->bigInteger('thickness')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->float('weight')->nullable(false)->change();
            $table->float('diameter')->nullable(false)->change();
            $table->bigInteger('length')->nullable(false)->change();
            $table->bigInteger('width')->nullable(false)->change();
            $table->bigInteger('height')->nullable(false)->change();
            $table->bigInteger('thickness')->nullable(false)->change();
        });
    }
};
