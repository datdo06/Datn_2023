<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'room')
            ->where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()]])
            ->whereNot('status', 'Đã hủy')
            ->orderBy('check_out', 'ASC')
            ->orderBy('id', 'DESC')->get();
        return view('dashboard.index', compact('transactions'));
    }
}
