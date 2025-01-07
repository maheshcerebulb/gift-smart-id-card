<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class LiqourApplication extends Model

{

    use HasFactory;



    const LIQOUR_APPLICATION_APPROVED                   = 200;

    const LIQOUR_APPLICATION_DRAFT                      = 201;

    const LIQOUR_APPLICATION_SUBMITTED                  = 202;

    const LIQOUR_APPLICATION_REJECTED                   = 500;

    const LIQOUR_APPLICATION_EXPIRED                    = 501;

    const LIQOUR_APPLICATION_SUBMITTED_FOR_SURRENDER    = 401;

    const LIQOUR_APPLICATION_DEACTIVATED                = 502;

    const LIQOUR_APPLICATION_READY_TO_COLLECT           = 203;



    protected $fillable = [

        'first_name',

        'last_name',

        'designation',

        'mobile_number',

        'application_number',

        'expire_date',

        'company_name',

        'temporary_address',

        'permanent_address',

        'user_id',

        'status',

        'qrcode',

        'is_active',

        'dial_code',

        'country_code',

        'serial_number',

    ];



    public function getFullNameAttribute()

    {

        // return "{$this->first_name} {$this->last_name}";

        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];

    }



    public static function incrementLastSerialNumber()

    {

        // Retrieve the last serial number from the database

        $lastSerialNumber = static::max('serial_number');



        // Increment the last serial number by 1

        $nextSerialNumber = $lastSerialNumber + 1;



        // Save the incremented serial number back to the database

        static::create(['serial_number' => $nextSerialNumber]);

        

        return $nextSerialNumber;

    }

}

