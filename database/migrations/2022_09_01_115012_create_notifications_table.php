<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('notifications'))
        {
            Schema::create('notifications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('module')->nullable();
                $table->string('type', 188)->nullable();
                $table->string('action')->nullable();
                $table->string('status')->nullable();
                $table->string('permissions')->nullable();
                $table->integer('workspace_id')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
