<?php
namespace App\Helpers;
use App\Mail\SendMailable;
use App\Models\LiqourApplication;
use App\Models\User;
use App\Models\EntityApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Log;

class Helper
{

    public static function getApplicationType($code)
    {
        // -- admin (200,500,501,203) show
        // -- sub admin (all) show
        $appType = "";
        if ($code == 200){
            $appType = "Approved";
        }
        elseif ($code == 201){
            $appType = "Draft";
        }
        elseif ($code == 202){
            $appType = "Submitted";
        }
        elseif ($code == 500){
            $appType = "Rejected"; // --
            
        }
        elseif ($code == 501){
            $appType = "Expired"; // --
        }
        elseif ($code == 401){
            $appType = "Surrendered";
        }
        elseif ($code == 502){
            $appType = "Deactivated";
        }
        elseif ($code == 203){
            $appType = "Activated"; // --
        }
        elseif ($code == 204){
            $appType = "Verified";
        }
        elseif ($code == 205){
            $appType = "Send Back";
        }
        elseif ($code == 206){
            $appType = "Hard copy submitted";
        }
        elseif ($code == 255){
            $appType = "Terminated";
        }elseif($code==403){
            $appType="Blocked";
        }
        else{
            $appType = "Undefined";
        }
        return $appType;
    }

    public static function getApplicationCode($appType)

    {

        $code = "";

        if ($appType == "Approved")
        {

            $code = 200;

        }
        elseif ($appType == "Draft")
        {

            $code = 201;

        }
        elseif ($appType == "Submited")
        {

            $code = 202;

        }
        elseif ($appType == "Rejected")
        {

            $code = 500;

        }
        elseif ($appType == "Expired")
        {

            $code = 501;

        }
        elseif ($appType == "Surrendered")
        {

            $code = 401;

        }
        elseif ($appType == "Deactivated")
        {

            $code = 502;

        }
        elseif ($appType == "Activated")
        {

            $code = 203;

        }
        elseif ($appType == "Verified")
        {

            $code = 204;

        }
        elseif ($appType == "Send Back")
        {

            $code = 205;

        }
        elseif ($appType == "Hard copy submitted")
        {

            $code = 206;

        }
        elseif ($appType == "Terminated")
        {

            $code = 255;

        }elseif($appType=="Blocked"){

            $code=403;

        }
        else
        {

            $code = "Undefined";

        }

        // dd($code);
        return $code;

    }

    public static function getEntityDetail($userId)
    {

        $userData = User::find($userId);

        return $userData;

    }

