<?php

namespace App\Imports;

use App\Models\EntityApplication;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\User;


class ImportEntityApplications implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        // $userCompany = User::getUserCompany($row[1]);
        //     dd($userCompany);
        if (date('Y-m-d') >= date('Y-m-d', ($row[12] - 25569) * 86400))
        // if(date('Y-m-d') >= date('Y-m-d',strtotime($row[12])))
        {

            $expire_status = 501;
        } else {

            $expire_status = 203;
        }

        try {
            if (strtotime(date('Y-m-d')) >= strtotime(date('Y-m-d', ($row[12] - 25569) * 86400)))
            // if(date('Y-m-d') >= date('Y-m-d',strtotime($row[12])))
            {
                $expire_status = 501;
            } else {

                $expire_status = 203;
            }
                //echo $expire_status; exit;
                $dateOfBirth = null;
                if (!empty($row[6])) {
                    $parsedDate = date_parse_from_format('d-m-Y', $row[6]);
                    if ($parsedDate['error_count'] === 0 && $parsedDate['warning_count'] === 0) {
                        $dateOfBirth = date('Y-m-d', mktime(0, 0, 0, $parsedDate['month'], $parsedDate['day'], $parsedDate['year']));
                    }
                }


                // $user_id = 212;
                // if(date('Y-m-d') <= date('Y-m-d',($row[12] - 25569) * 86400)){


                $formattedMobileNumber = preg_replace('/\s+/', '', $row[8]);
                $fullNameWSpace = $row[3] . ' ' . $row[4];

                $data = EntityApplication::where(function ($query) use ($row, $fullNameWSpace) {
                    $query->where('first_name', $row[3])
                        ->orWhere('first_name', $row[3] . '' . $row[4])
                        ->orWhere('first_name', $fullNameWSpace); // Handle null last_name
                })
                    ->where(function ($query) use ($row) {
                        $query->where('last_name', $row[4])
                            ->orWhere('last_name', '')
                            ->orWhereNull('last_name'); // Handle null last_name
                    })
                    ->where(function ($query) use ($row, $formattedMobileNumber) {

                        $query->where('mobile_number', $row[8])
                            ->orWhere('mobile_number', $formattedMobileNumber); // Handle null last_name
                    })
                    ->where('type', $row[10])
                    ->where('user_id', $row[13])
                    ->where('is_deleted', 'No')->get();

                //echo 'testsetst<pre>'; print_r($data); exit;
                if (!count($data) > 0) {

                    $dataArray = [
                        'serial_no'         => $row[0],
                        'email'             => $row[2],
                        'first_name'        => $row[3],
                        'last_name'         => $row[4],
                        'designation'       => $row[5],
                        'date_of_birth'     => $dateOfBirth,
                        'gender'            => $row[7],
                        'mobile_number'     => $row[8],
                        'type'              => $row[10],
                        'issue_date'        => date('Y-m-d', ($row[11] - 25569) * 86400),
                        'expire_date'       => date('Y-m-d', ($row[12] - 25569) * 86400),
                        'user_id'           => $row[13],
                        'status'            => $expire_status,
                        'dial_code'         => 91,
                        'country_code'      => 'IN',
                        'application_type'  => 3,
                    ];
                    
                    //dd($dataArray);
                    Log::channel('upload-id-card-status')->info("Time: Data New");


                    return new EntityApplication($dataArray);
                } else {

                    // dd($row,1);
                    Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists for serial number: " . $row[0] . ' - ' . $row[3] . ' - ' . $row[4] . ' - ' . $row[8] . ' - ' . $row[13] . ' - ');
                }
                //    }
                //    else{
                //     // dd($row,2);
                //     Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists and Data is expired for serial number: " . $row[0].' - ' . $row[3].' - ' . $row[4].' - ' . $row[8].' - ' . $row[13].' - ');


                //    }
            

            // $data = EntityApplication::where('type',$row[10])->where('serial_no',$row[0])->get();



        } catch (\Throwable $th) {
            echo 'cache'; exit;
            dd($th);
            //throw $th;
            Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists for serial number: " . $row[0]);
        }

        //dd(date('Y-m-d',($row[11] - 25569) * 86400));

    }

    // public function model(array $row)
    // {

    //     // $userCompany = User::getUserCompany($row[1]);
    //     //     dd($userCompany);
    //     if(date('Y-m-d') >= date('Y-m-d',($row[12] - 25569) * 86400))
    //     // if(date('Y-m-d') >= date('Y-m-d',strtotime($row[12])))
    //     {
    //         $expire_status = 501;
    //     }
    //     else
    //     {
    //         $expire_status = 203;
    //     }

    //     try {
    //         $dateOfBirth = null;
    //         if (!empty($row[6])) {
    //             $parsedDate = date_parse_from_format('d-m-Y', $row[6]);
    //             if ($parsedDate['error_count'] === 0 && $parsedDate['warning_count'] === 0) {
    //                 $dateOfBirth = date('Y-m-d', mktime(0, 0, 0, $parsedDate['month'], $parsedDate['day'], $parsedDate['year']));
    //             }
    //         }


    //         // $user_id = 212;
    //         if(date('Y-m-d') >= date('Y-m-d',($row[12] - 25569) * 86400)){
    //             $data = EntityApplication::where('type',$row[10])->where('first_name',$row[3])
    //             ->where('mobile_number',$row[8])->where('is_deleted','No')->where('user_id',$row[13])->get();

    //             if(!count($data) > 0)
    //             {

    //                 // $dataArray = [
    //                 //     'serial_no'         => $row[0],
    //                 //     'email'             => $row[2],
    //                 //     'first_name'        => $row[3],
    //                 //     'last_name'         => $row[4],
    //                 //     'designation'       => $row[5],
    //                 //     'date_of_birth'     => $dateOfBirth,
    //                 //     'gender'            => $row[7],
    //                 //     'mobile_number'     => $row[8],
    //                 //     'type'              => $row[10],
    //                 //     'issue_date'        => date('Y-m-d', ($row[11] - 25569) * 86400),
    //                 //     'expire_date'       => date('Y-m-d', ($row[12] - 25569) * 86400),
    //                 //     'user_id'           => $row[13],
    //                 //     'status'            => $expire_status,
    //                 //     'dial_code'         => 91,
    //                 //     'country_code'      => 'IN',
    //                 //     'application_type'  => 3,
    //                 // ];

    //                 // return new EntityApplication($dataArray);
    //             }
    //             else
    //             {
    //                 Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists for serial number: " . $row[0].' - ' . $row[3].' - ' . $row[4].' - ' . $row[8].' - ' . $row[13].' - ');
    //             }
    //        }
    //        else{
    //             Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists for serial number: " . $row[0]);

    //        }
    //         // $data = EntityApplication::where('type',$row[10])->where('serial_no',$row[0])->get();



    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists for serial number: " . $row[0]);
    //     }

    //     //dd(date('Y-m-d',($row[11] - 25569) * 86400));

    // }

    // public function model(array $row)
    // {
    //     return $row->toArray();
    //     // try {
    //     //     $allStatusArray = [
    //     //         200 => "Approved",
    //     //         201 => "Draft",
    //     //         202 => "Submitted",
    //     //         203 => "Activated",
    //     //         204 => "Verified",
    //     //         205 => "Send Back",
    //     //         206 => "Hard copy submitted",
    //     //         255 => "Terminated",
    //     //         401 => "Surrendered",
    //     //         403 => "Blocked",
    //     //         500 => "Rejected",
    //     //         501 => "Expired",
    //     //         502 => "Deactivated",
    //     //     ];
    //     //     // foreach ($allStatusArray as $key => $value) {
    //     //     //     if ($value == $row[15]) {
    //     //     //         $status_code = $key;
    //     //     //         break; // Stop looping once the status is found
    //     //     //     }
    //     //     // }



    //     //     $company = $this->registeredCompanyList->where('company_name', $row[14])->where('unit_category', $row[13])->first();
    //     //     if (empty($company)) {
    //     //         Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Entity Not Found : " . $row[14] . ' (' . $row[13].')');
    //     //         // dd('1');
    //     //         return null; // Skip this row and continue with the next
    //     //     }
    //     //     $data = EntityApplication::where('type', $row[6])->where('serial_no', $row[10])->get();

    //     //     if (!$data->count()) {
    //     //         return new EntityApplication([
    //     //             'serial_no'         => $row[10],
    //     //             'email'             => $row[2],
    //     //             'first_name'        => $row[0],
    //     //             'last_name'         => $row[1],
    //     //             'designation'       => $row[3],
    //     //             'date_of_birth'     => date('Y-m-d',($row[4] - 25569) * 86400),
    //     //             'gender'            => $row[5],
    //     //             'dial_code'         => $row[7],
    //     //             'mobile_number'     => $row[8],
    //     //             'type'              => $row[6],
    //     //             'issue_date'        => date('Y-m-d',($row[11] - 25569) * 86400),
    //     //             'expire_date'       => date('Y-m-d',($row[12] - 25569) * 86400),
    //     //             'user_id'           => $company->id,
    //     //             'country_code'      => $row[9],
    //     //             'application_type'  => 3,
    //     //             'image'             => $row[15],
    //     //             'signature'         => $row[16],
    //     //         ]);
    //     //     } else {
    //     //         Log::channel('upload-id-card-status')->info("Time: " . date("Y-m-d H:i:s") . " Data already exists for serial number: " . $row[10]);
    //     //     }

    //     // } catch (\Throwable $th) {
    //     //     dd($row);
    //     //     dd($th);
    //     // }

    // }

    public function startRow(): int
    {
        return 2; // Skip the first row
    }
}
