<?php



namespace App\http\Controllers;



use App\Models\Group;

use App\Models\LiqourApplication;

use App\Models\User;

use App\Models\EntityApplication;

use App\Models\Company;

use App\Mail\SendMailable;

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

use Mpdf\Config\ConfigVariables;

use Mpdf\Config\FontVariables;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Log;

use Helper;

use App\Exports\ExportLiqourApp;

use Maatwebsite\Excel\Facades\Excel;



class LiqourController extends Controller

{

    //

    public function __construct()

    {

        $this->user = new User();

        $this->group = new Group();

        $this->liqourapplication = new LiqourApplication();



    }

    public function createNewLiqourApplication(){

        # Get country list
        $lastSerialNumber = LiqourApplication::latest()->limit(1)->pluck('serial_number')->first();
       
        $lastSerialNumber = $lastSerialNumber+1;
        $lastSerialNumber = str_pad((int)$lastSerialNumber, 5, '0', STR_PAD_LEFT);
        return view('liqour.create-new-liqour-application',compact('lastSerialNumber'))->with([]);


    }



    public function saveLiqourApplicationDetail(Request $request)

    {

        try {

            $input = $request->all();
            //     foreach ($input as $key => $value) {

            //     // Check if the key is not 'image' or 'image_hidden'

            //         if ($key !== 'liqour_image_hidden' && $key !== 'previous_liqour_image_hidden') {

            //             // Convert the value to uppercase
            //             $value = strtolower($value);
            //             $input[$key] = ucwords($value);

            //         }

            // }
            // dd($input);

            // foreach ($input as $key => $value) {

            //     // Check if the key is not 'image' or 'image_hidden'

            //     if ($key !== 'liqour_image_hidden' && $key !== 'previous_liqour_image_hidden') {

            //         // Convert the value to uppercase

            //         $input[$key] = strtoupper($value);

            //     }

            // }

            

            $input['expire_date']=date('Y-m-d', strtotime('+2 years'));



            $file       = $input['liqour_image_hidden'];

            $fileDir    = config('constant.LIQOUR_APPLICATION_IMAGE_PATH');

            $filePath   = public_path('upload').DIRECTORY_SEPARATOR.$fileDir;

            $base64Data = substr($file, strpos($file, ',') + 1);

            $binaryData = base64_decode($base64Data);



            File::makeDirectory($filePath, $mode = 0777, true, true);

            $liqourApplicationDetail    = $this->liqourapplication->find($request->id);

            if($request->id > 0){

                

                $liqourApplicationDetail    = $this->liqourapplication->find($request->id);

                $fileName                   = $liqourApplicationDetail->id.'-uploaded-image-'.date('His').'.png';

                if (empty($liqourApplicationDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'isPageRefresh' => true]);

                } else {

                    Log::info('Come to update');

                    

                    // file_put_contents($filePath . '/' . $fileName, $binaryData);

                    // $input['image']     = $fileName;

                    // unset($input['previous_image_hidden']);

                    if(!empty($input['draft_status']) && $input['draft_status'] == 'Draft')

                    {

                        if(!empty($input['previous_liqour_image_hidden']) && !empty($input['liqour_image_hidden']))

                        {

                            if (strpos($input['liqour_image_hidden'], 'data:image/') !== false) {

                                // The string contains "data:image/"

                                // dd(1);

                                // Add your logic here

                                file_put_contents($filePath . '/' . $fileName, $binaryData);

                                $input['image']     = $fileName;

                                unset($input['draft_status']);

                                $filePath = public_path('upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                                if (file_exists($filePath)) {

                                    unlink($filePath);

                                }

                                unset($input['previous_liqour_image_hidden']);

                            }

                            else

                            {

                                // dd(2);

                                $input['image']     = $input['liqour_image_hidden'];

                                unset($input['draft_status']);

                                unset($input['previous_liqour_image_hidden']);

                            }

                            

                        }

                        else if(empty($input['previous_liqour_image_hidden']) && !empty($input['liqour_image_hidden']))

                        {

                            file_put_contents($filePath . '/' . $fileName, $binaryData);

                            $input['image']     = $fileName;

                            $filePath = public_path('upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                            if (file_exists($filePath)) {

                                unlink($filePath);

                            }

                            unset($input['previous_liqour_image_hidden']);

                        }

                        else

                        {

                            file_put_contents($filePath . '/' . $fileName, $binaryData);

                            $filePath = public_path('upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                            if (file_exists($filePath)) {

                                unlink($filePath);

                            }

                            $input['image']     = $fileName;

                            unset($input['previous_liqour_image_hidden']);

                        }

                    }

                    else

                    {

                        if(!empty($input['previous_liqour_image_hidden']) && !empty($input['liqour_image_hidden']))

                        {

                            if (strpos($input['liqour_image_hidden'], 'data:image/') !== false) {

                                // The string contains "data:image/"

                                // dd(1);

                                // Add your logic here

                                file_put_contents($filePath . '/' . $fileName, $binaryData);

                                $input['image']     = $fileName;

                                unset($input['draft_status']);

                                $filePath = public_path('upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                                if (file_exists($filePath)) {

                                    unlink($filePath);

                                }

                                unset($input['previous_liqour_image_hidden']);

                            }

                            else

                            {

                                // dd(2);

                                $input['image']     = $input['liqour_image_hidden'];

                                unset($input['previous_liqour_image_hidden']);

                                unset($input['draft_status']);

                                

                            }

                        }

                        else if(empty($input['previous_liqour_image_hidden']) && !empty($input['liqour_image_hidden']))

                        {

                            file_put_contents($filePath . '/' . $fileName, $binaryData);

                            $input['image']     = $fileName;

                            $filePath = public_path('upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                            if (file_exists($filePath)) {

                                unlink($filePath);

                            }

                            unset($input['previous_liqour_image_hidden']);

                            unset($input['draft_status']);

                        }

                        else

                        {

                            file_put_contents($filePath . '/' . $fileName, $binaryData);

                            $input['image']     = $fileName;

                            $filePath = public_path('upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                            if (file_exists($filePath)) {

                                unlink($filePath);

                            }

                            unset($input['previous_liqour_image_hidden']);

                            unset($input['draft_status']);

                        }

                    }

                    



                    $updateValue = array();

                    unset($input['_token']);

                    unset($input['id']);

                    unset($input['is_liqour_application_detail_valid']);

                    unset($input['liqour_image_hidden']);

                    

                    $input['status']    = $this->liqourapplication::LIQOUR_APPLICATION_DRAFT;

                    

                    $input['is_active'] = 1;

                    // dd($input);

                    foreach($input as $fieldName => $fieldValue){

                        $updateValue[$fieldName] = $fieldValue;

                    }

                    

                    $updateData=$this->liqourapplication->where('id', $request->id);

                    $updateData->update($updateValue);

                    

                    Log::info('GenerateQRCodeUpdate');



                    $qrcodefile=$this->generateQrcode($updateData->first());

                    // dd($updateData->first()->qrcode);

                    Log::info($qrcodefile);

                    $previous_qr_code = public_path('upload/liqour-data/liqour-application/qrcode/'.$updateData->first()->qrcode);

                    // dd($updateData->qrcode);

                    $updateData->update(['qrcode'=>$qrcodefile]);
                    if (file_exists($previous_qr_code) ) {

                        unlink($previous_qr_code);

                    }


                    $liqourApplicationDetail            = DB::table('liqour_applications')->select('liqour_applications.*','user.company_name as liqour_name','user.authorized_person_first_name','user.authorized_person_last_name','user.unit_category as liqour_type')->leftjoin('users as user','user.id','=','liqour_applications.user_id')

                    ->where('liqour_applications.id',$liqourApplicationDetail->id)

                    ->first();

                    

                    $liqourApplicationDetail->image     = asset('/upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                    

                    $liqourApplicationDetail->qrcode    = asset('/upload/liqour-data/liqour-application/qrcode/'.$qrcodefile);

                    $liqourApplicationDetail->created_at = date('d-m-Y',strtotime($liqourApplicationDetail->created_at));

                    $liqourApplicationDetail->expire_date = date('d-m-Y',strtotime($liqourApplicationDetail->expire_date));

                    $liqourApplicationDetail->mobile_number = '+'.$liqourApplicationDetail->dial_code.' '.$liqourApplicationDetail->mobile_number;



                    return response()->json(['result' => true, 'message' => 'Entity Application\'s basic detail is updated','liqourApplicationData' => $liqourApplicationDetail]);

                }

            } else {

                $error_message = array();

                unset($input['_token']);

                unset($input['id']);

                unset($input['is_liqour_application_detail_valid']);

                unset($input['liqour_image_hidden']);

                if(empty($error_message))

                {

                    unset($input['id']);

                    $input['status']                    = $this->liqourapplication::LIQOUR_APPLICATION_DRAFT;
                    $input['serial_number']             = $this->generateSerialNumber();
                    $input['application_number']        = $this->generateApplicationNumber();
                    $input['is_active']                 = 0;
                    
                    $liqourApplicationDetail            = $this->liqourapplication->create($input);

                    $fileName                           = $liqourApplicationDetail->id.'-uploaded-image'.date('His').'.png';

                    $input['image']                     = $fileName;

                    file_put_contents($filePath . '/' . $fileName, $binaryData);



                    Log::info('GenerateQRCode');

                    $qrcodefile=$this->generateQrcode($liqourApplicationDetail);

                    Log::info($qrcodefile);

                    $liqourApplicationUpdatedDetail     = $this->liqourapplication->where('id',$liqourApplicationDetail->id)->update(['image' => $fileName,'qrcode'=>$qrcodefile]);



                    $liqourApplicationDetail            = DB::table('liqour_applications')->select('liqour_applications.*','user.authorized_person_first_name','user.authorized_person_last_name')->leftjoin('users as user','user.id','=','liqour_applications.user_id')

                        ->where('liqour_applications.id',$liqourApplicationDetail->id)

                        ->first();

                    $liqourApplicationDetail->image     = asset('/upload/liqour-data/liqour-application/'.$liqourApplicationDetail->image);

                    

                    $liqourApplicationDetail->qrcode = asset('/upload/liqour-data/liqour-application/qrcode/'.$qrcodefile);

                    $liqourApplicationDetail->created_at = date('d-m-Y',strtotime($liqourApplicationDetail->created_at));

                    $liqourApplicationDetail->expire_date = date('d-m-Y',strtotime($liqourApplicationDetail->expire_date));

                    $liqourApplicationDetail->mobile_number = '+'.$liqourApplicationDetail->dial_code.' '.$liqourApplicationDetail->mobile_number; 

                    return response()->json(['result' => true, 'message' => 'Liqour Application\'s basic detail is saved', 'liqourApplicationData' => $liqourApplicationDetail]);

                }

                else

                {

                    return response()->json(['result' => false, 'message' => implode("<br>", $error_message)]);

                }

            }

        } catch (\Exception $ex) {

            // dd($ex);

            return response(['result' => false, 'message' => $ex->getMessage()]);

        }

    }



