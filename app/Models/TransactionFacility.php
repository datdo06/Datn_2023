<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionFacility extends Model
{

    use HasFactory;
    protected $fillable = [
        'transanction_id',
        'facility_id'
    ]
    ;
    public function Transaction(){
        return $this->belongsTo(Transaction::class);
    }
    public function Facility(){
        return $this->belongsTo(Facility::class);
    }
}
