<?php

namespace App\Jobs;

use App\Mail\CancelHomestayMail;
use App\Mail\SuccessHomestayMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSuccessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    private $mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user , SuccessHomestayMail $mail)
    {
        $this->user = $user;
        $this->mail = $mail;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send($this->mail);
    }
}
