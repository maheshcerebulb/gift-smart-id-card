<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_entities', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('unit_category')->nullable();
            $table->string('company_name')->nullable();
            $table->string('constitution_of_business')->nullable();
            $table->string('other_constitution_of_business')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('request_id')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_pin_code')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('authorized_person_first_name')->nullable();
            $table->string('authorized_person_last_name')->nullable();
            $table->string('authorized_person_gender')->nullable();
            $table->string('authorized_person_mobile_number')->nullable();
            $table->string('authorized_person_designation')->nullable();
            $table->string('authorized_person_mobile_number_2')->nullable();
            $table->string('authorized_person_signature')->nullable();
            $table->string('authorized_person_support_document')->nullable();

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
        Schema::dropIfExists('temporary_entities');
    }
}
