<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCoupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'coupon_id',
    ];
    public function Transaction(){
        return $this->belongsTo(Transaction::class);
    }
    public function Coupon(){
        return $this->belongsTo(Coupon::class);
    }
}

