<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_applications', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->nullable();
            $table->integer('application_number')->nullable();
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('image')->nullable();
            $table->string('authorized_signatory')->nullable();
            
            $table->integer('status')->nullable();
            $table->string('type')->nullable();
            $table->date('expire_date')->nullable();
            $table->text('comment')->nullable();
            $table->string('is_verified')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_applications');
    }
}
