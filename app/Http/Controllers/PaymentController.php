<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionFacility;
use App\Repositories\Interface\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        $payments = Payment::orderBy('id', 'DESC')->paginate(5);
        return view('payment.index', compact('payments'));
    }

    public function create(Transaction $transaction)
    {
        return view('transaction.payment.create', compact('transaction'));
    }

    public function store(Transaction $transaction, Request $request)
    {
        $insufficient = $transaction->getTotalPrice() - $transaction->getTotalPayment();
        $request->validate([
            'payment' => 'required|numeric|lte:' . $insufficient
        ]);

        $this->paymentRepository->store($request, $transaction, 'Payment');

        return redirect()->route('transaction.index')->with('success', 'Transaction room ' . $transaction->room->number . ' success, ' . Helper::convertToRupiah($request->payment) . ' paid');
    }

    public function invoice($id)
    {
        $transaction = Transaction::query()->findOrFail($id);
        $transaction_facilities = TransactionFacility::where('transanction_id', $transaction->id)->get();
        return view('payment.invoice', compact('transaction', 'transaction_facilities' ));
    }



}
