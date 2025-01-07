<?php

namespace App\Observers;

use App\Models\EntityApplication;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;

class EntityApplicationObserver
{
    /**
     * Handle the EntityApplication "created" event.
     *
     * @param  \App\Models\EntityApplication  $entityApplication
     * @return void
     */
    public function created(EntityApplication $entityApplication)
    {
        //
    }

    /**
     * Handle the EntityApplication "updated" event.
     *
     * @param  \App\Models\EntityApplication  $entityApplication
     * @return void
     */
    public function updated(EntityApplication $entityApplication)
    {
        // //
        // Log::info('Observer updating method called');
        // // Your existing logic ...
    
        // Log::info('Mail will be sent now');
        
        // $entityApplication['mailType'] = 'newEntityApplication';
        
        // // Send Mail to entity mail address related to application
        // Mail::to($entityApplication['email'])->send(new SendMailable($entityApplication));
    
        // Log::info('Mail sent successfully');
    
        // Todo: Send Mail to entity mail address related to application
        // Mail::to($entityApplicationDetail['email'])->send(new SendMailable($mailData));

    }

    /**
     * Handle the EntityApplication "deleted" event.
     *
     * @param  \App\Models\EntityApplication  $entityApplication
     * @return void
     */
    public function deleted(EntityApplication $entityApplication)
    {
        //
    }

    /**
     * Handle the EntityApplication "restored" event.
     *
     * @param  \App\Models\EntityApplication  $entityApplication
     * @return void
     */
    public function restored(EntityApplication $entityApplication)
    {
        //
    }

    /**
     * Handle the EntityApplication "force deleted" event.
     *
     * @param  \App\Models\EntityApplication  $entityApplication
     * @return void
     */
    public function forceDeleted(EntityApplication $entityApplication)
    {
        //
    }
}
