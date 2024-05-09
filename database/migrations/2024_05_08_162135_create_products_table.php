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
            $table->string('name');
            $table->string('manufacturer');
            $table->string('price_unit');
            $table->integer('purchase_unit_quantity');
            $table->bigInteger('package_type_id')->unsigned();
            $table->bigInteger('purchase_package_type_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('package_type_id')->references('id')->on('package_types');
            $table->foreign('purchase_package_type_id')->references('id')->on('package_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (config('database.default') !== 'sqlite') {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['package_type_id']);
                $table->dropForeign(['purchase_package_type_id']);
            });
        }

        Schema::dropIfExists('products');        
    }
};
