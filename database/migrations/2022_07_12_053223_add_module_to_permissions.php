<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModuleToPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('permissions')){
            if (!Schema::hasColumn('permissions', 'module')){
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('module')->after('guard_name')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('permissions')){
            if (Schema::hasColumn('permissions', 'module')){
                Schema::table('permissions', function (Blueprint $table) {
                    $table->dropColumn('module');
                });
            }
        }
    }
}
