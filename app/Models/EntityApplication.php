<?php



namespace App\Models;



use Auth;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class EntityApplication extends Model

{

    use HasFactory;



    const ENTITY_APPLICATION_APPROVED                   = 200;

    const ENTITY_APPLICATION_DRAFT                      = 201;

    const ENTITY_APPLICATION_SUBMITTED                  = 202;

    const ENTITY_APPLICATION_REJECTED                   = 500;

    const ENTITY_APPLICATION_EXPIRED                    = 501;

    const ENTITY_APPLICATION_SUBMITTED_FOR_SURRENDER    = 401;

    const ENTITY_APPLICATION_DEACTIVATED                = 502;

    const ENTITY_APPLICATION_READY_TO_COLLECT           = 203;


    protected $fillable = [

        'first_name',

        'last_name',

        'designation',

        'gender',

        'email',

        'mobile_number',

        'application_number',

        'date_of_birth',

        'type',

        'expire_date',

        'application_type',

        'surrender_reason',

        'surrender_signature',

        'surrender_comment',

        'user_id',

        'status',

        'qrcode',

        'serial_no',

        'image',

        'signature',
        
        'dial_code',

        'country_code',

        'issue_date',

        'created_at',
		
		'department',
		
        'other_entity',
        
        'app_unique_id',

        'is_deleted'

    ];



    public function getFullNameAttribute()

    {

        // return "{$this->first_name} {$this->last_name}";

        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];

    }



    public function setFullnameAttribute($value)

    {

        $names = explode(' ', $value, 2);



        $this->attributes['first_name'] = $names[0];



        $this->attributes['last_name'] = isset($names[1]) ? $names[1] : null;

    }

    



    public static function getTableDataWithEntity()

    {
        if(Auth::user()->getRoleNames()->first() == 'Admin')
        {
            $recentEntityApplicationData = self::select('entity_applications.*',DB::raw("CONCAT(user.authorized_person_first_name,' ', user.authorized_person_last_name) AS entity_name"))

                            ->leftjoin('users as user','user.id','=','entity_applications.user_id')
                            ->whereNotIn('status', [201,202,205])
                            ->where('entity_applications.is_deleted','No')
                            ->latest()->take(5)->get();

            return $recentEntityApplicationData;
        }
        else
        {
            $recentEntityApplicationData = self::select('entity_applications.*',DB::raw("CONCAT(user.authorized_person_first_name,' ', user.authorized_person_last_name) AS entity_name"))

                                        ->leftjoin('users as user','user.id','=','entity_applications.user_id')
                                        ->whereNotIn('entity_applications.status', [201])
                                        ->where('entity_applications.is_deleted','No')
                                        ->latest()->take(5)->get();

            return $recentEntityApplicationData;
        }
        

    }

    public static function excelUploadedDataDateFormate($excelDate)
    {
        $date = ($excelDate - 25569) * 86400;

        // Format the Unix timestamp to Y-m-d
        return date('Y-m-d',$date);
    }

    public static function insertEntityApplicationData($data)
    {
      
        return self::insertGetId((array) $data);
    }

    public static function filterBaseCompanyData($filter){
        
        $buildingDataQuery = User::select('users.id', 'users.company_name', 'users.company_address', 'users.company_building')
            ->whereNotIn('company_name', ['cerebulb'])
            ->groupBy('users.id', 'users.company_name', 'users.company_address', 'users.company_building');

            // Apply filter if not '0'
            if ($filter != '0') {
                $buildingData = $buildingDataQuery->where('users.company_address', $filter)->get();
            } else {
                $buildingData = $buildingDataQuery->get();
            }

            // Process and sort unique company names
            $getFilterCompanyData = $buildingData
                ->sortBy('company_name')
                ->unique('company_name')
                ->pluck('company_name')
                ->toArray();
        
        return $getFilterCompanyData;
    }

}

