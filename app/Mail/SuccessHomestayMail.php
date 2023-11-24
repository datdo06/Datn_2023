<?php

namespace App\Mail;

use App\Models\Transaction;
use App\Models\TransactionFacility;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SuccessHomestayMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $transaction;
    private $transactionCoupon;
    private $transactionFacility;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction, $transactionCoupon, $transactionFacility)
    {
        $this->transaction = $transaction;
        $this->user = $user;
        $this->transactionCoupon = $transactionCoupon;
        $this->transactionFacility = $transactionFacility;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        return $this->subject('Đặt homestay thành công')
            ->view('mail.mail_success')
            ->with([
                'user'=>$this->user,
                'transaction'=>$this->transaction,
                'transactionCoupon'=>$this->transactionCoupon,
                'transactionFacility'=>$this->transactionFacility,
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
