<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users'))
        {
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('email');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->string('type')->default('company');
                $table->boolean('active_status')->default(false);
                $table->integer('active_workspace')->default(0);
                $table->string('avatar')->default('uploads/users-avatar/avatar.png');
                $table->integer('requested_plan')->default(0);
                $table->boolean('dark_mode')->default(false);
                $table->string('lang', 191)->default('en');
                $table->string('messenger_color')->default('#2180f3');
                $table->integer('workspace_id')->default(0);
                $table->integer('active_plan')->default(0);
                $table->longText('active_module')->nullable();
                $table->date('plan_expire_date')->nullable();
                $table->string('billing_type')->nullable();
                $table->integer('total_user')->default(0);
                $table->integer('seeder_run')->default(0);
                $table->integer('is_enable_login')->default(1);
                $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('users');
    }
}
