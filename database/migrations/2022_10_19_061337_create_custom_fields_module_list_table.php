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
        if(!Schema::hasTable('custom_fields_module_list'))
        {
            Schema::create('custom_fields_module_list', function (Blueprint $table) {
                $table->id();
                $table->string('module')->nullable();
                $table->string('sub_module')->nullable();
                $table->string('status')->default('active');
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
        Schema::dropIfExists('custom_fields_module_list');
    }
};
