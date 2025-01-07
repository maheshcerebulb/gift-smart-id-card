<?php



namespace App\Http\Controllers;



use App\Exports\ExportBuidlingCompanyApp;
use App\Models\EntityApplication;

use App\Models\Group;

use App\Models\User;

use App\Models\TemporaryEntity;

use App\Models\Company;

use App\Models\Address;

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

use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

use Helper;
use Log;

class UserController extends Controller

{

    /**

     * Create a new controller instance.

     */

    public function __construct()
    {

        $this->user = new User();

        $this->group = new Group();

        $this->temporary_entity = new TemporaryEntity();

        $this->entity_application = new EntityApplication();

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {



    }



    /**

     * Ajax for validate user email address by check unique

     */

    public function validateUserEmail(Request $request){

        if($request->ajax()){

            $email = $request->email;

            $userDetail = $this->user->where('email', $email);

            if(isset($request->userId) && !empty($request->userId)){

                $userDetail->where('id', '!=', $request->userId);

            }

            $userDetail = $userDetail->first();

            if(!empty($userDetail)){

                return response()->json(['isExist' => 'Yes']);

            } else {

                return response()->json(['isExist' => 'No']);

            }

        }

    }



    public function register(){

        # Get country list

        $country_lists = DB::table('countries')->where('is_active', 'Y')->pluck('name', 'id')->all();

        $company_address = Address::get();

        return view('register.index')->with(['country_lists' => $country_lists, 'company_address' => $company_address]);

    }



    public function registerSuccess(Request $request)

    {

        try {

            if($request->user_id > 0){

                $user_details = $this->user->find($request->user_id);

                if (!empty($user_details)) {

                    return view('register.success')->with(['user_details' => $user_details]);

                } else {

                    return redirect('register')->with('error', Config::get('constant.COMMON_TECHNICAL_MESSAGE'));

                }

            } else {

                return redirect('register')->with('error', Config::get('constant.COMMON_TECHNICAL_MESSAGE'));

            }

        } catch (\Exception $ex) {

            return redirect('register')->with('error', Config::get('constant.COMMON_TECHNICAL_MESSAGE'));

        }

    }



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     * function for login view

     */

    public function login(){

        
        return view('users.login');

    }



    /**

     * @param Request $request

     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse

     * Function for create login

     */

    public function validateLogin(Request $request)

    {

        if ($request->isMethod('post')) {

            $userData = array(

                'email' => $request->email,

                'password' => $request->password,

				'is_active' => 'Y',

                'is_deleted' => 'N',

            );

            if(Auth::attempt($userData)) {

                $userDetail = $this->user->where('email', $request->email)->first();

                # Write user session detail

                Session::put('User.id', $userDetail->id);

                if(!empty($userDetail->name))

                {

                    Session::put('User.name', $userDetail->name);

                }

                else if(!empty($userDetail->company_name))

                {

                    Session::put('User.name', $userDetail->company_name);

                }



                if($userDetail->group_id == 3 && $userDetail->first_time_login == 'Y')

                {

                    $redirected_on = url('/').'/users/changePassword?redirect=welcome';

                }

                else

                {

                    $redirected_on = url('/').'/welcome';

                }



                Session::put('User.email', $userDetail->email);

                Session::put('User.userGroup', $userDetail->group_id);

                return response()->json(['result' => true, 'isValid' => 'Yes', 'redirectOn' => $redirected_on]);

            } else {

                # Find user exist or not

                $userDetail = DB::table('users')->where('email', $request->email)->first();



                if(!empty($userDetail)){

                    if($userDetail->is_active != 'Y'){

                        return response()->json(['result' => false, 'isValid' => 'No', 'message' => 'Your account is inactive.']);

                    } else {

                        return response()->json(['result' => false, 'isValid' => 'No', 'message' => trans('Incorrect password. Please try again.')]);

                    }

                } else {

                    return response()->json(['result' => false, 'isValid' => 'No', 'message' => trans('Incorrect username. Please try again.')]);

                }

            }

        }

    }



    public function profile(){

        $userDetails = Auth::user();

        $userDetails = $userDetails->toArray();



        return view('users.profile', compact('userDetails'));

    }



    public function changePassword(Request $request)

    {

        try {

            $userDetails = Auth::user();



            $redirect_on = '';



            if(isset($request->redirect))

            {

                $redirect_on = $request->redirect;

            }

            if($request->isMethod('post')) {

                try {

                    if (!empty($request->password)) {

                        $rules['old_password'] = 'required|current_password';

                        $rules["password"] = 'required|min:6|confirmed';

                    }

                    $validator = Validator::make($request->all(), $rules);

                    if($validator->fails()) {

                        return redirect()->back()->withErrors($validator);

                    } else {

                        if (!empty($request->password)) {

                            $userDetails->first_time_login = "N";
							
							$userDetails->base_password = base64_encode($request->password);

                            $userDetails->password = bcrypt($request->password);

                        }

                        $userDetails->save();

                        if (!empty($request->redirect_on)) {

                            return redirect('/');

                        } else  {

                            return redirect()->back()->with('success','Your password has been updated');

                        }

                    }

                } catch (\Exception $ex) {

                    return redirect()->back()->with('error', 'There is some problem. Please try again!');

                }

            }

            $userDetails = $userDetails->toArray();

            return view('users.change-password', compact('userDetails', 'redirect_on'));

        } catch (\Exception $e) {

            return redirect('welcome');

        }

    }



     /**

     * Welcome page

     *

     * @return \Illuminate\Http\Response

     */

    public function welcome()

    {
        $userId=Auth::id();

        // dd(Auth::user()->roles->pluck('name'));

        $userDetails = User::where('id', $userId)->first();

        $role = $userDetails->getRoleNames()->first();

        $filterCompanyData=EntityApplication::filterBaseCompanyData('0');

        $recentEntityApplicationData = $this->entity_application;

        // Redirect based on the user's role

        if ($role === 'Admin') {

            $recentEntityApplicationData = $recentEntityApplicationData::getTableDataWithEntity();

            return view('users.dashboard-admin', compact('userDetails','recentEntityApplicationData'));

        } elseif ($role === 'Super Admin') {

            $addressData=Address::where('status',1)->get();
            $buildingList=Address::where('status',1)->pluck('address');
            $companyList = Company::pluck('name');
            return view('users.dashboard-su-admin', compact('userDetails','addressData','companyList','buildingList','filterCompanyData'));

        }  elseif ($role === 'Data Entry') {

            $addressData=Address::where('status',1)->get();

            return view('users.dashboard-data-entry-admin', compact('userDetails','addressData'));

        } elseif ($role === 'Sub Admin') {
            $recentEntityApplicationData = $recentEntityApplicationData::getTableDataWithEntity();

            $addressData=Address::where('status',1)->get();

            return view('users.dashboard-admin', compact('userDetails','recentEntityApplicationData'));

        }else {

            $recentEntityApplicationData = $recentEntityApplicationData::where('user_id',$userId)->where('is_deleted','No')->latest()->take(5)->get();
            if ( $userDetails->first_time_login=='Y' ) {// do your magic here
                return redirect()->route('users.change-password');
            }
           
            return view('users.dashboard-entity', compact('userDetails','recentEntityApplicationData'));

        }

    }



    public function dashboard() {

        $userId=Auth::id();

        return view('users.dashboard-admin', compact('userDetails'));

    }



    public function updateEntityProfile (Request $request)

    {

        $error_message = array();

        # Perform basic validation

        $userDetail = $this->user->where('email', $request->email);

        if(isset($request->id) && !empty($request->id)){

            $userDetail->where('id', '!=', $request->id);

        }

        $userDetail = $userDetail->first();

        if(!empty($userDetail)){

            $error_message[] = 'Entity is already registered with added email address.';

        }

        if(empty($error_message))

        {

            $save_data = array();

            $not_include_column = array('id', 'created_at', 'updated_at');

            $company_email = '';

            $updateValue = array();

            $input = $request->all();

            unset($input['_token']);

            unset($input['id']);

            foreach($input as $fieldName => $fieldValue){

                $updateValue[$fieldName] = $fieldValue;

            }

            $this->user->where('id', $request->id)->update($updateValue);

            return redirect()->back()->with('success','Your profile has been updated');

        }

        else

        {

            return redirect()->back()->withInput($request->all())->with('error', implode("<br>", $error_message));

        }

    }



    public function dashboardHtml()

    {

        try {

            return view('users.welcome-html');

        } catch (\Exception $e) {

            return redirect('login');

        }

    }



    /**

     * user logout action.

     * @return \Illuminate\Http\Response

     */

    public function logout(Request $request){

        Auth::logout();

        $request->session()->forget('User');

        return redirect('login');

    }



    /**

     * Forgot password action

     * @param Request $request

     * @return $this|\Illuminate\Http\RedirectResponse

     */

    public function forgotPassword(Request $request){

        try {

            if ($request->isMethod('post')) {

                $userDetail = DB::table('users')->where('email', $request->email)->first();

                if(!empty($userDetail)){

                    if($userDetail->is_active == 'Yes'){

                        $newPassword = substr(md5(rand().rand()), 0, 8);



                        # Update Data

                        $updateData = array('password' => bcrypt($newPassword));

                        $updateUserQuery = User::find($userDetail->id);

                        $updateUserQuery->update($updateData);



                        $mailData = array('email' => $userDetail->email, 'password' => $newPassword, 'mailType' => 'forgotPassword');

                        # Send email

                        Mail::to($userDetail->email)->send(new SendMailable($mailData));

                        return response()->json(['result' => true, 'message' => 'Password has been sent to your email address']);

                    } else {

                        return response()->json(['result' => false, 'message' => 'Your account has been deactivated by admin']);

                    }

                } else {
                    
                    return response()->json(['result' => false, 'message' => 'Email address does not exist']);

                }

            }

        } catch (\Exception $ex) {

            return response()->json(['result' => false, 'message' => $ex->getMessage()]);

            //return response()->json(['result' => 'Error', 'message' => trans('messages.error.general.common')]);

        }

    }



    public function checkEntityEmailUnique(Request $request)

    {

        $email_address = $request->email;

        $userDetail = User::where('is_deleted', 'N')->where('email', $email_address);

        if(isset($request->userId) && !empty($request->userId)){

            $userDetail->where('id', '!=', $request->userId);

        }

        $userDetails = $userDetail->first();



        if(!empty($userDetails)){

            return response()->json(['valid' => false]);

        } else {

            return response()->json(['valid' => true]);

        }

    }



    public function saveBasicEntityDetail(Request $request)

    {

        try {

            $input = $request->all();
			Log::channel("entity-registration")->info(
                "Time: " .
                    date("Y-m-d H:i:s") .
                    "Request Data : ".json_encode($request->all()). "/n/n"
            );
            if($request->id > 0){

                $temporaryEntityDetail = $this->temporary_entity->find($request->id);

                if (empty($temporaryEntityDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'isPageRefresh' => true]);

                } else {

                    $updateValue = array();

                    unset($input['_token']);

                    unset($input['id']);

                    unset($input['is_entity_detail_valid']);

                    foreach($input as $fieldName => $fieldValue){

                        $updateValue[$fieldName] = $fieldValue;

                    }

                    $this->temporary_entity->where('id', $request->id)->update($updateValue);

                    return response()->json(['result' => true, 'message' => 'Entity details have been updated successfully']);

                }

            } else {
				
                unset($input['id']);
				
                $tempRegisterEntityDetail = $this->temporary_entity->create($input);
					Log::channel("entity-registration")->info(
                    "Time: " .
                        date("Y-m-d H:i:s") .
                        "Request Data : ".json_encode($request->all()). "/n/n/Response Data:".$tempRegisterEntityDetail."/n"
                );
                return response()->json(['result' => true, 'message' => 'Entity details have been added successfully', 'entityId' => $tempRegisterEntityDetail->id]);

            }

        } catch (\Exception $ex) {
			
			Log::channel("entity-registration")->info(
                "Time: " .
                    date("Y-m-d H:i:s") .
                    "Request Data : ".json_encode($request). "/n/n/Response Data:".$ex->getMessage()."/n"
            );
            return response(['result' => false, 'message' => $ex->getMessage()]);

        }

    }



