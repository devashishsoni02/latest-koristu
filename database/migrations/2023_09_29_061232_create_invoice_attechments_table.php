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
        if(!Schema::hasTable('invoice_attechments'))
        {
            Schema::create('invoice_attechments', function (Blueprint $table) {
                $table->id();
                $table->string('invoice_id');
                $table->string('file_name');
                $table->string('file_path');
                $table->string('file_size');
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
        Schema::dropIfExists('invoice_attechments');
    }
};
