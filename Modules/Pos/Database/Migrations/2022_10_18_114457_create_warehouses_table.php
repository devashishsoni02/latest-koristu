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
        
        if (!Schema::hasTable('warehouses'))
        {
                Schema::create('warehouses', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->text('address');
                    $table->string('city');
                    $table->string('city_zip');
                    $table->integer('workspace')->nullable();
                    $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('warehouses');
    }
};
