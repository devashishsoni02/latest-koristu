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
        if(!Schema::hasTable('deal_calls'))
        {
            Schema::create('deal_calls', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('deal_id');
                $table->string('subject');
                $table->string('call_type', 30);
                $table->string('duration', 20);
                $table->integer('user_id');
                $table->text('description')->nullable();
                $table->text('call_result')->nullable();
                $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
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
        Schema::dropIfExists('deal_calls');
    }
};
