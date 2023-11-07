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
        if(!Schema::hasTable('sidebar_menu_dependencies'))
        {
            Schema::create('sidebar_menu_dependencies', function (Blueprint $table) {
                $table->id();
                $table->integer('sidebar_id');
                $table->string('module');
                $table->timestamps();

                $table->index('sidebar_id');
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
        Schema::dropIfExists('sidebar_menu_dependencies');
    }
};
