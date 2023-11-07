<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sidebar'))
        {
            Schema::create('sidebar', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->nullable();
                $table->string('icon')->nullable();
                $table->integer('parent_id')->default(0);
                $table->integer('sort_order')->default('0');
                $table->string('route')->nullable();
                $table->integer('is_visible')->default(1);
                $table->string('permissions')->nullable();
                $table->string('module')->default('Base');
                $table->string('dependency')->nullable();
                $table->string('disable_module')->nullable();
                $table->string('type')->default('company');
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
        Schema::dropIfExists('sidebar');
    }
}
