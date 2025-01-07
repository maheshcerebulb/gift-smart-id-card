<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcolentiryapp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity_applications', function (Blueprint $table) {
            $table->integer('application_type')->default('0')->comment('0:New,1:Renew,2:Surrender')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entity_applications', function (Blueprint $table) {
            //
        });
    }
}
