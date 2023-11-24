<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
      'coupon_name',
      'coupon_time',
      'coupon_code',
      'coupon_number',
      'coupon_condition'
    ];

    public function setExpirationDateAttribute($value)
    {
        $this->attributes['expiration_date'] = Carbon::parse($value)->endOfDay();
    }

    public function getExpiredAttribute()
    {
        return Carbon::now()->greaterThan($this->expiration_date);
    }
}
