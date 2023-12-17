<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'facility_id'
    ];
    public function Room(){
        return $this->belongsTo(Room::class);
    }
    public function Facility(){
        return $this->belongsTo(Facility::class);
    }
}
