<?php



namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable

{

    use HasRoles, HasApiTokens, HasFactory, Notifiable;



        const STATUS_ACTIVE = 'Yes';

    const STATUS_INACTIVE = 'No';



    const LIST_STATUS = [

        self::STATUS_ACTIVE => self::STATUS_ACTIVE,

        self::STATUS_INACTIVE => self::STATUS_INACTIVE,

    ];



    /**

     * The attributes that are mass assignable.

     *

     * @var array<int, string>

     */

    protected $fillable = [

        'name',

        'email',

        'password',

        'unit_category',

        'company_name',

        'constitution_of_business',

        'company_registration_number',

        'request_number',

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

        'application_number',

        'first_time_login',

        'is_active',

        'is_deleted',
        
        'dial_code',

        'country_code',

        'dial_code_2',

        'country_code_2',

    ];



    /**

     * The attributes that should be hidden for serialization.

     *

     * @var array<int, string>

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast.

     *

     * @var array<string, string>

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];



    public static $rules = [

        'name' => 'required',

        'email' => 'required|email|unique:users',

        'password' => 'required|min:6|confirmed',

        'is_active' => 'required',

    ];



    public function getFullNameAttribute()

    {

        return "{$this->authorized_person_first_name} {$this->authorized_person_last_name}";

    }



    public function getFieldNameAttribute($value)

    {

        return strtoupper($value);

    }



    public function setFieldNameAttribute($value)

    {

        $this->attributes['field_name'] = strtolower($value);

    }

}

