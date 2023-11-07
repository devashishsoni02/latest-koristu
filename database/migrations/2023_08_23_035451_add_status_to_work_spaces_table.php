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

            Schema::table('work_spaces', function (Blueprint $table) {
                if (!Schema::hasColumn('work_spaces', 'is_disable')) {
                    $table->integer('is_disable')->after('slug')->default(1);
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
        Schema::table('work_spaces', function (Blueprint $table) {
            //
        });
    }
};
