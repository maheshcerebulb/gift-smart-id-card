<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Surrendersignaturecols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entity_applications', function (Blueprint $table) {
            //
            $table->string('surrender_reason')->nullable();
            $table->string('surrender_comment')->nullable();
            $table->string('surrender_signature')->nullable();
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
