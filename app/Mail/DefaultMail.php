<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_data;

    /**
     * Create a new message instance.
     *
     * @param  array  $email_data
     * @return void
     */
    protected $emailData;
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->emailData['viewFile'])
                    ->from(env('MAIL_USERNAME'), 'Card Management')
                    ->with('emailData',$this->emailData)
                    ->subject($this->emailData['subject']);
    }
}