    public static function getApplicationCount()
    {

        $entityApplication = new EntityApplication();
        $entityApplication = $entityApplication->where('is_deleted','No');
        $role = Auth::user()->getRoleNames()
            ->first();

        if ($role === 'Entity')
        {

            $entityApplication = $entityApplication->where('user_id', Auth::id());

        } else {
            $entityApplication = $entityApplication->where('is_deleted', 'No');
        }

       // $totalCount = $entityApplication->count();

        $entityApplicationApproved = clone $entityApplication;

        $approvedCount = $entityApplicationApproved->where('is_deleted', 'No')->whereIn('status', [200, 203])
            ->count();

        $entityApplicationDraft = clone $entityApplication;

        $draftCount = $entityApplicationDraft->where('is_deleted', 'No')->where('status', 201)
            ->count();

        $entityApplicationVerified = clone $entityApplication;

        $verifiedCount = $entityApplicationVerified->where('is_deleted', 'No')->where('status', 204)
            ->count();

        $entityApplicationSubmitted = clone $entityApplication;

        $submittedCount = $entityApplicationSubmitted->where('is_deleted', 'No')->where('status', 202)
            ->count();

        $entityApplicationReadytoCollect = clone $entityApplication;

        $readytoCollectCount = $entityApplicationReadytoCollect->where('is_deleted', 'No')->where('status', 203)
            ->count();

        $entityApplicationSubmittedtoSurrender = clone $entityApplication;

        $submittedtoSurrenderCount = $entityApplicationSubmittedtoSurrender->where('is_deleted', 'No')->where('status', 401)
            ->count();

        $entityApplicationRejectedCount = clone $entityApplication;

        $rejectedCount = $entityApplicationRejectedCount->where('is_deleted', 'No')->where('status', 500)
            ->count();

        $entityApplicationExpiredCount = clone $entityApplication;

        $expiredCount = $entityApplicationExpiredCount->where('is_deleted', 'No')->where('status', 501)
            ->count();

        $entityApplicationDeactivated = clone $entityApplication;

        $deactivatedCount = $entityApplicationDeactivated->where('is_deleted', 'No')->where('status', 502)
            ->count();

        $entityApplicationSendback = clone $entityApplication;

        $sendbackCount = $entityApplicationSendback->where('is_deleted', 'No')->where('status', 205)
            ->count();

        $entityApplicationTerminated = clone $entityApplication;

        $terminatedCount = $entityApplicationTerminated->where('is_deleted', 'No')->where('status', 255)
            ->count();

        $entityApplicationSurrender = clone $entityApplication;

        $surrenderhardcopysubmittedCount = $entityApplicationSurrender->where('is_deleted', 'No')->whereIn('status', [401, 206])
            ->count();
            
        $totalCount = str_pad(($submittedCount + $verifiedCount + $sendbackCount + $approvedCount + $rejectedCount + $surrenderhardcopysubmittedCount + $terminatedCount), 2, '0', STR_PAD_LEFT); 

        $data = array(

            'totalCount' => str_pad($totalCount, 2, '0', STR_PAD_LEFT) ,

            'approvedCount' => str_pad($approvedCount, 2, '0', STR_PAD_LEFT) ,

            'draftCount' => str_pad($draftCount, 2, '0', STR_PAD_LEFT) ,

            'verifiedCount' => str_pad($verifiedCount, 2, '0', STR_PAD_LEFT) ,

            'submittedCount' => str_pad($submittedCount, 2, '0', STR_PAD_LEFT) ,

            'readytoCollectCount' => str_pad($readytoCollectCount, 2, '0', STR_PAD_LEFT) ,

            'submittedtoSurrenderCount' => str_pad($submittedtoSurrenderCount, 2, '0', STR_PAD_LEFT) ,

            'rejectedCount' => str_pad($rejectedCount, 2, '0', STR_PAD_LEFT) ,

            'expiredCount' => str_pad($expiredCount, 2, '0', STR_PAD_LEFT) ,

            'deactivatedCount' => str_pad($deactivatedCount, 2, '0', STR_PAD_LEFT) ,

            'draft' => str_pad($draftCount, 2, '0', STR_PAD_LEFT) ,

            'sendbackCount' => str_pad($sendbackCount, 2, '0', STR_PAD_LEFT) ,

            'terminatedCount' => str_pad($terminatedCount, 2, '0', STR_PAD_LEFT) ,

            'surrenderCount' => str_pad($surrenderhardcopysubmittedCount, 2, '0', STR_PAD_LEFT) ,

        );

        return $data;

    }

    public static function getApplicationStatusBackgroundColor($code)

    {

        $appType = "";

        if ($code == 200)
        {

            $appType = "background-light-cyon text-cyon";

        }
        elseif ($code == 201)
        {

            // $appType="Draft";
            $appType = "background-light-cyon text-cyon";

        }
        elseif ($code == 202)
        {

            // $appType="Submited";
            $appType = "background-light-purple text-purple";

        }
        elseif ($code == 500)
        {

            // $appType="Rejected";
            $appType = "background-light-red text-red";

        }
        elseif ($code == 501)
        {

            // $appType="Expired";
            $appType = "background-light-red text-red";

        }
        elseif ($code == 401)
        {

            // $appType="Surrendered";
            $appType = "background-light-red text-red";

        }
        elseif ($code == 502)
        {

            // $appType="Deactivated";
            $appType = "background-light-red text-red";

        }
        elseif ($code == 203)
        {

            // $appType="Activated";
            $appType = "background-light-cyon text-cyon";

        }
        elseif ($code == 204)
        {

            // $appType="Verified";
            $appType = "background-light-yellow text-white";

        }
        elseif ($code == 205)
        {

            // $appType="Send back";
            $appType = "background-light-sky-blue text-white ";

        }
        elseif ($code == 206)
        {

            // $appType="Hard copy submitted";
            $appType = "background-dark-red text-white ";

        }
        elseif ($code == 255)
        {

            // $appType="Terminated";
            $appType = "background-dark-black text-white ";

        }elseif($code==403){

            // $appType="Blocked";

            $appType="background-dark-black text-white ";

        }
        
        else
        {

            $appType = "Undefined";

        }

        // dd($appType);
        return $appType;

    }

