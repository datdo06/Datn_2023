<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
