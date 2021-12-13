<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\messages as Messages;
use App\Models\User as User;
use App\Models\onlineUser as onlineUser;

class Rooms extends Model
{
    use HasFactory;
    
    protected $fillable = ["name" , "user_id"];

    public function messages()
    {
        return $this->hasMany(Messages::class, 'room_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function onlineUsers()
    {
        return $this->hasMany(onlineUser::class, 'room_id');
    }
}
