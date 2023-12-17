<?php

namespace App\Mail;

use App\Models\Payment;
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
    private $transaction;
    private $transactionCoupon;
    private $transactionFacility;
    private $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Transaction $transaction, $transactionCoupon, $transactionFacility, Payment $payment)
    {
        $this->transaction = $transaction;
        $this->transactionCoupon = $transactionCoupon;
        $this->transactionFacility = $transactionFacility;
        $this->payment = $payment;
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
                'transaction'=>$this->transaction,
                'transactionCoupon'=>$this->transactionCoupon,
                'transactionFacility'=>$this->transactionFacility,
                'payment'=>$this->payment,
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
