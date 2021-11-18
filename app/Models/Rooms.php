<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\messages as Messages;

class Rooms extends Model
{
    use HasFactory;



    public function messages(){
        return $this->hasMany('Messages' , 'room_id');
    }
}
