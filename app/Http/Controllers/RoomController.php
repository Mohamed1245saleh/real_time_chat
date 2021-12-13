<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\Rooms as Room;
use App\Models\User;
use App\Models\onlineUser as onlineUser;
use App\Events\onlineUsersPerRoom;
use App\Events\offlineUsersPerRoom;
use Exception;
use Auth;
use Illuminate\Support\Facades\Event;

class RoomController extends Controller
{
    use ResponseTrait;
    public function addNewRoom(Request $request)
    {
        if ($request->name != "") {
            try {
                Room::create([
            "name"     => $request->name,
            "user_id"  => Auth::id()
         ]);
                return $this->successWithData($request->name, "Your Room has been Created Successfully", "Add New Room");
            } catch (Exception $e) {
                return $this->errorResponse($e->getMessage().". \nplease contact your Technolgoy team to solve the issue", "Add New Room");
            }
        } else {
            return $this->errorResponse("Failed", "Add New Room");
        }
    }


    public function getAllRooms()
    {
        return Room::with("users")->get();
    }
    
    
    public function getMyRooms()
    {
        $user = Auth::user()->id;
        return Room::where("user_id", $user)->get();
    }

    public function deleteCurrentRoom($room_id)
    {
        $user = Auth::user()->id;
        try {
            $deletedRoom = Room::where("user_id", $user)->where('id', $room_id)->delete();
            return $this->successWithData($deletedRoom, "Your Room has been Deleted Successfully", "Delete Selected Room");
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage().". \nplease contact your Technolgoy team to solve the issue", "Add New Room");
        }
    }

    public function whoIsOnline($room_id)
    {
        $user = Auth::user()->id;
        $ifUserIsOnline = onlineUser::where("user_id", $user)->count();
        if ($ifUserIsOnline == 0) {
            $onlineUser = onlineUser::create([
                "user_id"     => $user,
                "room_id"     => $room_id,
                "userLogin"   => date("Y-m-d H:i:s")
             ]);
        } else {
            //leave the current room or going to another Room
            $onlienuser = onlineUser::where("user_id", $user)->get()[0];
            onlineUser::where("user_id", $user)->delete();
            $rooms = Room::where("id", $onlienuser->room_id)->withCount('onlineUsers')->get()[0]->online_users_count;
            // dd("Ahmed".$rooms);
            event(new offlineUsersPerRoom($onlienuser->room_id, $rooms));
            $onlineUser = onlineUser::create([
                "user_id"     => $user,
                "room_id"     => $room_id,
                "userLogin"   => date("Y-m-d H:i:s")
             ]);
        }
        $rooms = Room::where("id", $room_id)->withCount('onlineUsers')->get()[0]->online_users_count;
        event(new onlineUsersPerRoom($room_id, $rooms));
        return $rooms;
    }
}
