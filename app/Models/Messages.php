<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rooms;

class Messages extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo('User' , 'user_id');
    }

    public function rooms(){
        return $this->belongsTo('Rooms' , 'room_id');
    }
}
