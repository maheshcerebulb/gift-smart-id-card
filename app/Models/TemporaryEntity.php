<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Storage;

//use App\Utilities\MediaHelper;



class TemporaryEntity extends Model

{

    /**

     * @var array

     */

    protected $fillable = [

        'name',

        'email',

        'unit_category',

        'company_name',

        'constitution_of_business',

        'other_constitution_of_business',

        'registration_number',

        'request_id',

		'company_address',

        'company_city',

        'company_state',

        'company_country',

        'company_pin_code',

        'pan_number',

        'authorized_person_first_name',

        'authorized_person_last_name',

        'authorized_person_gender',

        'authorized_person_mobile_number',

        'authorized_person_designation',

        'authorized_person_mobile_number_2',

        'authorized_person_signature',

        'authorized_person_support_document',

        'dial_code',

        'country_code',

        'dial_code_2',

        'country_code_2',

    ];

}

