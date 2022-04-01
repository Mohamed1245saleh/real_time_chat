<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivateChatRoom;
use App\Models\User;
use App\Models\PrivateMessage;
use App\Traits\ResponseTrait;
use App\Events\privateChatRoom as privateChat;
use DB;
use Log;
class privateRoomController extends Controller
{
    use ResponseTrait;
    public function privateRoom(Request $request){
        $senderId   = $request->sender_id;
        $receiverId = $request->receiver_id;
        //to check both users don't have a private channel
        $ifChannelExist = $this->returnPrivateChatRoomQeury($senderId , $receiverId);
        if($ifChannelExist == 0){
            $privateChatRoom = new PrivateChatroom();
            $privateChatRoom->sender_id = $senderId;
            $privateChatRoom->receiver_id = $receiverId;
            $privateChatRoom->save();
        }
        $receiverUserData = User::where("id" ,$receiverId)->get();
        return $this->res($receiverUserData , true ,"");
    }

    public function AddNewPrivateMessage(Request $request){
        event(new privateChat($senderId , $receiverId));
        $senderId   = $request->sender_id;
        $receiverId = $request->receiver_id;
        //to check both users don't have a private channel
        $userRelationshipId =  $this->returnChatRoomId($senderId , $receiverId);
        if($userRelationshipId > 0){
          $privateMessage = new PrivateMessage;
          $privateMessage->private_chat_room_id = $userRelationshipId; 
          $privateMessage->message = $request->body;
          $privateMessage->save(); 
        }
    return  User::where("id" , $senderId)->get();
    }

    private function returnPrivateChatRoomQeury ($senderId , $receiverId){
       return  PrivateChatRoom::where("sender_id" , $senderId)->where("receiver_id" , $receiverId)
       ->orWhere(function($query) use ($senderId , $receiverId){
        $query->where("sender_id" , $receiverId)->where("receiver_id" , $senderId);  
       })->count();
    }
    

    private function returnChatRoomId($senderId , $receiverId){
        // echo $senderId."====".$receiverId."</br>";
        return   PrivateChatRoom::where("sender_id" , $senderId)->where("receiver_id" , $receiverId)
        ->orWhere(function($query) use ($senderId , $receiverId){
            $query->where("sender_id" , $receiverId)->where("receiver_id" , $senderId);  
           })->pluck("id")->first();
    }
}
