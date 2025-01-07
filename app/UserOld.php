<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const STATUS_ACTIVE = 'Yes';
    const STATUS_INACTIVE = 'No';

    const LIST_STATUS = [
        self::STATUS_ACTIVE => self::STATUS_ACTIVE,
        self::STATUS_INACTIVE => self::STATUS_INACTIVE,
    ];

    const ROLE_SUPER_ADMIN_ID   = 1;
    const ROLE_ADMIN_ID         = 2;
    const ROLE_COMPANY_ID       = 3;

    const ROLE_SUPER_ADMIN = 'Super Admin';
    const ROLE_ADMIN = 'Admin';
    const ROLE_COMPANY = 'Entity';

    const LIST_ROLE = [
        self::ROLE_SUPER_ADMIN_ID   => self::ROLE_SUPER_ADMIN,
        self::ROLE_ADMIN_ID         => self::ROLE_ADMIN,
        self::ROLE_COMPANY_ID       => self::ROLE_COMPANY,
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'group_id',
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
        'is_deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'group_id' => 'required',
        'is_active' => 'required',
    ];

    public static $messages = [
        'group_id.required' => 'Please select group',
        'is_active.required' => 'Please select status'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->authorized_person_first_name} {$this->authorized_person_last_name}";
    }

}
