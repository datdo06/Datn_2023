<?php

namespace App\Jobs;

use App\Mail\CancelHomestayMail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $transaction;
    private $mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction , CancelHomestayMail $mail)
    {
        $this->transaction = $transaction;
        $this->mail = $mail;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->transaction->guest_email)->send($this->mail);
    }
}
