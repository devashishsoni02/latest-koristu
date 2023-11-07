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

            Schema::table('proposal_products', function (Blueprint $table) {
                if (!Schema::hasColumn('proposal_products', 'product_type')) {
                    $table->string('product_type')->after('proposal_id')->nullable();
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
        Schema::table('proposal_products', function (Blueprint $table) {
            //
        });
    }
};