    public static function getSuperAdminData()
    {

        $roleName = 'Entity';

        $totalUnit = User::whereHas('roles', function ($query) use ($roleName)
        {

            $query->where('name', $roleName);

        })->count();

        //$totalEmp = EntityApplication::count();
        //$totalEmp = EntityApplication::distinct('app_unique_id')->count();
        $totalEmp = EntityApplication::where('is_deleted', 'No')->count();

        $ActiveIds = EntityApplication::where('is_deleted', 'No')->whereIn('status', [200, 203])->count();

        $InactiveIds = EntityApplication::where('is_deleted', 'No')->whereIn('status', [255, 501, 502])->count();

        $data = array(

            'totalUnit' => str_pad($totalUnit, 2, '0', STR_PAD_LEFT) ,

            'totalEmp' => str_pad($totalEmp, 2, '0', STR_PAD_LEFT) ,

            'ActiveIds' => str_pad($ActiveIds, 2, '0', STR_PAD_LEFT) ,

            'InactiveIds' => str_pad($InactiveIds, 2, '0', STR_PAD_LEFT) ,

        );

        return $data;

    }

    public static function getUnitData($address)
    {

        $roleName = 'Entity';

        $entityData = User::whereHas('roles', function ($query) use ($roleName)
        {

            $query->where('name', $roleName);

        })->where('company_address', $address);

        $entities = $entityData->pluck('id');

        // dump($entities->toArray());
        

        $totalUnit = $entityData->count();

        $totalEmp = EntityApplication::where('is_deleted','No')->whereIn('user_id', $entities->toArray())
            ->count();

        $ActiveIds = EntityApplication::where('is_deleted','No')->whereBetween('status', [200, 210])
->whereIn('user_id', $entities->toArray())

            ->count();

        $InactiveIds = EntityApplication::where('is_deleted','No')->whereIn('status', [502, 501])->whereIn('user_id', $entities->toArray())
            ->count();

        $data = array(

            'totalUnit' => str_pad($totalUnit, 2, '0', STR_PAD_LEFT) ,

            'totalEmp' => str_pad($totalEmp, 2, '0', STR_PAD_LEFT) ,

            'ActiveIds' => str_pad($ActiveIds, 2, '0', STR_PAD_LEFT) ,

            'InactiveIds' => str_pad($InactiveIds, 2, '0', STR_PAD_LEFT) ,

        );

        return $data;

    }

    public static function getEntityApplicationType($applicationtype)

    {

        if ($applicationtype == 0)
        {

            return 'New';

        }
        elseif ($applicationtype == 1)
        {

            return 'Renew';

        }
        elseif ($applicationtype == 2)
        {

            return 'Surrender';

        }
        elseif ($applicationtype == 2)
        {

            return 'Surrender';

        }
        else
        {

            return '';

        }

    }

