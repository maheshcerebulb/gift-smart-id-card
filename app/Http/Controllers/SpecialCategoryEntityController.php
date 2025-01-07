<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Group;
use App\Models\User;
use App\Models\EntityApplication;
use App\Models\Company;
use App\Mail\SendMailable;
use GuzzleHttp\Client;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;
use App\Models\Department;
use App\Http\Controllers\EntityController;

class SpecialCategoryEntityController extends EntityController
{
    public function __construct()
    {
        $this->user = new User();
        $this->group = new Group();
        $this->entityapplication = new EntityApplication();
    }
    public function specialCategoryEntityFormHtml()
    {
		
			if (Auth::user()->unit_category == 'Other') {
            		$departments = Department::get();
            		return view('specialentity.create-new-application',compact('departments'))->with([]);
        	}
        	else
        	{
           	 	return redirect('login');
        	}

    }

    public function saveSpecialEntityApplicationDetail(Request $request)
    {
        //dd($request->all());
        try {
            $input = $request->all();
            foreach ($input as $key => $value) {
                // Check if the key is not 'image' or 'image_hidden'
                if ($key !== 'special_image_hidden' && $key !== 'previous_special_image_hidden' && $key !== 'special_signature_hidden' && $key !== 'previous_special_signature_hidden' && $key !== 'type' &&  $key !== 'gender' && $key !== 'draft_status' ) {
                    // Convert the value to uppercase
                    $input[$key] = strtoupper($value);
                }
            }
            $latestSerialNumber = $this->entityapplication->where('type', $input['type'])
                            ->orderByRaw('CAST(serial_no AS UNSIGNED) DESC')
                            ->first();
            // dd($latestSerialNumber);
            $currentSerialNumber = $this->entityapplication->where('id', $input['id'])
                            ->first();
            
            if(!empty($input['id']))
            {
                $input['special_serial_no']= $currentSerialNumber->special_serial_no;
                $input['issue_date'] = date('Y-m-d');
            }
            else
            {
                
                $input['issue_date'] = date('Y-m-d');
            }

            if ($request->has('application_department')) {
                $input['department'] = $input['application_department'];
                $input['department'] = $input['application_department'];
                unset($input['application_department']);
            }
            
            
            $input['date_of_birth'] = date('Y-m-d',strtotime($input['date_of_birth']));
            $file       = $input['special_image_hidden'];
            $fileDir    = config('constant.ENTITY_APPLICATION_IMAGE_PATH');
            $filePath   = public_path('upload').DIRECTORY_SEPARATOR.$fileDir;
            $base64Data = substr($file, strpos($file, ',') + 1);
            $binaryData = base64_decode($base64Data);


            $signaturefile       = $input['special_signature_hidden'];
            $signaturefileDir    = config('constant.ENTITY_APPLICATION_IMAGE_PATH');
            $signaturefilePath   = public_path('upload').DIRECTORY_SEPARATOR.$signaturefileDir;
            $signaturebase64Data = substr($signaturefile, strpos($signaturefile, ',') + 1);
            $signaturebinaryData = base64_decode($signaturebase64Data);
            File::makeDirectory($filePath, $mode = 0777, true, true);

            $entityApplicationDetail    = $this->entityapplication->find($request->id);

            if($request->id > 0){
                $entityApplicationEmailCheck = $this->commonCheckEntityApplicationDataExists($request);
                if (!empty($entityApplicationEmailCheck)) {
                    $error_message[] = 'Application is already registered with given Information.';
                    $response = ['result' => false, 'message' => implode("<br>", $error_message)];
                    return $response;
                }
                $entityApplicationDetail    = $this->entityapplication->find($request->id);

                $fileName                   = $entityApplicationDetail->id.'-other-uploaded-image-'.date('His').'.png';
                $signaturefileName          = $entityApplicationDetail->id.'-other-uploaded-signature-'.date('His').'.png';

                if (empty($entityApplicationDetail)) {
                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'isPageRefresh' => true]);
                } else {
                    Log::info('Come to update');
                    if(!empty($input['draft_status']) && $input['draft_status'] == 'Draft')
                    {
                        if(!empty($input['previous_special_image_hidden']) && !empty($input['special_image_hidden']))
                        {
                            if (strpos($input['special_image_hidden'], 'data:image/') !== false) {

                                file_put_contents($filePath . '/' . $fileName, $binaryData);
                                $input['image']     = $fileName;
                                unset($input['draft_status']);
                                $filePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->image);

                                if(!empty($input['previous_special_image_hidden']))
                                {
                                    if (file_exists($filePath)) {
                                        unlink($filePath);
                                    }
                                }
                                unset($input['previous_special_image_hidden']);
                                unset($input['special_image_hidden']);
                            }
                            else
                            {
                              
                                $input['image']     = $input['special_image_hidden'];
                                unset($input['draft_status']);
                                unset($input['previous_special_image_hidden']);
                                unset($input['special_image_hidden']);
                            }
                        }
                        else if(!empty($input['previous_special_signature_hidden']) && !empty($input['special_signature_hidden']))
                        {
                            if (strpos($input['special_signature_hidden'], 'data:image/') !== false) {
                                file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);
                                $input['signature']     = $signaturefileName;
                                unset($input['draft_status']);
                                $signaturefilePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->signature);
                                if(!empty($input['previous_special_signature_hidden']))
                                {
                                    if (file_exists($signaturefilePath)) {
                                        unlink($signaturefilePath);
                                    }
                                }
                                unset($input['previous_special_signature_hidden']);
                                unset($input['draft_status']);
                                unset($input['special_signature_hidden']);
                            }
                            else
                            {
                                $input['signature']     = $input['special_signature_hidden'];
                                unset($input['draft_status']);
                                unset($input['previous_special_signature_hidden']);
                                unset($input['draft_status']);
                                unset($input['special_signature_hidden']);
                            }
                        }
                        else if(empty($input['previous_special_image_hidden']) && !empty($input['special_image_hidden']))
                        {
                           
                            file_put_contents($filePath . '/' . $fileName, $binaryData);
                            $input['image']     = $fileName;
                            $filePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->image);
                                
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                              
                            unset($input['previous_special_image_hidden']);
                            unset($input['draft_status']);
                            unset($input['special_image']);
                        }
                        else if(empty($input['previous_special_signature_hidden']) && !empty($input['special_signature_hidden']))
                        {
                            file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);
                            $input['signature']     = $signaturefileName;
                            $signaturefilePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->signature);
                            if(!empty($input['previous_special_signature_hidden']))
                            {
                                if (file_exists($signaturefilePath)) {
                                    unlink($signaturefilePath);
                                }
                            }
                            unset($input['previous_special_signature_hidden']);
                            unset($input['draft_status']);
                            unset($input['special_signature_hidden']);
                        }
                        else
                        {
                            file_put_contents($filePath . '/' . $fileName, $binaryData);
                            $filePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->image);
                            if(!empty($input['previous_special_image_hidden']))
                            {
                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                }
                            }
                            $input['image']     = $fileName;
                            unset($input['previous_special_image_hidden']);
                            unset($input['special_image_hidden']);
                            file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);
                            $signaturefilePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->signature);
                            if(!empty($input['previous_special_signature_hidden']))
                            {
                                if (file_exists($signaturefilePath)) {
                                    unlink($signaturefilePath);
                                }
                            }
                            $input['signature']     = $signaturefileName;
                            unset($input['draft_status']);
                            unset($input['previous_special_signature_hidden']);
                            unset($input['special_signature_hidden']);
                        }
                    }
                    else
                    {
                        if(!empty($input['previous_special_image_hidden']) && !empty($input['special_image_hidden']))
                        {
                            if (strpos($input['special_image_hidden'], 'data:image/') !== false) {

                                file_put_contents($filePath . '/' . $fileName, $binaryData);
                                $input['image']     = $fileName;
                                unset($input['draft_status']);
                                $filePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->image);
                                if(!empty($input['previous_special_image_hidden']))
                                {
                                    if (file_exists($filePath)) {
                                        unlink($filePath);
                                    }
                                }
                                unset($input['previous_special_image_hidden']);
                            }
                            else
                            {
                                $input['image']     = $input['special_image_hidden'];
                                unset($input['previous_special_image_hidden']);
                                unset($input['draft_status']);
                            }
                        }
                        else if(empty($input['previous_special_image_hidden']) && !empty($input['special_image_hidden']))
                        {
                            
                            //dd($entityApplicationDetail->image);
                            file_put_contents($filePath . '/' . $fileName, $binaryData);
                            $input['image']     = $fileName;
                            $filePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->image);
                            
                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                }
                           
                            unset($input['previous_special_image_hidden']);
                            unset($input['draft_status']);
                        }
                        else
                        {
                            file_put_contents($filePath . '/' . $fileName, $binaryData);
                            $input['image']     = $fileName;
                            $filePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->image);
                            if(!empty($input['previous_special_image_hidden']))
                            {
                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                }
                            }
                            unset($input['previous_special_image_hidden']);
                            unset($input['draft_status']);
                        }
                        if(!empty($input['previous_special_signature_hidden']) && !empty($input['special_signature_hidden']))
                        {
                            if (strpos($input['special_signature_hidden'], 'data:image/') !== false) {
                             
                                file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);
                                $input['signature']     = $signaturefileName;
                                unset($input['draft_status']);
                                $signaturefilePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->signature);
                                if(!empty($input['previous_special_signature_hidden']))
                                {
                                    if (file_exists($signaturefilePath)) {
                                        unlink($signaturefilePath);
                                    }
                                }
                                unset($input['previous_special_signature_hidden']);
                            }
                            else
                            {
                                $input['signature']     = $input['special_signature_hidden'];
                                unset($input['previous_special_signature_hidden']);
                                unset($input['draft_status']);
                            }
                        }
                        else if(empty($input['previous_special_signature_hidden']) && !empty($input['special_signature_hidden']))
                        {
                            file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);
                            $input['signature']     = $signaturefileName;
                            $signaturefilePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->signature);
                            
                                if (file_exists($signaturefilePath)) {
                                    unlink($signaturefilePath);
                                }
                           
                            unset($input['previous_special_signature_hidden']);
                            unset($input['draft_status']);
                        }
                        else
                        {
                            file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);
                            $input['signature']     = $signaturefileName;
                            $signaturefilePath = public_path('upload/entity-data/entity-application/'.$entityApplicationDetail->signature);
                            if(!empty($input['previous_special_signature_hidden']))
                            {
                                if (file_exists($signaturefilePath)) {
                                    unlink($signaturefilePath);
                                }
                            }
                            unset($input['previous_special_signature_hidden']);
                            unset($input['draft_status']);
                        }
                    }

                    $updateValue = array();

                    unset($input['_token']);

                    unset($input['id']);

                    unset($input['is_special_entity_application_detail_valid']);

                    unset($input['special_image_hidden']);
                    unset($input['special_signature_hidden']);
                    unset($input['previous_special_image_hidden']);
                    unset($input['previous_special_signature_hidden']);

                    $input['status']    = $this->entityapplication::ENTITY_APPLICATION_DRAFT;

                    if($input['application_type'] == 1)
                    {
                        $input['application_type'] = 1;
                        $input['status'] = 202;
                    }

                    foreach($input as $fieldName => $fieldValue){
                        $updateValue[$fieldName] = $fieldValue;
                    }
                    
                    $updateData=$this->entityapplication->where('id', $request->id);

                    $updateData->update($updateValue);
                    // dd($updateData->first()->qrcode);
                    $previousqrcode = $updateData->first()->qrcode;
                    Log::info('GenerateQRCodeUpdate');

                    $qrcodefile=$this->generateQrcode($updateData->first());

                    Log::info($qrcodefile);
                   
                    $previous_qr_code = public_path('upload/qrcode/'.$updateData->first()->qrcode);

                    $updateData->update(['qrcode'=>$qrcodefile]);
                    
                    if(!empty($previousqrcode))
                    {
                        if (file_exists($previous_qr_code) ) {
                            unlink($previous_qr_code);
                        }
                    }

                    $entityApplicationDetail            = DB::table('entity_applications')->select('entity_applications.*','user.company_name as entity_name','user.authorized_person_first_name','user.authorized_person_last_name','user.unit_category as entity_type')->leftjoin('users as user','user.id','=','entity_applications.user_id')
                    ->where('entity_applications.is_deleted','No')
                    ->where('entity_applications.id',$entityApplicationDetail->id)

                    ->first();

                    

                    $entityApplicationDetail->image     = asset('/upload/entity-data/entity-application/'.$entityApplicationDetail->image);

                    

                    $entityApplicationDetail->qrcode    = asset('/upload/qrcode/'.$qrcodefile);

                    $entityApplicationDetail->issue_date = date('d-m-Y',strtotime($entityApplicationDetail->issue_date));

                    $entityApplicationDetail->mobile_number = '+'.$entityApplicationDetail->dial_code.' '.$entityApplicationDetail->mobile_number;
                    $entityApplicationDetail->application_type = Helper::getEntityApplicationType($entityApplicationDetail->application_type);

                    return response()->json(['result' => true, 'message' => 'Entity Application\'s basic detail is updated','entityApplicationData' => $entityApplicationDetail]);
                }

            } else {
                // dd($input);
                $error_message = array();
                $entityApplicationEmailCheck = $this->commonCheckEntityApplicationDataExists($request);
                if (!empty($entityApplicationEmailCheck)) {
                    $error_message[] = 'Application is already registered with given Information.';
                    $response = ['result' => false, 'message' => implode("<br>", $error_message)];
                    return $response;
                }
                // $entityApplicationEmailCheck = $this->entityapplication->where('email', $request->email);

                // if(isset($request->id) && !empty($request->id)){
                //     $entityApplicationEmailCheck->where('id', '!=', $request->id);
                // }
                // $entityApplicationEmailCheck = $entityApplicationEmailCheck->first();
                // if(!empty($entityApplicationEmailCheck)){
                //     $error_message[] = 'Appllication is already registered with added email address.';
                // }

                if(empty($error_message))
                {
                    unset($input['id']);
                    $input['status']                    = $this->entityapplication::ENTITY_APPLICATION_DRAFT;
                    $entityApplicationDetail            = $this->entityapplication->create($input);
                    $fileName                           = $entityApplicationDetail->id.'-other-uploaded-image'.date('His').'.png';
                    $signaturefileName                  = $entityApplicationDetail->id.'-other-uploaded-signature'.date('His').'.png';
                    $input['image']                     = $fileName;
                    $input['signature']                 = $signaturefileName;

                    file_put_contents($filePath . '/' . $fileName, $binaryData);
                    file_put_contents($signaturefilePath . '/' . $signaturefileName, $signaturebinaryData);

                    Log::info('GenerateQRCode');

                    $qrcodefile=$this->generateQrcode($entityApplicationDetail);

                    Log::info($qrcodefile);

                    $entityApplicationUpdatedDetail     = $this->entityapplication->where('id',$entityApplicationDetail->id)->update(['image' => $fileName,'signature' => $signaturefileName,'qrcode'=>$qrcodefile]);

                    $entityApplicationDetail            = DB::table('entity_applications')->select('entity_applications.*','user.company_name as entity_name','user.authorized_person_first_name','user.authorized_person_last_name','user.unit_category as entity_type')->leftjoin('users as user','user.id','=','entity_applications.user_id')
                        ->where('entity_applications.id',$entityApplicationDetail->id)
                        ->first();

                    $entityApplicationDetail->image     = asset('/upload/entity-data/entity-application/'.$entityApplicationDetail->image);
                    if($entityApplicationDetail->type!='Permanent'){
                        $entityApplicationDetail->backgroundimg = asset('/img/temporary_front_card.jpg');
                    }else{
                        $entityApplicationDetail->backgroundimg = asset('/img/front_card_bg.jpg');
                    }

                    $entityApplicationDetail->qrcode = asset('/upload/qrcode/'.$qrcodefile);

                    $entityApplicationDetail->issue_date = date('d-m-Y',strtotime($entityApplicationDetail->issue_date));

                    $entityApplicationDetail->mobile_number = '+'.$entityApplicationDetail->dial_code.' '.$entityApplicationDetail->mobile_number;

                    $entityApplicationDetail->application_type = Helper::getEntityApplicationType($entityApplicationDetail->application_type);

                    $entityApplicationDetail->draft_status = 'Draft';

                    return response()->json(['result' => true, 'message' => 'Entity Application\'s basic detail is saved', 'entityApplicationData' => $entityApplicationDetail]);
                }
                else
                {
                    return response()->json(['result' => false, 'message' => implode("<br>", $error_message)]);
                }
            }
        } catch (\Exception $ex) {
            return response(['result' => false, 'message' => $ex->getMessage()]);
        }
    }

    public function saveSpecialEntityApplicationVerifyAndSubmitDetail(Request $request)
    {
        //dd($request->all());
        try {
            $input = $request->all();
            $currentYear = date('Y');
            if($request->id > 0){
                $entityApplicationDetail = $this->entityapplication->find($request->id);
                $latestSerialNumber = $this->entityapplication->where('type', $entityApplicationDetail->type)
                                ->where('special_serial_no_year', $currentYear)
                                ->orderBy('special_serial_no','DESC')
                                ->first();
              
                if(!empty($entityApplicationDetail->special_serial_no))
                {
                    $input['special_serial_no']= $entityApplicationDetail->special_serial_no;
                    $input['final_special_serial_no']= $entityApplicationDetail->final_special_serial_no;
                }
                else
                {
                    $input['special_serial_no']=(!empty($latestSerialNumber->special_serial_no) ? $latestSerialNumber->special_serial_no+1 : 1);
                    $input['final_special_serial_no'] = 'G-' . str_pad($input['special_serial_no'], 2, '0', STR_PAD_LEFT) . '/' . $currentYear;
                }
                $input['special_serial_no_year'] = $currentYear;
                $input['issue_date'] = date('Y-m-d');
                
                if (empty($entityApplicationDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'redirectPage' => route('entity.create-new-application')]);

                } else {

                    $error_message = array();
                    $entityApplicationEmailCheck = $this->entityapplication->where('email', $entityApplicationDetail->email);
                    if(isset($request->id) && !empty($request->id)){
                        $entityApplicationEmailCheck->where('id', '!=', $request->id);
                    }
                    $entityApplicationEmailCheck = $entityApplicationEmailCheck->first();
                    if(!empty($entityApplicationEmailCheck)){
                        $error_message[] = 'Appllication is already registered with added email address.';
                    }
                    if(empty($error_message))
                    {
                        $updateValue = array();
                        unset($input['_token']);
                        unset($input['id']);
                        unset($input['user_id']);
                        unset($input['accept_term']);
                        $input['status']        = $this->entityapplication::ENTITY_APPLICATION_SUBMITTED;
                        if(!empty($entityApplicationDetail->application_number))
                        {
                            $application_number = $entityApplicationDetail->application_number;
                        }
                        else
                        {
                            $application_number = $this->generateApplicationNumber();
                        }
                        $input['application_number'] = $application_number;

                        foreach($input as $fieldName => $fieldValue){
                            $updateValue[$fieldName] = $fieldValue;
                        }

                        $entityApplicationDetailUpdate = $this->entityapplication->where('id',$entityApplicationDetail->id);
                        $entityApplicationDetailUpdate->update($updateValue);

                        Log::info('saveSpecialEntityApplicationVerifyAndSubmitDetail');
                        $qrcodefile=$this->generateQrcode($entityApplicationDetailUpdate->first());

                        Log::info($qrcodefile);

                        $previous_qr_code = public_path('upload/qrcode/'.$entityApplicationDetailUpdate->first()->qrcode);


                        $entityApplicationDetailUpdate->update(['qrcode'=>$qrcodefile]);
    
                        if(!empty($entityApplicationDetailUpdate->first()->qrcode))
                        {
                            if (file_exists($previous_qr_code) ) {
                                unlink($previous_qr_code);
                            }
                        }
                        $getEntityData= Helper::getEntityDetail($entityApplicationDetail->user_id);
                        $entityMail=$getEntityData->email;

                        $entityApplicationDetail = $this->entityapplication->findOrFail($entityApplicationDetail->id);

                        $mailData = array('data' => $entityApplicationDetail, 'mailType' => 'newEntityApplication');

                        Mail::to($entityMail)->send(new SendMailable($mailData));

                        return response()->json(['result' => true, 'message' => 'Entity Application\'s detail submitted', 'entityApplicationId' => $entityApplicationDetail['id'],'user_id' => $entityApplicationDetail['user_id']]);
                    }
                    else
                    {
                        return response()->json(['result' => false, 'message' => implode("<br>", $error_message)]);
                    }
                }
            } else {
                return response()->json(['result' => false, 'message' => 'Entity details not saved. Please save it first']);
            }
        } catch (\Exception $ex) {
            return response(['result' => false, 'message' => $ex->getMessage()]);
        }
    }

    public function generateQrcode($entityApplicationDetail) {
        // $qrcodeData=array(

        //     'Application No.'=>$entityApplicationDetail->application_number,

        //     'Contact No.'=>$entityApplicationDetail->mobile_number,

        //     'Auth Person Name'=>$entityApplicationDetail->authorized_signatory,

        //     'Date of Issue'=>date('d-m-Y',strtotime($entityApplicationDetail->created_at)),

        //     'Valid upto'=>date('d-m-Y',strtotime($entityApplicationDetail->expire_date))

        // );
        $qrcodeData = url('id-card-application/'.encrypt($entityApplicationDetail->id));
        $qrcodefile = 'qrcode_' . uniqid() . '.svg';
        // Generate the QR code with sample data (replace with your actual data)

        // $qrcodeData = json_encode($qrcodeData,true);

        // $qrcodeData = implode(PHP_EOL, array_map(function ($key, $value) {

        //     return $key . (is_array($value) ? arrayToUl($value) : ': ' . $value);

        // }, array_keys($qrcodeData), $qrcodeData));

        Log::info('Data inside QR code');
        Log::info($qrcodeData);
        QrCode::size(300)->generate($qrcodeData, public_path('upload/qrcode/' . $qrcodefile));
        return $qrcodefile;
    }

    function generateApplicationNumber() {
        $randomNumber = mt_rand(1000000, 9999999);
        $exists = $this->entityapplication->where('application_number', $randomNumber)->exists();
        if ($exists) {
            return $this->generateUniqueRandomNumber();
        }
        // If the number is unique, return it
        return $randomNumber;
    }

    public function adminSpecialApplicationsView()
    {
        $filterCompanyData=EntityApplication::filterBaseCompanyData('0');
        if (Auth::user()->getRoleNames()->first() == 'Admin' || Auth::user()->getRoleNames()->first() == 'Sub Admin' || Auth::user()->getRoleNames()->first() == 'Super Admin') {
            $userId=Auth::id();
        $buildingList=Address::where('status',1)->pluck('address');
        $companyList = Company::pluck('name');
        
        if(Auth::user()->getRoleNames()->first() == 'Admin')
        {
            $companyNames = EntityApplication::select('users.company_name')
                            ->distinct('entity_applications.company_name')
                            ->leftJoin('users', 'entity_applications.user_id', '=', 'users.id')
                            // ->latest()
                            ->whereNotIn('status', [201,202])
                            ->pluck('users.company_name');
                      
            $statuses = EntityApplication::select(DB::raw('CASE
                            WHEN status = 200 THEN "Approved"
                            WHEN status = 500 THEN "Rejected"
                            WHEN status = 501 THEN "Expired"
                            WHEN status = 502 THEN "Deactivated"
                            WHEN status = 203 THEN "Activated"
                            WHEN status = 204 THEN "Verified"
                            WHEN status = 206 THEN "Hard copy submitted"
                            WHEN status = 255 THEN "Terminated"
                            WHEN status = 403 THEN "Blocked"
                            ELSE "Undefined"
                        END AS status'))
                                        ->whereNotIn('status', [201,202,205,401])
                                        ->distinct('status')
                                        ->pluck('status');
        }
        else
        {
            $companyNames = EntityApplication::select('users.company_name')
                            ->distinct('entity_applications.company_name')
                            ->leftJoin('users', 'entity_applications.user_id', '=', 'users.id')
                            // ->latest()
                            ->pluck('users.company_name');
            // dd($companyNames);
            $statuses = EntityApplication::select(DB::raw('CASE
                                                WHEN status = 200 THEN "Approved"
                                                WHEN status = 202 THEN "Submited"
                                                WHEN status = 500 THEN "Rejected"
                                                WHEN status = 501 THEN "Expired"
                                                WHEN status = 401 THEN "Surrendered"
                                                WHEN status = 502 THEN "Deactivated"
                                                WHEN status = 203 THEN "Activated"
                                                WHEN status = 204 THEN "Verified"
                                                WHEN status = 205 THEN "Send Back"
                                                WHEN status = 206 THEN "Hard copy submitted"
                                                WHEN status = 255 THEN "Terminated"
                                                WHEN status = 403 THEN "Blocked"
                                                WHEN status = null THEN ""
                                                ELSE "Undefined"
                                            END AS status'))
                        ->whereNotIn('status', [201])
                        ->distinct('status')
                        ->pluck('status');                  
            // dd($statuses);
        }
        if(request()->ajax()) {
            if(Auth::user()->getRoleNames()->first() == 'Admin')
            {
                $data = EntityApplication::select('entity_applications.*','users.company_name as company_name')
                                            ->leftJoin('users', 'users.id', '=', 'entity_applications.user_id')
                                            ->whereNotIn('entity_applications.status', [201,202,205,401])
                                            ->Where('entity_applications.type','Other')
                                            ->where('entity_applications.is_deleted','No')
                                            ->orderBy('entity_applications.serial_no','DESC')
                                            ->latest();
            }
            else
            {
                $data = EntityApplication::select('entity_applications.*','users.company_name as company_name')
                                        ->leftJoin('users', 'users.id', '=', 'entity_applications.user_id')
                                        ->whereNotIn('entity_applications.status', [201])
                                        ->Where('entity_applications.type','Other')
                                        ->where('entity_applications.is_deleted','No')
                                        ->orderBy('entity_applications.serial_no','DESC')
                                        ->latest();
            }


            // Add separate filters for status and name
            if (request()->has('columns')) {
                $columns = request()->get('columns');
                // Filter by status
                if (isset($columns[8]['search']['value'])) {
                    $statusFilter = $this->getVal($columns[8]['search']['value']);
                    // dump( $statusFilter);
                    $statusFilter=Helper::getApplicationCode($statusFilter);
                    // dd($statusFilter);
                    $data->where('entity_applications.status', $statusFilter);
                }
                if (isset($columns[4]['search']['value'])) {
                    $statusFilter = $this->getVal($columns[4]['search']['value']);
                    $data->where('entity_applications.type', $statusFilter);
                }
            }
            // dd($data->get());
            $dataTable = datatables()->of($data);
            $dataTable->filter(function ($query) {
                if (request()->has('search')) {
                    $searchTerm = request()->get('search')['value'];
                    $query->where(function ($subQuery) use ($searchTerm) {
                        foreach ($subQuery->getModel()->getFillable() as $column) {
                            if ($column === 'first_name' || $column === 'last_name') {
                                $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            }
                            elseif ($column === 'user_id') {
                                $subQuery->orWhereRaw("users.company_name LIKE ?", ["%{$searchTerm}%"]);
                            }
                            else {
                                $subQuery->orWhere('entity_applications.'.$column, 'like', "%{$searchTerm}%");
                            }
                            // $subQuery->orWhere($column, 'like', "%{$searchTerm}%");
                        }
                    });
                }
            });
            return $dataTable->addColumn('application_number', function($row){
                return $row->application_number;
            })
            ->addColumn('users.company_name', function($row){
                return $row->company_name;
            })
            ->addColumn('application_type', function($row){
               return Helper::getEntityApplicationType($row->application_type); 
            })
            ->addColumn('type', function($row){
                return $row->type;
            })
            ->addColumn('issue_date', function($row){
                return date('d-m-Y',strtotime($row->issue_date));
            })
            ->addColumn('expire_date', function($row){
                if ($row->type == 'Other') {
                    return '';
                }
                return date('d-m-Y',strtotime($row->expire_date));
            })
            ->addColumn('serial_no', function($row){
                if (!empty($row->final_special_serial_no)) {
                    return $row->final_special_serial_no;
                }
                else{
                    return $row->serial_no;
                }
            })
            ->addColumn('name', function($row){
                return $row->fullname;
            })
            ->addColumn('status', function($row){
                return '<span class="label label-lg label-inline ' . Helper::getApplicationStatusBackgroundColor($row->status) . '">' . Helper::getApplicationType($row->status) . '</span>';
            })
            ->addColumn('is_verified', function($row){
                if($row->is_verified==0){
                    return '<a href="javascript:;" class="label label-lg label-inline background-light-orange text-orange" onclick="verifyentityapplication('.$row->id.')">Verify</a>';
                }elseif($row->is_verified==1){
                    return '<span class="label label-lg label-inline background-light-green text-green">Verified</span>';
                }else{
                    return '';
                }
            })
            ->addColumn('action', function($row){
                $btn = '<div class="d-flex align-items-center">                    
                <a id="viewApplication" class="viewApplication btn btn-primary btn-sm"  data-id="'.$row->id.'">
                    <i class="fas fa-eye fa-1x text-green"></i>                        
                </a>
            </div>';
                return $btn;
            })->rawColumns(['status','is_verified','action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('specialentity.admin-special-application-view',compact('companyNames','statuses','buildingList','companyList','filterCompanyData'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function adminSpecialEntityView()
    {

        if (Auth::user()->getRoleNames()->first() == 'Super Admin')
        {
            $userId=Auth::id();
            $statuses = EntityApplication::select(DB::raw('CASE
                                                WHEN status = 200 THEN "Approved"
                                                WHEN status = 201 THEN "Draft"
                                                WHEN status = 202 THEN "Submited"
                                                WHEN status = 500 THEN "Rejected"
                                                WHEN status = 501 THEN "Expired"
                                                WHEN status = 401 THEN "Surrendered"
                                                WHEN status = 502 THEN "Deactivated"
                                                WHEN status = 203 THEN "Activated"
                                                WHEN status = 204 THEN "Verified"
                                                WHEN status = 206 THEN "Hard copy submitted"
                                                WHEN status = 255 THEN "Terminated"
                                                WHEN status = 205 THEN "Send Back"
                                                WHEN status = 403 THEN "Blocked"
                                                WHEN status = null THEN ""
                                                ELSE "Undefined"
                                            END AS status'))
                        // ->whereNotIn('status', [201,202,205])
                        // ->orderBy('created_at', 'desc')
                        ->distinct('status')
                        ->pluck('status');
            $applicationTypes = EntityApplication::select('type')
            ->where('type', 'Other')
            ->distinct('type')
            ->pluck('type');
            if(request()->ajax()) {
    
                $data=EntityApplication::where('type', 'Other')
                                        ->orderBy('serial_no', 'DESC')
                                        ->where('is_deleted','No')
                                        ->select('*');
                if (request()->has('columns')) {
    
                    $columns = request()->get('columns');
                    // Filter by status
                    if (isset($columns[7]['search']['value'])) {
    
                        $statusFilter = $this->getVal($columns[7]['search']['value']);
                        $statusFilter=Helper::getApplicationCode($statusFilter);
    
                        $data->where('entity_applications.status', $statusFilter);
                    }
                    if (isset($columns[3]['search']['value'])) {
    
                        $statusFilter = $this->getVal($columns[3]['search']['value']);
    
                        $data->where('entity_applications.type', $statusFilter);
                    }
                }
    
    
                $dataTable = datatables()->of($data);
    
    
    
                // Add global search filter
    
                $dataTable->filter(function ($query) {
    
                    if (request()->has('search')) {
    
                        $searchTerm = request()->get('search')['value'];
    
    
    
                        $query->where(function ($subQuery) use ($searchTerm) {
    
                            foreach ($subQuery->getModel()->getFillable() as $column) {
    
                                $subQuery->orWhere($column, 'like', "%{$searchTerm}%");
    
                            }
    
                        });
    
                    }
    
                });
    
    
    
                return $dataTable->addColumn('application_type', function($row){
                    // dd($row->application_type);
                    return Helper::getEntityApplicationType($row->application_type);
    
                })
    
                ->addColumn('issue_date', function($row){
                    return date('d-m-Y',strtotime($row->issue_date));
                })
                ->addColumn('expire_date', function($row){
                    if ($row->type == 'Other') {
                        return '';
                    }
                    return date('d-m-Y',strtotime($row->expire_date));
                })
                ->addColumn('type', function($row){
                    return $row->type;
                })
                ->addColumn('serial_no', function($row){
                    if (empty($row->serial_no)) {
                        $row->serial_no = $row->final_special_serial_no;
                    } 
                    return $row->serial_no;
                })
                ->addColumn('name', function($row){
                    return $row->fullname;
                })
                ->addColumn('status', function($row){
                    return '<span class="label label-lg label-inline '.Helper::getApplicationStatusBackgroundColor($row->status) .'">'.Helper::getApplicationType($row->status).'</span>';
                })
                ->rawColumns(['status','application_type'])
                ->addIndexColumn()
                ->make(true);
            }
            return view('specialentity.super-admin-special-application-view',compact('statuses','applicationTypes'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function commonCheckEntityApplicationDataExists($request){
        $userId = Auth::id();
        $formattedMobileNumber = preg_replace('/\s+/', '', $request->mobile_number);
        $fullNameWSpace = $request->first_name.' '.$request->last_name;
        $entityApplicationEmailCheck = $this->entityapplication
        ->where(function ($query) use ($request,$fullNameWSpace) {
            $query->where('first_name', $request->first_name)
                ->orWhere('first_name', $request->first_name.''.$request->last_name)
                ->orWhere('first_name', $fullNameWSpace); // Handle null last_name
        })
        ->where(function ($query) use ($request) {
            $query->where('last_name', $request->last_name)
                ->orWhere('last_name','')
                ->orWhereNull('last_name'); // Handle null last_name
        })
        ->where(function ($query) use ($request,$formattedMobileNumber) {
            
            $query->where('mobile_number', $request->mobile_number)
                ->orWhere('mobile_number', $formattedMobileNumber); // Handle null last_name
        })
        ->where('is_deleted','No')
        ->where("user_id", $userId);

        if (isset($request->id) && !empty($request->id)) {
            $entityApplicationEmailCheck->where('id', '!=',  $request->id);
        }
        $entityApplicationEmailCheck = $entityApplicationEmailCheck->first();

        return $entityApplicationEmailCheck;
    }
}
