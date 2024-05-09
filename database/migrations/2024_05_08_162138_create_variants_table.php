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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->float('weight')->comment('in kg');
            $table->float('diameter')->comment('in mm');
            $table->bigInteger('length')->unsigned()->comment('in mm');
            $table->bigInteger('width')->unsigned()->comment('in mm');
            $table->bigInteger('height')->unsigned()->comment('in mm');
            $table->bigInteger('thickness')->unsigned()->comment('in mm');
            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('variants', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('variants');
    }
};
