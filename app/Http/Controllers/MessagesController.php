<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\User;
use App\Traits\ResponseTrait;
use App\Events\MessageSent;
use Pusher;
use Auth;

class MessagesController extends Controller
{
    use ResponseTrait;
    public function addNewMessage(Request $request)
    {
        if ($request->body != "") {
            try {
                $messages = Messages::create([
            "body"     => $request->body,
            "user_id"  => Auth::id(),
            "room_id"  => $request->room_id
         ]);
                $dataMessages = $messages->load("users", "rooms");
                // dd($dataMessages->body);
                $data =  $this->successWithData($dataMessages, "Your Message has been sent Successfully", "Send New Message");
                event(new MessageSent($dataMessages, $dataMessages->rooms->id));
                return $data;
            } catch (Exception $e) {
                return $this->errorResponse($e->getMessage().". \nplease contact your Technolgoy team to solve the issue", "Send New Message");
            }
        } else {
            return $this->errorResponse("Failed", "send new message");
        }
    }


    
}