    public static function getDataEntryAdminData()
    {

        $roleName = 'Entity';

        $totalUnit = User::whereHas('roles', function ($query) use ($roleName)
        {

            $query->where('name', $roleName);

        })->count();

        $totalApplies = LiqourApplication::count();

        $currentDate = Carbon::now();

        // Get the start and end dates for the current week
        $startOfWeek = $currentDate->startOfWeek()
            ->format('Y-m-d H:i:s');

        $endOfWeek = $currentDate->endOfWeek()
            ->format('Y-m-d H:i:s');

        // Get the start and end dates for the current month
        $startOfMonth = $currentDate->startOfMonth()
            ->format('Y-m-d H:i:s');

        $endOfMonth = $currentDate->endOfMonth()
            ->format('Y-m-d H:i:s');

        // dd($startOfMonth);
        

        $endOfLastMonth = Carbon::now()->subMonths(1)
            ->endOfMonth();

        $startOfLastMonth = Carbon::now()->subMonths(2)
            ->startOfMonth();

        // Get the counts for each period
        

        //$monthlyCount = LiqourApplication::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $monthlyCount = LiqourApplication::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
            ->count();

        $lasttwomonthlyCount = LiqourApplication::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        $data = array(

            'totalApplies' => str_pad($totalApplies, 2, '0', STR_PAD_LEFT) ,

            'monthlyCount' => str_pad($monthlyCount, 2, '0', STR_PAD_LEFT) ,

            'lastTwoMonthCount' => str_pad($lasttwomonthlyCount, 2, '0', STR_PAD_LEFT) ,

        );

        return $data;

    }

    public static function getIsVerifiedCode($data)
    {
        $appType = "";

        if ($data == 'Verified')
        {

            $appType = 1;

        }
        else
        {

            $appType = 0;

        }

        // dd($appType);
        return $appType;

    }

    public static function statuChangeEmailCommonFunction($entityApplicationData)
    {

        /*if (!empty($entityApplicationData))
        {
            $emailData = array(
                'data' => $entityApplicationData,
                'mailType' => 'statusChangeEntityApplication'
            );

            $getEntityData = Helper::getEntityDetail($entityApplicationData->user_id);
            $entityMail = $getEntityData->email;
            Mail::to($entityMail)->send(new SendMailable($emailData));
        }*/
        
        if (!empty($entityApplicationData))
        {
           
            $getEntityData = Helper::getEntityDetail($entityApplicationData->user_id);
          
            $emailData['email']          =$getEntityData->email;
            $emailData['data']           =$entityApplicationData;
            $emailData['viewFile']       ='emails.entityapplicationstatuschange';
            $emailData['subject']        ='Card Management - Entity '.Helper::getApplicationType($entityApplicationData->status).' Application';
            $emailData['errorLogChannel']='entity-application-status';
            Helper::sendMail($emailData);
            
        }
    }
    
