<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WarningToAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $transactions = Transaction::where('created_at', '>=', \Carbon\Carbon::now()->subHours(48))->get();

        $info = array(
            'transactions' => $transactions
        );

        Mail::send('admin', $info, function ($message)
        {
            $message->to('admin@gmail.com', 'admin')
                ->subject('registro de las transacciones de las últimas 48 horas');
            $message->from('banco@gmail.com', 'banco');
        });
    }
}
