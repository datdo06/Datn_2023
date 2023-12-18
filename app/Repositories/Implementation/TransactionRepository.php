<?php

namespace App\Repositories\Implementation;

use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Repositories\Interface\TransactionRepositoryInterface;
use Carbon\Carbon;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function store($request, Customer $customer, Room $room)
    {
        return Transaction::create([
            'user_id' => auth()->user()->id,
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Reservation'
        ]);
    }

    public function getTransaction($request)
    {
        if (empty($request->from) ) {
            return Transaction::with('user', 'room')
                ->where('check_out', '>=', Carbon::now()->format('Y-m-d'))
                ->orderBy('id', 'DESC')->paginate(20)
                ->appends($request->all());
        }else{
            return Transaction::with('user', 'room')
                ->where('check_out', '>=', Carbon::now()->format('Y-m-d'))
                ->where('check_in', '>=', $request->from)->where('check_in', '<=', $request->to)
                ->orderBy('id', 'DESC')->paginate(20)
                ->appends($request->all());
        }

    }

    public function getTransactionExpired($request)
    {
        if (empty($request->from) ) {
            return Transaction::with('user', 'room')->where('check_out', '<', Carbon::now()->format('Y-m-d'))
                ->orderBy('id', 'DESC')->paginate(20)
                ->appends($request->all());
        }else{
            return Transaction::with('user', 'room')->where('check_out', '<', Carbon::now()->format('Y-m-d'))
                ->where('check_in', '>=', $request->from)->where('check_in', '<=', $request->to)
                ->orderBy('check_in', 'ASC')->paginate(20)
                ->appends($request->all());
        }

    }
}
