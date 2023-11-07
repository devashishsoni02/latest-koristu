<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('warehouse_products'))
        {
                Schema::create('warehouse_products', function (Blueprint $table) {
                    $table->id();
                    $table->integer('warehouse_id')->default(0);
                    $table->integer('product_id')->default(0);
                    $table->integer('quantity')->default('0');
                    $table->integer('workspace')->nullable();
                    $table->integer('created_by')->default('0');
                    $table->timestamps();
                });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_products');
    }
};
