<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stages'))
        {
            Schema::create('stages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('color')->default('#051c4b');
                $table->boolean('complete');
                $table->unsignedBigInteger('workspace_id');
                $table->integer('order');
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
        Schema::dropIfExists('stages');
    }
}
