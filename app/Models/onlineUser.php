<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User as User;
use App\Models\Rooms as Rooms;

class onlineUser extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable =["user_id" , "room_id" , "userLogin" , "userLogout"];
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function rooms()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public function onlineUsers()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
