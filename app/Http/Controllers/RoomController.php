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
        \DB::connection()->enableQueryLog();
        $user = Auth::user()->id;
        $userName = Auth::user()->name;
        $ifUserIsOnline = onlineUser::where("user_id", $user)->where("room_id", $room_id)->count();
        if ($ifUserIsOnline == 0) {
            $onlineUser = onlineUser::create([
                "user_id"     => $user,
                "room_id"     => $room_id,
                "userLogin"   => date("Y-m-d H:i:s")
             ]);
        }
        $rooms = Room::where("id", $room_id)->withCount('onlineUsers')->get()[0]->online_users_count;
        $onlineUsersDataPerRoom = onlineUser::with('onlineUsers')->where("room_id", $room_id)->get()->pluck('onlineUsers');
        event(new onlineUsersPerRoom($room_id, $rooms, $onlineUsersDataPerRoom, $userName." has joined the room"));
        return $rooms;
    }

    public function leavingCurrentRoom($room_id)
    {
        $userId = Auth::user()->id;
        $userName = Auth::user()->name;
        $onlienuser = onlineUser::where("user_id", $userId)->get()[0];
        $deletedUser = onlineUser::where("user_id", $userId)->where("room_id", $room_id)->delete();
        $rooms = Room::where("id", $onlienuser->room_id)->withCount('onlineUsers')->get()[0]->online_users_count;
        event(new offlineUsersPerRoom($onlienuser->room_id, $rooms, $userName." has left the room"));
        $onlineUsersDataPerRoom = onlineUser::with('onlineUsers')->where("room_id", $room_id)->get()->pluck('onlineUsers');
        return $deletedUser;
    }
}
