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
        Schema::table('plans', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('plans', 'modules')) {
                $table->longtext('modules')->after('price_per_user_yearly')->nullable();
            }
            if (!Schema::hasColumn('plans', 'name')) {
                $table->string('name')->after('id')->nullable();
            }
            if (!Schema::hasColumn('plans', 'number_of_user')) {
                $table->string('number_of_user')->after('price_per_user_yearly')->nullable();
            }
            if (!Schema::hasColumn('plans', 'custom_plan')) {
                $table->integer('custom_plan')->after('price_per_user_yearly')->default(0);
            }
            if (!Schema::hasColumn('plans', 'active')) {
                $table->integer('active')->after('price_per_user_yearly')->default(1);
            }
            if (!Schema::hasColumn('plans', 'is_free_plan')) {
                $table->integer('is_free_plan')->after('price_per_user_yearly')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
};
