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
                if (!Schema::hasColumn('plans', 'price_per_workspace_monthly')) {
                    $table->integer('price_per_workspace_monthly')->after('price_per_user_yearly')->default(0);
                }
                if (!Schema::hasColumn('plans', 'price_per_workspace_yearly')) {
                    $table->integer('price_per_workspace_yearly')->after('price_per_workspace_monthly')->default(0);
                }
                if (!Schema::hasColumn('plans', 'trial')) {
                    $table->integer('trial')->after('name')->default(0);
                }
                if (!Schema::hasColumn('plans', 'trial_days')) {
                    $table->string('trial_days')->after('trial')->nullable();
                }
                if (!Schema::hasColumn('plans', 'number_of_workspace')) {
                    $table->string('number_of_workspace')->after('number_of_user')->nullable();
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
