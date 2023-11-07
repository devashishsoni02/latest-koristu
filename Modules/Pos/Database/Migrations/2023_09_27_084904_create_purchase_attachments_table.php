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
        if(!Schema::hasTable('purchase_attachments'))
        {
            Schema::create('purchase_attachments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('purchase_id');
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
        Schema::dropIfExists('purchase_attachments');
    }
};
