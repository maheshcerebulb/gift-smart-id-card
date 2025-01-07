<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Updateusertable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('unit_category')->nullable();
            $table->string('company_name')->nullable();
            $table->string('constitution_of_business')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('request_number')->nullable();
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

            $table->string('application_number')->nullable();
            $table->string('is_active')->default('N');
            $table->string('is_deleted')->default('N');
            $table->string('first_time_login')->default('Y');

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
}