    public static function sendMail($emailData)
    {
        try {
            $emailData['signature'] = Config::get('constant.SIGNATURE');
            $emailData['emailNote'] = Config::get('constant.EMAIL_NOTE');

            Mail::to($emailData['email'])->send(new DefaultMail($emailData));
			//Mail::to(Config::get('constant.CC_ADMIN_EMAIL_ADDRESS'))->send(new DefaultMail($emailData));
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function expiredstatuChangeEmailCommonFunction($entityApplicationData)
    {
        //Log::channel('entity-application-status')->info("Helper expiredstatuChangeEmailCommonFunction called: " .date("Y-m-d H:i:s") ."");

        try {
            if ($entityApplicationData instanceof \Illuminate\Support\Collection)
            {
                foreach ($entityApplicationData as $application)
                {
                    if (!empty($application))
                    {
                        $getEntityData = Helper::getEntityDetail($application->user_id);
                      
                        $emailData['email']          =$getEntityData->email;
                        $emailData['data']           =$application;
                        if (date('Y-m-d',strtotime($application->expire_date)) == date('Y-m-d') || date('Y-m-d',strtotime($application->expire_date)) <= date('Y-m-d')){
                            $emailData['viewFile']       ='emails.entityapplicationstatuschange';
                        } else {
                            $emailData['viewFile']       ='emails.entityapplicationtwodaysearlyexpire';
                        }
                        $emailData['subject']        ='Card Management - Entity '.Helper::getApplicationType($application->status).' Application';
                        $emailData['errorLogChannel']='entity-application-status';
                        Helper::sendMail($emailData);
                        
                    }
                }
            }
            else
            {
                if (!empty($entityApplicationData))
                {
                    $getEntityData = Helper::getEntityDetail($entityApplicationData->user_id);
                    $emailData['email']          =$getEntityData->email;
                    $emailData['data']           =$entityApplicationData;
                    if (date('Y-m-d',strtotime($entityApplicationData->expire_date)) == date('Y-m-d') || date('Y-m-d',strtotime($entityApplicationData->expire_date)) <= date('Y-m-d')){
                        $emailData['viewFile']       ='emails.entityapplicationstatuschange';
                    } else {
                        $emailData['viewFile']       ='emails.entityapplicationtwodaysearlyexpire';
                    }
                    $emailData['viewFile']       ='emails.entityapplicationtwodaysearlyexpire';
                    $emailData['subject']        ='Card Management - Entity '.Helper::getApplicationType($entityApplicationData->status).' Application';
                    $emailData['errorLogChannel']='entity-application-status';
                    Helper::sendMail($emailData);
                }
            }
           
        } catch (\Throwable $th) {
           Log::channel('entity-application-status')->info("Time: " .date("Y-m-d H:i:s") ." (2.1.4) Email Data Failed : ");
            Log::channel('entity-application-status')->info("Time: " .date("Y-m-d H:i:s") ." (2.1.4) Email Data Failed Reason: "."\n".json_encode($th->getMessage()));
        }
        
    }

    public static function surrenderstatus($status)
    {
        $surrenderreason = '';
        if ($status == 1)
        {
            $surrenderreason = 'Employee left the organization';
            return $surrenderreason;
        }
        elseif ($status == 2)
        {
            $surrenderreason = 'Damaged Id Card';
            return $surrenderreason;
        }
        elseif ($status == 3)
        {
            $surrenderreason = 'Lost/ Stolen Id Card';
            return $surrenderreason;
        }
        elseif ($status == 5)
        {
        	$surrenderReason = 'Renew Id Card';
        }
        else
        {
            $surrenderreason = 'Other';
            return $surrenderreason;
        }
    }

    public static function bccExpiredstatuChangeEmailCommonFunction($entityApplicationData)
    {
      
        Log::channel('entity-application-status')->info("Helper expiredstatuChangeEmailCommonFunction called: " .date("Y-m-d H:i:s") ."");
      
        try {
           
            if ($entityApplicationData instanceof \Illuminate\Support\Collection)
            {
               
                foreach ($entityApplicationData as $application)
                {
                    
                    $mailData = array(
                        'data' => $application,
                        'mailType' => 'statusChangeEntityApplication',
                        // 'expireApplicationSubject' => 'Expiration'
                    );
                    
                    Log::channel('entity-application-status')->info("Time: " .date("Y-m-d H:i:s")." (2.1.3) Application Id :".$application->id." Email Send Start: ");
                    try {
                        
                        Mail::to('rushabh.patodia@yopmail.com')->bcc(config('constant.CC_ADMIN_EMAIL_ADDRESS'))->send(new SendMailable($mailData));
                        
                        Log::channel('entity-application-status')->info("Time: " . date("Y-m-d H:i:s") . " (2.1.5) Application Id : " . $application->id . " Email Sent Successfully: ");
                    } catch (\Exception $e) {
                        Log::channel('entity-application-status')->error("Time: " . date("Y-m-d H:i:s") . " (2.1.5) Application Id : " . $application->id . " Email Send Failed: " . $e->getMessage());
                    }
                    Log::channel('entity-application-status')->info("Time: " .date("Y-m-d H:i:s") ." (2.1.5) Application Id :".$application->id." Email Send Ends:");
                }
            }
            
           
        } catch (\Throwable $th) {
           Log::channel('entity-application-status')->info("Time: " .date("Y-m-d H:i:s") ." (2.1.4) Email Data Failed : ");
            Log::channel('entity-application-status')->info("Time: " .date("Y-m-d H:i:s") ." (2.1.4) Email Data Failed Reason: "."\n".json_encode($th->getMessage()));
        }
        
    }

}

