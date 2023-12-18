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
    private $transaction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Transaction $transaction)
    {
        $this->transaction = $transaction;

    }

    public function build()
    {
        return $this->subject('Hủy đặt homestay')
            ->view('mail.mail')
            ->with([
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