    public function saveLiqourApplicationVerifyAndSubmitDetail(Request $request)

    {

        // dd($request->all());

        try {

            $input = $request->all();

            if($request->id > 0){

                $liqourApplicationDetail = $this->liqourapplication->find($request->id);



                if (empty($liqourApplicationDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'redirectPage' => route('liqour.create-new-liqour-application')]);

                } else {

                    $error_message = array();

                    if(empty($error_message))

                    {

                        $updateValue = array();

                        unset($input['_token']);

                        unset($input['id']);

                        unset($input['user_id']);

                        unset($input['accept_term']);

                        // $input['is_verified']   = 'Yes';

                        $input['status']        = $this->liqourapplication::LIQOUR_APPLICATION_SUBMITTED;

                        $input['is_active'] = 1;

                        // $input['serial_number'] = $serial_number;



                        foreach($input as $fieldName => $fieldValue){

                            $updateValue[$fieldName] = $fieldValue;

                        }

                        $liqourApplicationDetailUpdate = $this->liqourapplication->where('id',$liqourApplicationDetail->id);

                        $liqourApplicationDetailUpdate->update($updateValue);



                        Log::info('saveEntityApplicationVerifyAndSubmitDetail');



                        $qrcodefile=$this->generateQrcode($liqourApplicationDetailUpdate->first());



                        Log::info($qrcodefile);

                        $previous_qr_code = public_path('upload/qrcode/'.$liqourApplicationDetailUpdate->first()->qrcode);

                        $liqourApplicationDetailUpdate->update(['qrcode'=>$qrcodefile]);
    
                        if (file_exists($previous_qr_code) ) {
    
                            unlink($previous_qr_code);
    
                        }




                        // $getEntityData= Helper::getEntityDetail($liqourApplicationDetailUpdate->user_id);

                        // $entityMail=$getEntityData->email;

                        // dd($entityApplicationDetail->application_number);

                        // Todo:Send Mail to entity mail address related to application

                        $liqourApplicationDetail = $this->liqourapplication->findOrFail($liqourApplicationDetail->id);

                        

                        // $mailData = array('data' => $liqourApplicationDetail, 'mailType' => 'newEntityApplication');



                        // Mail::to($entityMail)->send(new SendMailable($mailData));

                       

                        return response()->json(['result' => true, 'message' => 'Liqour Application\'s detail submitted', 'liqourApplicationId' => $liqourApplicationDetail['id'],'user_id' => $liqourApplicationDetail['user_id']]);

                    }

                    else

                    {

                        return response()->json(['result' => false, 'message' => implode("<br>", $error_message)]);

                    }

                }

            } else {

                return response()->json(['result' => false, 'message' => 'Liqour details not saved. Please save it first']);

            }

        } catch (\Exception $ex) {

            

            return response(['result' => false, 'message' => $ex->getMessage()]);

        }

    }



    public function generateQrcode($liqourApplicationDetail) {

        // $qrcodeData=array(

        //     'Application No.'=>$entityApplicationDetail->application_number,

        //     'Contact No.'=>$entityApplicationDetail->mobile_number,

        //     'Auth Person Name'=>$entityApplicationDetail->authorized_signatory,

        //     'Date of Issue'=>date('d-m-Y',strtotime($entityApplicationDetail->created_at)),

        //     'Valid upto'=>date('d-m-Y',strtotime($entityApplicationDetail->expire_date))

        // );

        $qrcodeDirectory = public_path('upload/liqour-data/liqour-application/qrcode/');



        if (!File::exists($qrcodeDirectory)) {

            File::makeDirectory($qrcodeDirectory, 0755, true);

        }

        $qrcodeData = url('liqour/liqour-id-card-application/'.encrypt($liqourApplicationDetail->id));



        $qrcodefile = 'qrcode_' . uniqid() . '.svg';



        // Generate the QR code with sample data (replace with your actual data)

        // $qrcodeData = json_encode($qrcodeData,true);

        // $qrcodeData = implode(PHP_EOL, array_map(function ($key, $value) {

        //     return $key . (is_array($value) ? arrayToUl($value) : ': ' . $value);

        // }, array_keys($qrcodeData), $qrcodeData));



        Log::info('Data inside QR code');

        Log::info($qrcodeData);



        QrCode::size(300)->generate($qrcodeData, public_path('upload/liqour-data/liqour-application/qrcode/' . $qrcodefile));



        return $qrcodefile;

    }



    function generateApplicationNumber() {

        $randomNumber = mt_rand(1000000, 9999999);

        $exists = $this->liqourapplication->where('application_number', $randomNumber)->exists();



        if ($exists) {

            return $this->generateUniqueRandomNumber();

        }

        // If the number is unique, return it

        return $randomNumber;

    }



    public function generateSerialNumber()

    {

        // Get the last serial number from the database

        // $lastSerialNumber = LiqourApplication::select(DB::raw("LPAD(CAST(COALESCE(MAX(SUBSTRING(serial_number, -5)) + 1, 1) AS CHAR), 5, '0') AS new_serial_number"))

        //     ->value('new_serial_number');

        $lastSerialNumber = LiqourApplication::orderBy('id','desc')->limit(1)->get();
        // dd($lastSerialNumber);

        if($lastSerialNumber->count()>0){

            $nextSerialNumber=$lastSerialNumber[0]->serial_number+1;

        }else{

            $nextSerialNumber='00001';

        }



       

        // // Get the next serial number

        $nextSerialNumber = str_pad((int)$nextSerialNumber, 5, '0', STR_PAD_LEFT);

        // dd($lastSerialNumber,$nextSerialNumber);

        // // Check if the next serial number is the same as the last one

        // if ($nextSerialNumber == $lastSerialNumber) {

        //     // If they are the same, increment the next serial number again

        //     $nextSerialNumber = str_pad((int)$lastSerialNumber + 2, 4, '0', STR_PAD_LEFT);

        // }

        return $nextSerialNumber;

    }

    

    // Example usage:

   





    public function liqourApplicationSucess(Request $request)

    {

        try {

            if($request->liqourApplicationId > 0){

                

                $liqour_application_details = $this->liqourapplication->where('user_id',$request->user_id)->find($request->liqourApplicationId);

                

                if (!empty($liqour_application_details)) {

                    return view('liqour.success')->with(['liqour_application_details' => $liqour_application_details]);

                } else {

                    return redirect('liquor/createNewLiqourApplication')->with('error', Config::get('constant.COMMON_TECHNICAL_MESSAGE'));

                }

            } else {

                return redirect('liquor/createNewLiqourApplication')->with('error', Config::get('constant.COMMON_TECHNICAL_MESSAGE'));

            }

        } catch (\Exception $ex) {

            return redirect('liquor/createNewLiqourApplication')->with('error', Config::get('constant.COMMON_TECHNICAL_MESSAGE'));

        }

    }



    public function index()
    {

        $companyList = $this->liqourapplication::select('company_name')->distinct()->pluck('company_name')->toArray();
        $liqourApplicationCount = $this->liqourapplication::count();
		$isActiveStatuses = LiqourApplication::distinct('liqour_applications.is_active')
                                     ->pluck('liqour_applications.is_active')
                                     ->map(function ($status) {
                                         return $status == 1 ? 'Active' : 'Inactive';
                                     });

        if(request()->ajax()) {

            $data=LiqourApplication::orderBy('created_at', 'desc')->select('*');
            $totalRows = $data->count();
            if (request()->has('columns')) {

                $columns = request()->get('columns');

                // Filter by status

                // if (isset($columns[3]['search']['value'])) {

                //     $statusFilter = $this->getVal($columns[3]['search']['value']);
                //     // dump( $statusFilter);
                //     $statusFilter=Helper::getApplicationCode($statusFilter);
                //     // dd($statusFilter);
                //     $data->where('status', $statusFilter);
                // }

                if (isset($columns[9]['search']['value'])) {
                
                    $statusFilter = $this->getVal($columns[9]['search']['value']);
               
                    $statusFilter= $statusFilter == 'Active' ? 1 : 0;
             
                    $data->where('is_active', $statusFilter);

                }



                // Filter by entity

                

            }

            $dataTable = datatables()->of($data);



            // Add global search filter

            $dataTable->filter(function ($query) {

                if (request()->has('search')) {

                    $searchTerm = request()->get('search')['value'];



                    $query->where(function ($subQuery) use ($searchTerm) {

                        foreach ($subQuery->getModel()->getFillable() as $column) {
                            
                            if ($column === 'first_name' || $column === 'last_name') {
                                $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            }
                            elseif ($column == 'is_active') {
                                if($searchTerm == 'Active')
                                {
                                    
                                    $subQuery->orWhereRaw("is_active LIKE ?", ["%{$searchTerm}%"]);
                                }
                                else
                                {
                                    $subQuery->orWhereRaw("is_active LIKE ?", ["%{$searchTerm}%"]);
                                }
                                # code...
                            } else {
                                $subQuery->orWhere($column, 'like', "%{$searchTerm}%");
                            }
                            // $subQuery->orWhere($column, 'like', "%{$searchTerm}%");

                        }

                    });

                }

            });

            $pageNumber = request()->has('start') ? (request()->get('start') / request()->get('length')) + 1 : 1;
            $startingIndex = $totalRows - (($pageNumber - 1) * request()->get('length'));

            return $dataTable->addColumn('company_name', function($row){

                return $row->company_name;

            })
           

            ->addColumn('designation', function($row){

                return $row->designation;

            })
            ->addColumn('count', function($row) use ($startingIndex) {
                static $rowNumber = 0; // Initialize the row number
                $rowNumber++;
                return $startingIndex - $rowNumber + 1; // Subtract each row number from starting index
            })

            ->addColumn('mobile_number', function($row){

                return $row->mobile_number;

            })

            ->addColumn('issue_date', function($row){

                return date('d-m-Y',strtotime($row->created_at));

            })

            ->addColumn('expiry_date', function($row){

                return date('d-m-Y',strtotime($row->expire_date));

            })

            ->addColumn('scan_count', function($row){

                return $row->scan_count;

            })

            ->addColumn('name', function($row){

                return $row->getFullNameAttribute();

            })
            ->addColumn('is_active', function($row){

                return $row->is_active == 1 ? 'Active' : 'Inactive' ;

            })
            ->addColumn('action', 'company-action')

            ->addColumn('action', function($row){

                

                $btn = '';

                $isActiveLabel = $row->is_active == 1 ? 'Inactive' : 'Active';

                $btn = $btn.'<a class="edit-role edit_form btn btn-sm btn-success btn-icon mr-1 white" href="'.url("liqour/liqourApplication/".$row->id).'" data-name="'.$row->name.'" data-id='.$row->id.' title="Edit"><i class="fa fa-edit"></i></a>';

                

                $btn = $btn . '<a onclick="liqourApplicationStatusChange(' . $row->id . ',' . ($row->is_active == 1 ? '0' : '1') . ')" class="btn btn-warning btn-sm mr-1 white" href="javascript:;" title="Edit">' . $isActiveLabel . '</a>';





                // if(Auth::user()->can('edit.role')){

                    // $btn = $row->expire_date.'<br>'.date('Y-m-d');

                    if(strtotime($row->expire_date) < strtotime(date('Y-m-d'))){

                        $btn = $btn.'<a class="edit-role edit_form btn btn-sm btn-success btn-icon mr-1 white" href="'.url("liqour/liqourApplication/".$row->id).'" data-name="'.$row->name.'" data-id='.$row->id.' title="Renew">Renew</a>';

                    }



                // }

                // $btn = $btn.'<button type="submit" class=" btn-danger delete-role" data-id="'.$row->id.'"><i class="fa fa-trash-o"></i>';

                // if(Auth::user()->can('delete.role')){

                    $btn = $btn.'<a class="btn btn-sm btn-icon btn-danger mr-1 white delete-liqour-application" data-id="'.$row->id.'" title="Delete"> <i class="fa fa-trash fa-1x"></i> </a>';

                // }

                if($row->is_active == 1)

                {

                    $btn = $btn.'<a onclick="getLiqourApplicationGeneratedCard('.$row->id.')" class="btn btn-sm btn-success btn-icon mr-1 white" href="javascript:;" title="Edit">PDF</a>';



                    $btn = $btn.'<a onclick="printCard('.$row->id.')" class="btn btn-sm btn-success btn-icon mr-1 white" href="javascript:;" title="Edit">Print</a>';

                }

                



               

                return $btn;

            })
            ->addIndexColumn()

            ->make(true);

        }



       

      

        return view('liqour.index',compact('companyList','liqourApplicationCount','isActiveStatuses'));

    }



    public function liqourExportData(){

        // $data = [

        //     [

        //         'name' => 'Povilas',

        //         'surname' => 'Korop',

        //         'email' => 'povilas@laraveldaily.com',

        //         'twitter' => '@povilaskorop'

        //     ],

        //     [

        //         'name' => 'Taylor',

        //         'surname' => 'Otwell',

        //         'email' => 'taylor@laravel.com',

        //         'twitter' => '@taylorotwell'

        //     ]

        // ];

        // return Excel::download(new ExportLiqourApp($data), 'liqour.xlsx');

    }



    public function deleteLiqourApplication(Request $request)

    {

        // dd($request->all());

        $liqourApplicationDelete = LiqourApplication::find($request->id)->delete();

        if($liqourApplicationDelete)

        {

            return response()->json(['msg' => 'Application deleted successfully!']);

        }



        return response()->json(['msg' => 'Something went wrong, Please try again'],500);

    }



    



    public function getLiqourApplicationDetail($id)

    {

        

        $ApplicationDetailData = LiqourApplication::where('id',$id)->first();

        if(!empty($ApplicationDetailData))

        {

            return view('liqour.create-new-liqour-application',compact('ApplicationDetailData'))->with([]);

        }

        else

        {

            return view('liqour.index')->with([]);

        }

    }



    public function liqourApplicationGenerateCardToPrint(request $request){

        $liqourApplicationId= $request->id;

        $row                = LiqourApplication::select('*')->where('id',$liqourApplicationId)->first();

        

        return view('pdfview.liqour-card-print',['row'=>$row]);



    }



    public function liqourApplicationGenerateCardToPdf(request $request)

    {
       
        $fontDirectories = [

            base_path('resources/fonts'),

        ];



        $defaultConfig = (new ConfigVariables())->getDefaults();

        $fontConfig = (new FontVariables())->getDefaults();

        // $existingFontDirectories = $fontConfig['fontDir'];

        $allFontDirectories = $fontDirectories;



        $fontData = [

            // Existing font entries...

            // Add DM Sans font family

            'dm_sans' => [

                'R' => 'DMSans-Regular.ttf',       // Regular font

                'B' => 'DMSans-Bold.ttf',          // Bold font

                'I' => 'DMSans-Italic.ttf',        // Italic font

                'BI' => 'DMSans-BoldItalic.ttf',   // Bold Italic font

            ],

        ];

        $fontConfig['fontdata'] = $fontData;



        // dd($request->all());

        $liqourApplicationId= $request->id;

        $row                = LiqourApplication::select('*')->where('id',$liqourApplicationId)->first();

        

            $row->name = $row->first_name.' '.$row->last_name;
      
            // $mpdf           = new Mpdf(['format' => [85, 54],'margin_left' => 1,'margin_right' => 1,'margin_top' => 1,'margin_bottom' => 1 ,'fontDir' => $allFontDirectories, 'fontdata' => $fontConfig['fontdata']]);

            

            $mpdf           = new Mpdf(['format' => [85, 54],'margin_left' => 1,'margin_right' => 1,'margin_top' => 1,'margin_bottom' => 1 ,'fontDir' => $allFontDirectories, 'fontdata' => $fontConfig['fontdata'],'dpi'=>60]);

            $html = '';

            

            // $html .= $this->generateIdCardHtml($FetchApplicationDetails);

          

            $html   .= view('pdfview.liqour-front',compact('row'))->render();

            

            $html   .= view('pdfview.liqour-back',compact('row'))->render();

            // echo $html;exit();

            $mpdf->WriteHTML($html);

          

            $mpdf->keep_table_proportions = true;

            $mpdf->shrink_tables_to_fit = 1;

            

            $pdfPath = public_path('pdfs/liqour/liqour-card-generated.pdf');



            // Output the PDF to the specified file path

            $mpdf->Output($pdfPath, 'F');

        

            return response()->json(['pdfPath' => $pdfPath, 'message' => 'PDF generated successfully']);

       

    }



    public function liqourQrEntityApplicationScanDataView($liqourApplicationId)

    {



        /*$fontDirectories = [

            base_path('resources/fonts'),

        ];



        $defaultConfig = (new ConfigVariables())->getDefaults();

        $fontConfig = (new FontVariables())->getDefaults();

        // $existingFontDirectories = $fontConfig['fontDir'];

        $allFontDirectories = $fontDirectories;



        $fontData = [

            // Existing font entries...

            // Add DM Sans font family

            'dm_sans' => [

                'R' => 'DMSans-Regular.ttf',       // Regular font

                'B' => 'DMSans-Bold.ttf',          // Bold font

                'I' => 'DMSans-Italic.ttf',        // Italic font

                'BI' => 'DMSans-BoldItalic.ttf',   // Bold Italic font

            ],

        ];

        

        $fontConfig['fontdata'] = $fontData;





        $liqourApplicationId= decrypt($liqourApplicationId);

        // $row                = LiqourApplication::select('*')->where('id',$liqourApplicationId)->first();

        // $row->name = $row->first_name.' '.$row->last_name;

        $liqourApplicationData = LiqourApplication::find($liqourApplicationId);

        

        Log::info('Before saving scan_count: ' . ($liqourApplicationData->scan_count ?? 0));



        // Increment the scan_count

        $liqourApplicationData->scan_count = ($liqourApplicationData->scan_count ?? 0) + 1;

    

        // Log after updating

        Log::info('After incrementing scan_count: ' . $liqourApplicationData->scan_count);

    

        // Save the changes

        $liqourApplicationData->save();

    

        // Log after saving

        Log::info('After saving scan_count: ' . $liqourApplicationData->scan_count);

        $liqourApplicationData->name = $liqourApplicationData->first_name.' '.$liqourApplicationData->last_name;

            $directory      = public_path('pdfs');

           

            $mpdf           = new Mpdf(['format' => 'A4-P', 'fontDir' => $allFontDirectories, 'fontdata' => $fontConfig['fontdata']]);

            $cardsPerRow    = 1; // Change this to the desired number of cards per row

            $verticalSpace  = 10;

            // $cardsPerColumn = count($FetchApplicationDetails) / $cardsPerRow;

            //dd($cardsPerColumn);

            $cardWidth  = 60; // Adjust as needed

            $cardHeight = 70; // Adjust as needed

            $marginX    = 0; // Adjust as needed

            $marginY    = 0;

            $html       = '';

            

            $row=$liqourApplicationData;

            // $html .= $this->generateIdCardHtml($FetchApplicationDetails);

            $html   .= '<div class="d-flex m-auto " style="gap:10px;">';

            $html   .= view('pdfview.liqour-card-view',compact('row'))->render();

            $html   .= '</div>';

            // echo $html;

            $mpdf->WriteHTML($html);



            return $html;*/
            $liqourApplicationId= decrypt($liqourApplicationId);
            $row                = LiqourApplication::select('*')->where('id',$liqourApplicationId)->first();
            // $html       = '';
            // $html   .= '<div class="row" style="align-self:center;gap: 20px;">';

            // $html   .= view('pdfview.liqour-card-print',compact('row'))->render();

            // $html   .= '</div>';

        
            // return $html;
        

        return view('pdfview.liqour-card-print',['row'=>$row]);

    }



     public function liqourApplicationStatusChange(request $request)

     {

        try {

            $statusChange = $this->liqourapplication::findOrFail($request->id);            

            $statusChange->is_active = $request->is_active;

            $statusChange->save();



            return response()->json(['result' => true, 'message' => 'Liqour Application\'s status changed successfully', 'liqourApplicationData' => $statusChange]);

        } catch (\Throwable $th) {

          

            return response()->json(['result' => false, 'message' => 'Something Went wrong. Try again!']);

        }

     }

    public function liqourApplicationDataFilterForm(request $request)
    {
        // dd($request->all());
        $dateRange = $request->liqour_filter_datarange;
        $dateParts = explode(" - ", $dateRange);
        if (count($dateParts) == 2) {
            $startDate = date('Y-m-d',strtotime($dateParts[0]));
            $endDate = date('Y-m-d',strtotime($dateParts[1]));
            $company = $request->liqour_filter_company;
           if($company == 0)
           {
                $data= $this->liqourapplication::select('*')  ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)->orderBy('created_at', 'desc')->get();
            
           }
           else
           {
                $data= $this->liqourapplication::select('*')  ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)->where('company_name', $company)->orderBy('created_at', 'desc')->get();
            
           }

           
            $responseArray = array();
            if ($data->isEmpty()) {
              
                return response()->json(['result' => false, 'message' => 'No data found!']);
            }
            else{
                $formattedData = [];
                foreach ($data as $row) {
                    
                    $formattedData[] = [
                        'application_number' => $row->application_number,
                        'serial_number' => $row->serial_number,
                        'name' => $row->first_name.' '.$row->last_name,
                        'company_name' => $row->company_name,
                        'designation' => $row->designation,
                        'mobile_number' => $row->mobile_number,
                        'scan_count' => (string) $row->scan_count, // Cast to string
                        'issue_date' => date('d-m-Y',strtotime($row->created_at)),
                        'expiry_date' => date('d-m-Y',strtotime($row->expire_date)),
                        'status'      => $row->is_active == 1 ? 'Active' : 'Inactive'
                    ];
                }
                // dd($formattedData);
                $excelData = Excel::raw(new ExportLiqourApp(collect($formattedData)), \Maatwebsite\Excel\Excel::XLSX);
                $base64Excel = base64_encode($excelData);
               
                $responseArray['status'] = false;
                $responseArray['message'] = 'Data found successfully';
                $responseArray['data'] = $base64Excel;
                // If no data found, return a failed response
                return response()->json(['result' => true, 'message' => 'Liqour Application\'s status changed successfully', 'liqourApplicationData' => $responseArray]);
            }
       
        }

    }

    public function showLiqourLoginForm()
    {
        return view('auth.liqour-login');
    }

    public function getVal($filterVar){

        $filterVar=str_replace('$','',$filterVar);

        $filterVar = str_replace('^', '', $filterVar);

        return $filterVar;

    }

    public function liqourGeneratePdf(request $request)
    {
        
        // Your PDF generation logic here
        $selectedIds = request('selectedIds'); // Replace this with your actual selected IDs
        // dd($selectedIds);
        $FetchApplicationDetails = LiqourApplication::
        select('liqour_applications.*')->whereIn('liqour_applications.id', $selectedIds)->get();

        $directory = public_path('pdfs');
        if (!is_dir($directory)) {
            mkdir($directory);
        }

        $defaultConfig = (new ConfigVariables())->getDefaults();

        $fontConfig = (new FontVariables())->getDefaults();

        // $existingFontDirectories = $fontConfig['fontDir'];
        $fontDirectories = [

            base_path('resources/fonts'),

        ];
        $allFontDirectories = $fontDirectories;



        $fontData = [

            // Existing font entries...

            // Add DM Sans font family

            'dm_sans' => [

                'R' => 'DMSans-Regular.ttf',       // Regular font

                'B' => 'DMSans-Bold.ttf',          // Bold font

                'I' => 'DMSans-Italic.ttf',        // Italic font

                'BI' => 'DMSans-BoldItalic.ttf',   // Bold Italic font

            ],

        ];

        $fontConfig['fontdata'] = $fontData;

        $mpdf           = new Mpdf(['format' => [85, 54],'margin_left' => 1,'margin_right' => 1,'margin_top' => 1,'margin_bottom' => 1 ,'fontDir' => $allFontDirectories, 'fontdata' => $fontConfig['fontdata'],'dpi'=>60]);
        $cardsPerRow = 1; // Change this to the desired number of cards per row
        $verticalSpace = 10;
        $cardsPerColumn = count($FetchApplicationDetails) / $cardsPerRow;

        $cardWidth = 60; // Adjust as needed
        $cardHeight = 70; // Adjust as needed
        $marginX = 0; // Adjust as needed
        $marginY = 0;
        $html = '';
        
        foreach ($FetchApplicationDetails as $index => $row) {
            $row->name = $row->first_name.' '.$row->last_name;
            $html = '';
        
            $html .= view('pdfview.liqour-front', compact('row'))->render();
            $mpdf->WriteHTML($html);
            $mpdf->AddPage();
            
            $html = '';
            $html .= view('pdfview.liqour-back', compact('row'))->render();
            $mpdf->WriteHTML($html);
        
            // Check if this is not the last row
            if ($index < count($FetchApplicationDetails) - 1) {
                $mpdf->AddPage();
            }
        }
        
        // $mpdf->WriteHTML($html);
        

        // Save the PDF to a file (optional)
        // $filename = 'generated.pdf'; // Set your desired filename
        // $response = response($mpdf->Output($filename, 'S'))
        //     ->header('Content-Type', 'application/pdf');
        $pdfPath = public_path('pdfs/liqour/liqour-card-generated.pdf');
        $mpdf->Output($pdfPath, 'F');
        return response()->json(['pdfPath' => $pdfPath]);
    }
}

