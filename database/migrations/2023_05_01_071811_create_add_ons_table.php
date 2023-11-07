<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('add_ons'))
        {
            Schema::create('add_ons', function (Blueprint $table) {
                $table->id();
                $table->string('module')->nullable();
                $table->string('name')->nullable();
                $table->string('monthly_price')->nullable();
                $table->string('yearly_price')->nullable();
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
        Schema::dropIfExists('add_ons');
    }
};
