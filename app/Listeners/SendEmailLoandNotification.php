<?php

namespace App\Listeners;

use App\Events\AccountTryWithdrawal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailLoandNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AccountTryWithdrawal  $event
     * @return void
     */
    public function handle(AccountTryWithdrawal $event)
    {
        // Access the order using $event->order...
            $info = array(
                'name' => "Banco"
            );
            Mail::send('mail', $info, function ($message) use ($event)
            {
                $message->to($event->account->email, $event->account->number_account)
                    ->subject('Tienes un prestamo');
                $message->from('banco@gmail.com', 'Banco');
            });

    }
}
