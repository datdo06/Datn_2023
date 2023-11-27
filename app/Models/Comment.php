<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = ['id', 'com_content','com_room_id','com_subject', 'star','com_user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