    public function saveEntityAuthorizedPersonDetail(Request $request)

    {

        try {

            $input = $request->all();

            if($request->id > 0){

                $temporaryEntityDetail = $this->temporary_entity->find($request->id);

                if (empty($temporaryEntityDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'redirectPage' => route('users.register')]);

                } else {

                    $updateValue = array();

                    unset($input['_token']);

                    unset($input['id']);

                    unset($input['is_entity_authorized_person_detail_valid']);

                    unset($input['entity_authorized_person_support_document_hidden']);

                    unset($input['entity_authorized_person_signature_hidden']);

                    foreach($input as $fieldName => $fieldValue){

                        $updateValue[$fieldName] = $fieldValue;

                    }

                    $this->temporary_entity->where('id', $request->id)->update($updateValue);

                    return response()->json(['result' => true, 'message' => 'Authorized person\'s details have been added successfully']);

                }

            } else {

                return response()->json(['result' => false, 'message' => 'Entity details not saved. Please save it first']);

            }

        } catch (\Exception $ex) {

            return response(['result' => false, 'message' => $ex->getMessage()]);

        }

    }



    public function uploadEntityAuthorizedPersonSupportDocument(Request $request)

    {

        try {

            $temp_entity_id = $request->temp_entity_id;

            $fileDir = config('constant.ENTITY_DOCUMENT_TEMP_PATH');

            $filePath = public_path('upload').DIRECTORY_SEPARATOR.$fileDir;

            $tempFile = $_FILES['file']['tmp_name'][0];

            $ext = pathinfo($_FILES['file']['name'][0], PATHINFO_EXTENSION);

            $fileName = $temp_entity_id.'-support-document'.'.'.$ext;



            if(file_exists($filePath.$fileName))

            {

                unlink($filePath.$fileName);

            }

            if(move_uploaded_file($tempFile, $filePath.$fileName))

            {

                $this->temporary_entity->where('id', $temp_entity_id)->update(['authorized_person_support_document' => $fileName]);

                return response()->json(['result' => true, 'file_name' => $fileName]);

            }

            else

            {

                return response()->json(['message' => 'There is some issue in file upload. Please try again!', 'status' => 'error'], 422);

            }

        }

        catch (\Illuminate\Validation\ValidationException $validationException) {

            $errors = $validationException->validator->errors();

            $errorMessage = implode('<br>', $errors->all());

            return response()->json(['message' => $errorMessage, 'status' => 'error'], 422);

        }

        catch (\Exception $exception) {

            // Handle other exceptions, if any

            $message = $exception->getMessage();

            //$message = 'There is some problem. Please try again!';

            return response()->json(['message' => $message, 'status' => 'error'], 500);

        }

    }



    public function removeEntityAuthorizedPersonSupportDocument(Request $request)

    {

        try {

            $temp_entity_id = $request->temp_entity_id;

            $added_file_name = $request->file_name;



            if(!empty($added_file_name))

            {

                $fileDir = config('constant.ENTITY_DOCUMENT_TEMP_PATH');

                $filePath = public_path('upload').DIRECTORY_SEPARATOR.$fileDir;

                if(file_exists($filePath.$added_file_name))

                {

                    $this->temporary_entity->where('id', $temp_entity_id)->update(['authorized_person_support_document' => '']);

                    unlink($filePath.$added_file_name);

                    return response()->json(['result' => true]);

                }

                else

                {

                    return response()->json(['result' => false, 'message' => 'File not found.']);

                }

            }

            else

            {

                return response()->json(['result' => false, 'message' => 'File not found.']);

            }

        }

        catch (\Exception $exception) {

            // Handle other exceptions, if any

            return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!']);

        }

    }



    public function uploadEntityAuthorizedPersonSignature(Request $request)

    {

        try {

            $temp_entity_id = $request->temp_entity_id;

            $fileDir = config('constant.ENTITY_DOCUMENT_TEMP_PATH');

            $filePath = public_path('upload').DIRECTORY_SEPARATOR.$fileDir;

            $tempFile = $_FILES['file']['tmp_name'][0];

            $ext = pathinfo($_FILES['file']['name'][0], PATHINFO_EXTENSION);

            $fileName = $temp_entity_id.'-signature'.'.'.$ext;



            if(file_exists($filePath.$fileName))

            {

                unlink($filePath.$fileName);

            }

            if(move_uploaded_file($tempFile, $filePath.$fileName))

            {

                $this->temporary_entity->where('id', $temp_entity_id)->update(['authorized_person_signature' => $fileName]);

                return response()->json(['result' => true, 'file_name' => $fileName]);

            }

            else

            {

                return response()->json(['message' => 'There is some issue in file upload. Please try again!', 'status' => 'error'], 422);

            }

        }

        catch (\Illuminate\Validation\ValidationException $validationException) {

            $errors = $validationException->validator->errors();

            $errorMessage = implode('<br>', $errors->all());

            return response()->json(['message' => $errorMessage, 'status' => 'error'], 422);

        }

        catch (\Exception $exception) {

            // Handle other exceptions, if any

            $message = $exception->getMessage();

            //$message = 'There is some problem. Please try again!';

            return response()->json(['message' => $message, 'status' => 'error'], 500);

        }

    }



    public function removeEntityAuthorizedPersonSignature(Request $request)

    {

        try {

            $temp_entity_id = $request->temp_entity_id;

            $added_file_name = $request->file_name;



            if(!empty($added_file_name))

            {

                $fileDir = config('constant.ENTITY_DOCUMENT_TEMP_PATH');

                $filePath = public_path('upload').DIRECTORY_SEPARATOR.$fileDir;

                if(file_exists($filePath.$added_file_name))

                {

                    $this->temporary_entity->where('id', $temp_entity_id)->update(['authorized_person_signature' => '']);

                    unlink($filePath.$added_file_name);

                    return response()->json(['result' => true]);

                }

                else

                {

                    return response()->json(['result' => false, 'message' => 'File not found.']);

                }

            }

            else

            {

                return response()->json(['result' => false, 'message' => 'File not found.']);

            }

        }

        catch (\Exception $exception) {

            // Handle other exceptions, if any

            return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!']);

        }

    }



    public function getEntityDetailForFinalStepOnRegister(Request $request)

    {

        try {

            $input = $request->all();

            if($request->id > 0){

                $temporaryEntityDetail = $this->temporary_entity->find($request->id);

                if (empty($temporaryEntityDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'redirectPage' => route('users.register')]);

                } else {



                    $authorized_signatory_name = $temporaryEntityDetail->authorized_person_first_name;

                    if(!empty($temporaryEntityDetail->authorized_person_last_name))

                    {

                        $authorized_signatory_name  .= " ".$temporaryEntityDetail->authorized_person_last_name;

                    }

                    return response()->json([

                        'result' => true,

                        'authorized_signatory_name' => $authorized_signatory_name,

                        'place' => $temporaryEntityDetail->company_city,

                        'authorized_person_designation' => $temporaryEntityDetail->authorized_person_designation,

                    ]);

                }

            } else {

                return response()->json(['result' => false, 'message' => 'Entity details not saved. Please save it first']);

            }

        } catch (\Exception $ex) {

            return response(['result' => false, 'message' => $ex->getMessage()]);

        }

    }



    public function saveEntityVerifyAndSubmitDetail(Request $request)

    {

        try {

            $input = $request->all();

            if($request->id > 0){

                $temporaryEntityDetail = $this->temporary_entity->find($request->id);

                if (empty($temporaryEntityDetail)) {

                    return response()->json(['result' => false, 'message' => 'There is some problem. Please try again!', 'redirectPage' => route('users.register')]);

                } else {

                    $error_message = array();



                    $companyData=Company::where('application_no',$temporaryEntityDetail->request_id)->first();

                    if ($temporaryEntityDetail->unit_category != 'Other' && empty($companyData)) {
                        $error_message[] = 'The Application No (LOA) is not valid.';
                    }




                    # Perform basic validation

                    $userDetail = $this->user->where('email', $temporaryEntityDetail->email);

                    if(isset($request->userId) && !empty($request->userId)){

                        $userDetail->where('id', '!=', $request->userId);

                    }

                    $userDetail = $userDetail->first();

                    if(!empty($userDetail)){

                       $error_message[] = 'Entity is already registered with added email address.';

                    }



                    



                    if(empty($error_message))

                    {

                        $save_data = array();

                        $not_include_column = array('id', 'created_at', 'updated_at');

                        $company_email = '';



                        $temporaryEntityDetail = $temporaryEntityDetail->toArray();

                        foreach($temporaryEntityDetail as $column_name => $column_data)

                        {

                            if($column_name == 'email') {

                                $company_email = $column_data;

                            }

                            if(!in_array($column_name, $not_include_column)) {

                                $save_data[$column_name] = $column_data;

                            }

                        }



                        // $password           = $this->generateRandomPassword(8); // 13-09-2024
                        $password           = $temporaryEntityDetail['authorized_person_first_name'].'!@#$%^';

                        $application_number = $this->generateApplicationNumber();

                        # Send login data

                        //$mailData = array('email' => $company_email, 'password' => $password, 'mailType' => 'register');

                        # Send email

                        //Mail::to($company_email)->send(new SendMailable($mailData));

                        // $save_data['group_id'] = User::ROLE_COMPANY_ID;

                        $save_data['password'] = bcrypt($password);

                        $save_data['application_number']    = $application_number;

                        $save_data['first_time_login']      = 'Y';

                        $save_data['company_registration_number']      = $save_data['registration_number'];
						
						$save_data['request_number']      = $save_data['request_id'];

                        $userDetail = $this->user->create($save_data);

                        $role = Role::where(['name' => 'Entity'])->first();

                        $userDetail->assignRole([$role->id]);

                        # Send login data
                        $userDetail->normal_password = $password;
                        
                        # Send email
                        $emailData['email']=$userDetail->email;
                        $emailData['data']=$userDetail;
                        $emailData['viewFile']='emails.register';
                        $emailData['mailType']='register';
                        $emailData['subject']='Entity Registration Confirmation';
                        $emailData['errorLogChannel'] = 'entity-registeration';
                        
                        Helper::sendMail($emailData);

                        return response()->json(['result' => true, 'message' => 'Entity details have been saved successfully', 'user_id' => $userDetail->id]);

                    }

                    else

                    {

                        return response()->json(['result' => false, 'message' => implode("<br><br>", $error_message)]);

                    }

                }

            } else {

                return response()->json(['result' => false, 'message' => 'Entity details not saved. Please save it first']);

            }

        } catch (\Exception $ex) {
            
            return response(['result' => false, 'message' => $ex->getMessage()]);

        }

    }



    function generateApplicationNumber() {

        $randomNumber = mt_rand(1000000, 9999999);

        $exists = $this->user->where('application_number', $randomNumber)->exists();



        if ($exists) {

            return $this->generateUniqueRandomNumber();

        }

        // If the number is unique, return it

        return $randomNumber;

    }



    function generateRandomPassword($length = 12) {

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';



        $password = '';



        for ($i = 0; $i < $length; $i++) {

            $password .= $chars[random_int(0, strlen($chars) - 1)];

        }

        return $password;

    }
    function buildingUnitListing($address)
    {
        $unitAddress = $address;
        // dd($unitsdata);
        $BuildingAddress = User::distinct('company_address')->pluck('company_address');
        
        return view('entity.admin-entity-view',compact('BuildingAddress','unitAddress'));
        // return view('users.super-admin-unit-list',compact('unitAddress'));
    }

    function buildingEmployeeListing($address)
    {
        $unitAddress = $address;
        $companiesdata = User::where('company_address',$address)->get();
        $companyIds = $companiesdata->pluck('id');
        $employeesdata = EntityApplication::whereIn('user_id', $companyIds)->where('entity_applications.is_deleted','No')->pluck('id');
        if ($employeesdata->isEmpty()) {
            // If it's empty, manually add 0 to the collection
            $employeesdata = collect([0]);
        }
        $applicationTypes = EntityApplication::select('type')
        ->distinct('type')
        ->pluck('type');
        return view('users.super-admin-employees-list',compact('employeesdata','applicationTypes'));
    }

    function buildingActiveCardListing($address)
    {
        // dd($address);
        $unitAddress = $address;
        $companiesdata = User::where('company_address',$address)->get();
       
        $companyIds = $companiesdata->pluck('id');
        
        $employeesdata = EntityApplication::whereIn('user_id', $companyIds)->whereBetween('status',[200,210])->where('entity_applications.is_deleted','No')->pluck('id');
        if ($employeesdata->isEmpty()) {
            // If it's empty, manually add 0 to the collection
            $employeesdata = collect([0]);
        }
        // dd($employeesdata);
        return view('users.super-admin-active-list',compact('employeesdata'));
    }
    function buildingInActiveCardListing($address)
    {
        $unitAddress = $address;
        $companiesdata = User::where('company_address',$address)->get();
        $companyIds = $companiesdata->pluck('id');
        // dd($companyIds);
        $employeesdata = EntityApplication::WhereIn('user_id', $companyIds)->where('status',[501,502,401])->where('entity_applications.is_deleted','No')->pluck('id');
        if ($employeesdata->isEmpty()) {
            // If it's empty, manually add 0 to the collection
            $employeesdata = collect([0]);
        }
       
        return view('users.super-admin-inactive-list',compact('employeesdata'));
    }

    function fetchUnitList(request $request)
    {
        if(request()->ajax()) {

            $data=User::where('company_address',$request->building)->distinct()->select('unit_category','company_name',DB::raw("CONCAT(authorized_person_first_name,' ',authorized_person_last_name) AS authorized_person_name"),'application_number','authorized_person_mobile_number','email','created_at');

            $dataTable = datatables()->of($data);
            // Add global search filter

            $dataTable->filter(function ($query) {

                if (request()->has('search')) {

                    $searchTerm = request()->get('search')['value'];

                    $query->where(function ($subQuery) use ($searchTerm) {

                        foreach ($subQuery->getModel()->getFillable() as $column) {
                            if($column == 'authorized_person_first_name')
                            {
                                $subQuery->orWhereRaw("CONCAT(authorized_person_first_name, ' ', authorized_person_last_name) LIKE ?", ["%{$searchTerm}%"]);
                            }
                            else
                            {
                                $subQuery->orWhere($column, 'like', "%{$searchTerm}%");

                            }

                        }

                    });

                }

            });



            return $dataTable->addColumn('unit_category', function($row){

                return $row->unit_category;

            })
            ->addColumn('created_at', function($row){

                return date('d-m-Y',strtotime($row->created_at));

            })
            ->addColumn('company_name', function($row){

                return $row->company_name;

            })
            ->addColumn('authorized_person_name', function($row){

                return $row->authorized_person_name;

            })
            ->addColumn('application_number', function($row){

                return $row->application_number;

            })
            ->addColumn('email', function($row){

                return $row->email;

            })
            ->addColumn('authorized_person_mobile_number', function($row){

                return $row->authorized_person_mobile_number;

            })
            ->addColumn('action', function($row){

                // <a id="viewApplication" class="viewApplication btn btn-light btn-lg" data-id="'.$row->id.'">

                //         <span class="mr-5">View Application</span>

                //         <i class="ki ki-long-arrow-next icon-sm"></i>

                //     </a>

                $btn = '<div class="d-flex align-items-center">';        

                $btn .=  '<a id="viewApplication" class="viewApplication btn btn-primary btn-sm"  data-id="'.$row->id.'">

                        <i class="fas fa-eye fa-1x text-green"></i>                        

                    </a>';

                   
                $btn.= '</div>';

                return $btn;

            })->rawColumns(['created_at','status','action'])



            ->addIndexColumn()

            ->make(true);

        }
    }


    function fetchEmployeesList(request $request)
    {
        
        // dd($request->all());
        if(request()->ajax()) {

            $data=EntityApplication::select('entity_applications.first_name','entity_applications.last_name','entity_applications.serial_no','entity_applications.application_type','entity_applications.issue_date','entity_applications.expire_date','entity_applications.status','users.company_name as company_name','entity_applications.email','entity_applications.type','entity_applications.final_special_serial_no')
                                    ->leftJoin('users','users.id','=','entity_applications.user_id')
                                    // ->where('user.company_address',$request->building)
                                    ->whereIn('entity_applications.id',$request->emplyeesIds)
                                    ->where('entity_applications.is_deleted','No')
                                    ->orderBy('entity_applications.serial_no','DESC');
            if (request()->has('columns')) {

                $columns = request()->get('columns');
                // Filter by status

                if (isset($columns[5]['search']['value'])) {
                    $statusFilter = $this->getVal($columns[5]['search']['value']);
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
                            // print_r($column.'...........-..........');
                            // if ($column === 'first_name' || $column === 'last_name') {
                            //     $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            // } else {
                            //     $subQuery->orWhere($column, 'like', "%{$searchTerm}%");
                            // }
                           
                            if ($column === 'first_name' || $column === 'last_name') {
                                $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            }
                            else if ($column == 'user_id') {
                                $subQuery->orwhere('users.company_name', 'like', "%{$searchTerm}%");
                            }
                            else if ($column === 'application_type') {
                                $subQuery->orWhere(function ($typeQuery) use ($searchTerm) {
                                    if ($searchTerm == 'New') {
                                        $typeQuery->where('entity_applications.type', 0);
                                    } elseif ($searchTerm == 'Renew') {
                                        $typeQuery->where('entity_applications.type', 1);
                                    } elseif ($searchTerm == 'Surrender') {
                                        $typeQuery->where('entity_applications.type', 2);
                                    }
                                });
                            }
                            else {
                                $subQuery->orWhere('entity_applications.'.$column, 'like', "%{$searchTerm}%");
                            }
                            
                            // $subQuery->orWhere($column, 'like', "%{$searchTerm}%");

                        }

                    });

                }

            });
           

            return $dataTable->addColumn('user.company_name', function($row){

                return $row->company_name;

            })

            ->addColumn('application_type', function($row){

                if($row->application_type==0){

                    return 'New';

                }elseif($row->application_type==1){

                    return 'Renew';

                }elseif($row->application_type==2){

                    return 'Surrender';

                }else{

                    return '';

                }

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

                if (empty($row->serial_no)) {
                    $row->serial_no = $row->final_special_serial_no;
                } 
                return $row->serial_no;

            })

            ->addColumn('name', function($row){

                return $row->fullname;
            })
            ->addColumn('type', function($row){

                return $row->type;
            })

            ->addColumn('status', function($row){


                return '<span class="label label-lg label-inline ' . Helper::getApplicationStatusBackgroundColor($row->status) . '">' . Helper::getApplicationType($row->status) . '</span>';

            })
            ->addColumn('action', function($row){

                // <a id="viewApplication" class="viewApplication btn btn-light btn-lg" data-id="'.$row->id.'">

                //         <span class="mr-5">View Application</span>

                //         <i class="ki ki-long-arrow-next icon-sm"></i>

                //     </a>

                $btn = '<div class="d-flex align-items-center">';        

                $btn .=  '<a id="viewApplication" class="viewApplication btn btn-primary btn-sm"  data-id="'.$row->id.'">

                        <i class="fas fa-eye fa-1x text-green"></i>                        

                    </a>';

                   
                $btn.= '</div>';

                return $btn;

            })->rawColumns(['status','action'])



            ->addIndexColumn()

            ->make(true);

        }

        return view('users.super-admin-employees-list',compact('applicationTypes'));
    }

    function fetchActiveList(request $request)
    {
      
        if(request()->ajax()) {

            $data=EntityApplication::select('entity_applications.first_name','entity_applications.last_name','entity_applications.serial_no','entity_applications.application_type','entity_applications.issue_date','entity_applications.expire_date','entity_applications.status','users.company_name as company_name','users.email','entity_applications.final_special_serial_no','entity_applications.type')
                                    ->leftJoin('users','users.id','=','entity_applications.user_id')
                                    // ->where('user.company_address',$request->building)
                                    ->where('entity_applications.is_deleted','No')
                                    ->whereIn('entity_applications.id',$request->activeIds);

            $dataTable = datatables()->of($data);
            // Add global search filter
            
            $dataTable->filter(function ($query) {

                if (request()->has('search')) {

                    $searchTerm = request()->get('search')['value'];

                    $query->where(function ($subQuery) use ($searchTerm) {

                        foreach ($subQuery->getModel()->getFillable() as $column) {
                            // print_r($column.'...........-..........');
                            // if ($column === 'first_name' || $column === 'last_name') {
                            //     $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            // } else {
                            //     $subQuery->orWhere($column, 'like', "%{$searchTerm}%");
                            // }
                           
                            if ($column === 'first_name' || $column === 'last_name') {
                                $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            }
                            else if ($column == 'user_id') {
                                $subQuery->orwhere('users.company_name', 'like', "%{$searchTerm}%");
                            }
                            else if ($column === 'type') {
                                $subQuery->orWhere(function ($typeQuery) use ($searchTerm) {
                                    if ($searchTerm == 'New') {
                                        $typeQuery->where('entity_applications.type', 0);
                                    } elseif ($searchTerm == 'Renew') {
                                        $typeQuery->where('entity_applications.type', 1);
                                    } elseif ($searchTerm == 'Surrender') {
                                        $typeQuery->where('entity_applications.type', 2);
                                    }
                                });
                            }
                            else {
                                $subQuery->orWhere('entity_applications.'.$column, 'like', "%{$searchTerm}%");
                            }
                            
                            // $subQuery->orWhere($column, 'like', "%{$searchTerm}%");

                        }

                    });

                }

            });
           

            return $dataTable->addColumn('user.company_name', function($row){

                return $row->company_name;

            })

            ->addColumn('application_type', function($row){

                if($row->application_type==0){

                    return 'New';

                }elseif($row->application_type==1){

                    return 'Renew';

                }elseif($row->application_type==2){

                    return 'Surrender';

                }else{

                    return '';

                }

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

                if (empty($row->serial_no)) {
                    $row->serial_no = $row->final_special_serial_no;
                } 
                return $row->serial_no;

            })

            ->addColumn('name', function($row){

                return $row->fullname;
            })

            ->addColumn('status', function($row){

               

                return '<span class="label label-lg label-inline ' . Helper::getApplicationStatusBackgroundColor($row->status) . '">' . Helper::getApplicationType($row->status) . '</span>';

            })
            ->addColumn('action', function($row){

                // <a id="viewApplication" class="viewApplication btn btn-light btn-lg" data-id="'.$row->id.'">

                //         <span class="mr-5">View Application</span>

                //         <i class="ki ki-long-arrow-next icon-sm"></i>

                //     </a>

                $btn = '<div class="d-flex align-items-center">';        

                $btn .=  '<a id="viewApplication" class="viewApplication btn btn-primary btn-sm"  data-id="'.$row->id.'">
                        <i class="fas fa-eye fa-1x text-green"></i>                        

                    </a>';

                   
                $btn.= '</div>';

                return $btn;

            })->rawColumns(['status','action'])



            ->addIndexColumn()

            ->make(true);

        }
    }

    function fetchInActiveList(request $request)
    {
      
        if(request()->ajax()) {

            $data=EntityApplication::select('entity_applications.first_name','entity_applications.last_name','entity_applications.serial_no','entity_applications.application_type','entity_applications.issue_date','entity_applications.expire_date','entity_applications.status','users.company_name as company_name','users.email','entity_applications.final_special_serial_no','entity_applications.type')
                                    ->leftJoin('users','users.id','=','entity_applications.user_id')
                                    // ->where('user.company_address',$request->building)
                                    ->where('entity_applications.is_deleted','No')
                                    ->whereIn('entity_applications.id',$request->inactiveIds);

            $dataTable = datatables()->of($data);
            // Add global search filter
            
            $dataTable->filter(function ($query) {

                if (request()->has('search')) {

                    $searchTerm = request()->get('search')['value'];

                    $query->where(function ($subQuery) use ($searchTerm) {

                        foreach ($subQuery->getModel()->getFillable() as $column) {
                            // print_r($column.'...........-..........');
                            // if ($column === 'first_name' || $column === 'last_name') {
                            //     $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            // } else {
                            //     $subQuery->orWhere($column, 'like', "%{$searchTerm}%");
                            // }
                           
                            if ($column === 'first_name' || $column === 'last_name') {
                                $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$searchTerm}%"]);
                            }
                            else if ($column == 'user_id') {
                                $subQuery->orwhere('users.company_name', 'like', "%{$searchTerm}%");
                            }
                            else if ($column === 'type') {
                                $subQuery->orWhere(function ($typeQuery) use ($searchTerm) {
                                    if ($searchTerm == 'New') {
                                        $typeQuery->where('entity_applications.type', 0);
                                    } elseif ($searchTerm == 'Renew') {
                                        $typeQuery->where('entity_applications.type', 1);
                                    } elseif ($searchTerm == 'Surrender') {
                                        $typeQuery->where('entity_applications.type', 2);
                                    }
                                });
                            }
                            else {
                                $subQuery->orWhere('entity_applications.'.$column, 'like', "%{$searchTerm}%");
                            }
                            
                            // $subQuery->orWhere($column, 'like', "%{$searchTerm}%");

                        }

                    });

                }

            });
           

            return $dataTable->addColumn('user.company_name', function($row){

                return $row->company_name;

            })

            ->addColumn('application_type', function($row){

                if($row->application_type==0){

                    return 'New';

                }elseif($row->application_type==1){

                    return 'Renew';

                }elseif($row->application_type==2){

                    return 'Surrender';

                }else{

                    return '';

                }

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

                if (empty($row->serial_no)) {
                    $row->serial_no = $row->final_special_serial_no;
                } 
                return $row->serial_no;

            })

            ->addColumn('name', function($row){

                return $row->fullname;
            })

            ->addColumn('status', function($row){

               

                return '<span class="label label-lg label-inline ' . Helper::getApplicationStatusBackgroundColor($row->status) . '">' . Helper::getApplicationType($row->status) . '</span>';

            })
            ->addColumn('action', function($row){

                // <a id="viewApplication" class="viewApplication btn btn-light btn-lg" data-id="'.$row->id.'">

                //         <span class="mr-5">View Application</span>

                //         <i class="ki ki-long-arrow-next icon-sm"></i>

                //     </a>

                $btn = '<div class="d-flex align-items-center">';        

                $btn .=  '<a id="viewApplication" class="viewApplication btn btn-primary btn-sm"  data-id="'.$row->id.'">
                        <i class="fas fa-eye fa-1x text-green"></i>                        

                    </a>';

                   
                $btn.= '</div>';

                return $btn;

            })->rawColumns(['status','action'])



            ->addIndexColumn()

            ->make(true);

        }
    }

    public function buildingCompaniesApplicationsDataExport(request $request)
    {
        // dd($request->all());
        $filter_building = $request->filter_building;
        $filter_company = $request->filter_company;

        Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export Request Data: " . json_encode($request->all()));
        Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export start ");

        // dd($filter_building);
        $data = EntityApplication::select('entity_applications.serial_no','user.company_address','user.company_name','entity_applications.first_name','entity_applications.last_name',DB::raw('CASE
        WHEN entity_applications.status = 200 THEN "Approved"
        WHEN entity_applications.status = 201 THEN "Draft"
        WHEN entity_applications.status = 202 THEN "Submited"
        WHEN entity_applications.status = 500 THEN "Rejected"
        WHEN entity_applications.status = 501 THEN "Expired"
        WHEN entity_applications.status = 401 THEN "Surrendered"
        WHEN entity_applications.status = 502 THEN "Deactivated"
        WHEN entity_applications.status = 203 THEN "Activated"
        WHEN entity_applications.status = 204 THEN "Verified"
        WHEN entity_applications.status = 500 THEN "Rejected"
        WHEN entity_applications.status = 205 THEN "Send Back"
        WHEN entity_applications.status = 206 THEN "Hard copy submitted"
        WHEN entity_applications.status = 255 THEN "Terminated"
        ELSE "Undefined"
    END AS application_status'),'entity_applications.type','entity_applications.type','entity_applications.issue_date','entity_applications.expire_date','entity_applications.final_special_serial_no','entity_applications.gender','entity_applications.date_of_birth','user.unit_category')
                                ->leftJoin('users as user', 'user.id', '=', 'entity_applications.user_id')
                                ->where('entity_applications.is_deleted','No');
                                

        if ($filter_building != '0' && $filter_company != '0') {
            // Both building and company are specified
            $data->where('user.company_address', $filter_building)
                    ->where('user.company_name', $filter_company);
        } elseif ($filter_building == '0' && $filter_company != '0') {
            // Only company is specified, search in all buildings
            $data->where('user.company_name',$filter_company);
        } elseif ($filter_building != '0' && $filter_company == '0') {
            // Only building is specified
            $data->where('user.company_address', $filter_building);
        }
        $data->orderBy('user.company_address', 'asc')->orderBy('user.company_name', 'asc');
        $data = $data->get();
       
        // dd($data);
        $responseArray = array();
        if ($data->isEmpty()) {
            Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export data not found");
            Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export end");

            return response()->json(['result' => false, 'message' => 'No data found!']);
        }
        else{
            // dd($data);
            Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export data found");

            $formattedData = [];
            foreach ($data as $row) {
                $employeeName = $row->first_name;

                // Append last name if it's not blank
                if (!empty($row->last_name)) {
                    $employeeName .= ' ' . $row->last_name;
                }

                $formattedData[] = [
                    'employee'          => $employeeName,
                    'dob'               => $row->date_of_birth,
                    'gender'            => $row->gender,   // 'Gender'
                    'serial_number'     => $row->type != 'Other' ? (string) $row->serial_no : (string) $row->final_special_serial_no,
                    'company_unit'      => $row->unit_category,  // 'Company Unit'
                    'application_type'  => $row->type,
                    'issue_date'        => date('d-m-Y',strtotime($row->issue_date)),
                    'expire_date'       => $row->type != 'Other' ? date('d-m-Y',strtotime($row->expire_date)) : '',
                    'building'          => $row->company_address,
                    'company'           => $row->company_name,
                ];
                // $formattedData[] = [
                //     'serial_number'     => $row->type != 'Other' ? (string) $row->serial_no : (string) $row->final_special_serial_no,
                //     'building'          => $row->company_address,
                //     'company'           => $row->company_name,
                //     'employee'          => $employeeName,
                //     'application_type'  => $row->type,
                //     'issue_date'        => date('d-m-Y',strtotime($row->issue_date)),
                //     'expire_date'       => $row->type != 'Other' ? date('d-m-Y',strtotime($row->expire_date)) : '',
                //     'status'            => $row->application_status,
                    
                // ];
            }
            // dd($formattedData);
            $excelData = Excel::raw(new ExportBuidlingCompanyApp(collect($formattedData)), \Maatwebsite\Excel\Excel::XLSX);
            $base64Excel = base64_encode($excelData);
            
            $responseArray['status'] = false;
            $responseArray['message'] = 'Data found successfully';
            $responseArray['data'] = $base64Excel;
            Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export : Data converted to base64 ");
            Log::channel('building-companies-data-export')->info("Time: " . date("Y-m-d H:i:s") . " building companies data export ends");

            // If no data found, return a failed response
            return response()->json(['result' => true, 'message' => 'Data Found Successfully', 'buildingCompanyApplicationsData' => $responseArray]);
        }
     
    }

    public function resendUserIdPasswordEmail($EntityId)
    {
        
        $EntityId = (int) $EntityId;
       try {
        $userDetail = User::findOrFail($EntityId);
        // dd($userDetail);
        $password           = $this->generateRandomPassword(8);
        $mailData = array('email' => $userDetail->email, 'password' => $password, 'mailType' => 'register');
        $userDetail->password = bcrypt($password);
        $userDetail->save();

            // # Send email

            Mail::to($userDetail->email)->send(new SendMailable($mailData));
       } catch (\Throwable $th) {
            echo $th;
       }
    }

    public function getVal($filterVar){

        $filterVar=str_replace('$','',$filterVar);

        $filterVar = str_replace('^', '', $filterVar);

        return $filterVar;

    }
    // public function resendUserIdPasswordEmail(request $request)
    // {
        
    //     $userDetail = User::findOrFail(52);
    //     // dd($userDetail);
    //     $password           = $this->generateRandomPassword(8);
    //     dd($password);
    //     $application_number = $this->generateApplicationNumber();
    //     return $password;
    //     # Send login data

    //     // $mailData = array('email' => $company_email, 'password' => $password, 'mailType' => 'register');

    //     // # Send email

    //     // Mail::to($company_email)->send(new SendMailable($mailData));

    // }

    public function getBaseCompanyList(Request $request){
        // dd($request->all());

        $filterBaseCompanyData = EntityApplication::filterBaseCompanyData($request->filter);
        

            // Return response
            return response()->json([
                'success' => true,
                'companies' => $filterBaseCompanyData
            ]);
    }


}

