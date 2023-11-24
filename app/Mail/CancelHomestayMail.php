<?php

namespace App\Mail;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Translation\t;

class CancelHomestayMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $transaction;
    private $hoan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction, $hoan)
    {
        $this->transaction = $transaction;
        $this->user = $user;
        $this->hoan = $hoan;

    }

    public function build()
    {
        return $this->subject('Hủy đặt homestay')
            ->view('mail.mail')
            ->with([
                'user'=>$this->user,
                'transaction'=>$this->transaction,
                'hoan'=>$this->hoan
            ]);

    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
