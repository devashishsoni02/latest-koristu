<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('plan_fields'))
        {
            Schema::create('plan_fields', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('plan_id');
                $table->string('max_users', 100)->unique('plan_fields_total_users_unique');
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
        Schema::dropIfExists('plan_fields');
    }
}
