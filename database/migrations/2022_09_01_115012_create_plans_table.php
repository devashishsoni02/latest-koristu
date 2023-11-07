<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('plans'))
        {
            Schema::create('plans', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->double('package_price_monthly')->default(0);
                $table->double('package_price_yearly')->default(0);
                $table->double('price_per_user_monthly')->default(0);
                $table->double('price_per_user_yearly')->default(0);
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
        Schema::dropIfExists('plans');
    }
}
