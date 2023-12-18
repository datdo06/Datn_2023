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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->user = $user;

    }

    public function build()
    {
        return $this->subject('Hủy đặt homestay')
            ->view('mail.mail')
            ->with([
                'user'=>$this->user,
                'transaction'=>$this->transaction,
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
