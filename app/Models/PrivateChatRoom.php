<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateChatRoom extends Model
{
    use HasFactory;

    protected $table = "private_chat_room";
    protected $fillable = ["id" , "sender_id" , "receiver_id" ,"created_at" ,"updated_at"];
    public $primaryKey  = 'id';
}
