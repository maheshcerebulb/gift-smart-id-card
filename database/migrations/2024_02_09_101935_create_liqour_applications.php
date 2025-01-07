<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiqourApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liqour_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(); 
            $table->integer('application_number')->nullable();
            $table->integer('serial_number')->nullable(); 
            $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable(); 
            $table->string('company_name')->nullable(); 
            $table->string('designation')->nullable(); 
            $table->string('mobile_number')->nullable();
            $table->string('image')->nullable();  
            $table->string('authorized_person')->nullable(); 
            $table->text('temporary_address')->nullable(); 
            $table->text('permanent_address')->nullable();
            $table->string('authorized_signatory')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('issue_date')->nullable();   
            $table->date('expire_date')->nullable();
            $table->integer('scan_count')->nullable();
            $table->integer('status')->nullable();

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
        Schema::dropIfExists('liqour_applications');
    }
}
