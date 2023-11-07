<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('languages'))
        {
            Schema::create('languages', function (Blueprint $table) {
                $table->id();
                $table->string('code');
                $table->string('name');
                $table->string('status')->default(1);
                $table->timestamps();
            });

            // Call the seeder
            Artisan::call('db:seed', [
                '--class' => 'LanguageTableSeeder',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
