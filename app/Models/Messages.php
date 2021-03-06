<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rooms;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = ['body' , 'user_id' , 'room_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rooms()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
