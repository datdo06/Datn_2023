<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'room_id',
        'check_in',
        'check_out',
        'sum_people',
        'status',
        'sum_money'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalPrice()
    {
        $day = Helper::getDateDifference($this->check_in, $this->check_out);
        $room_price = $this->room->price;
        $total_price = $room_price * $day;
        return $total_price;
    }

    public function getDateDifferenceWithPlural()
    {
        $day = Helper::getDateDifference($this->check_in, $this->check_out);
        $plural = "Ngày";
        return $day . ' ' . $plural;
    }

    public function getTotalPayment()
    {
        $totalPayment = 0;
        foreach ($this->payment as $payment) {
            $totalPayment += $payment->price;
        }
        return $totalPayment;
    }

    public function getMinimumDownPayment()
    {

        $minimumDownPayment = ($this->sum_money) * 0.15;
        return $minimumDownPayment;
    }
}
