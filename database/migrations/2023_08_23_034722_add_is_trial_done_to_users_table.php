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

            Schema::table('users', function (Blueprint $table) {
                // if not exist, add the new column
                if (!Schema::hasColumn('users', 'is_disable')) {
                    $table->integer('is_disable')->after('is_enable_login')->default(1);
                }
                if (!Schema::hasColumn('users', 'trial_expire_date')) {
                    $table->string('trial_expire_date')->after('plan_expire_date')->nullable();
                }
                if (!Schema::hasColumn('users', 'is_trial_done')) {
                    $table->string('is_trial_done')->after('trial_expire_date')->default(0);
                }
                if (!Schema::hasColumn('users', 'total_workspace')) {
                    $table->string('total_workspace')->after('total_user')->default(-1);
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
