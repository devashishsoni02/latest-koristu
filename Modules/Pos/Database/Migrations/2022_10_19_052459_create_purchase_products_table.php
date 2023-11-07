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
        if (!Schema::hasTable('purchase_products'))
        {
            Schema::create('purchase_products', function (Blueprint $table) {
                $table->id();
                $table->integer('purchase_id');
                $table->integer('product_id');
                $table->integer('quantity');
                $table->string('tax', '50')->nullable();
                $table->float('discount')->default('0.00');
                $table->float('price')->default('0.00');
                $table->text('description')->nullable();
                $table->integer('workspace')->nullable();
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
        Schema::dropIfExists('purchase_products');
    }
};
