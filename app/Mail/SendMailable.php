<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Mail;

use Helper;

class SendMailable extends Mailable

{

    use Queueable, SerializesModels;



    /**

     * Create a new message instance.

     * @param  array  $data

     */

    public function __construct($data)
    {

        $this->requestdData = $data;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {
        $signature  = Config::get('constant.SIGNATURE');

        $emailNote  = Config::get('constant.EMAIL_NOTE');

        if (isset($this->requestdData['data'])) {
            $dataArray = array(
          
                'application_number' => $this->requestdData['data']['application_number'],

                'serial_no' => $this->requestdData['data']['serial_no'],

                // 'email'             => $this->requestdData['data']['email'],
                'email'             => env('TEST_EMAIL_ADDRESS'),


                'name'              => $this->requestdData['data']['first_name'].' '.$this->requestdData['data']['last_name'],

                'designation'       => $this->requestdData['data']['designation'],

                'date_of_birth'     => date('d-m-Y',strtotime($this->requestdData['data']['date_of_birth'])),

                'gender'            => $this->requestdData['data']['gender'],

                'mobile_number'     => $this->requestdData['data']['mobile_number'],

                'type'              => $this->requestdData['data']['type'],

                'application_type'  => $this->requestdData['data']['application_type'],

                'issue_date'        => date('d-m-Y',strtotime($this->requestdData['data']['issue_date'])),

                'expire_date'       => date('d-m-Y',strtotime($this->requestdData['data']['expire_date'])),

                'image'             => asset('upload/entity-data/entity-application/'.$this->requestdData['data']['image']),

                'qrcode'            => asset('upload/qrcode/'.$this->requestdData['data']['qrcode']),

                'authorized_signatory' => $this->requestdData['data']['authorized_signatory'],

                'status'            => Helper::getApplicationType($this->requestdData['data']['status']),

            );
        }
        

        if($this->requestdData['mailType'] == 'forgotPassword'){

            return $this->view('emails.forgotpassword')

                ->from(env('MAIL_USERNAME'),'Card Management')

                ->subject('Card Management - Reset Password')

                ->with([

                    'email' => $this->requestdData['email'],

                    'password' => $this->requestdData['password'],

                    'signature' => $signature,

                    'emailNote' => $emailNote

                ]);

        } else if($this->requestdData['mailType'] == 'register'){

            return $this->view('emails.register')

                ->from(env('MAIL_USERNAME'), 'Card Management')

                ->subject('Card Management - Login Detail')

                ->with([

                    'email' => $this->requestdData['email'],

                    'password' => $this->requestdData['password'],

                    'signature' => $signature,

                    'emailNote' => $emailNote

                ]);

        }

        else if($this->requestdData['mailType'] == 'newEntityApplication'){

            if($this->requestdData['data']['application_type'] == 1)

            {

                $application_type = 'Renew';

            }

            elseif($this->requestdData['data']['application_type'] == 0)

            {

                $application_type = 'New';

            }

            else

            {

                $application_type = 'Surrender';

            }

           

            return $this->view('emails.entityapplication')

                ->from(env('MAIL_USERNAME'), 'Card Management')

                ->subject('Card Management - Entity '.$application_type.' Application')

                ->with($dataArray);

        }

        else if($this->requestdData['mailType'] == 'surrenderEntityApplication'){

            

            return $this->view('emails.entityapplication')

                ->from(env('MAIL_USERNAME'), 'Card Management')

                ->subject('Card Management - Entity Surrender Application')

                ->with($dataArray);

        }
        else if($this->requestdData['mailType'] == 'statusChangeEntityApplication'){

            // $subject = 'Card Management - Entity ' . Helper::getApplicationType($this->requestdData['data']['status']) . ' Application';

            // if (isset($this->requestdData['expireApplicationSubject']) && !empty($this->requestdData['expireApplicationSubject'])) {
            //     $subject = 'Card Management - Entity '.$this->requestdData['expireApplicationSubject'] . ' Application';
            // }
            return $this->view('emails.entityapplicationstatuschange')

                ->from(env('MAIL_USERNAME'), 'Card Management')

                ->subject('Card Management - Entity ' . Helper::getApplicationType($this->requestdData['data']['status']) . ' Application')

                ->with($dataArray);

        }
        else if($this->requestdData['mailType'] == 'statusChangeEntityApplicationTwoDaysEarly'){

            return $this->view('emails.entityapplicationtwodaysearlyexpire')

                ->from(env('MAIL_USERNAME'), 'Card Management')

                ->subject('Card Management - Entity '.Helper::getApplicationType($this->requestdData['data']['status']).' Application')

                ->with($dataArray);

        }
		else if($this->requestdData['mailType'] == 'submitedAppliationsCountNotify'){

            return $this->view('emails.entitysubmittedapplicationcounts')

                ->from(env('MAIL_USERNAME'),'Card Management')

                ->subject('Card Management - Pending Applications to Approve')

                ->with([

                    'count' => $this->requestdData['count'],
                ]);

        }

    }

}

