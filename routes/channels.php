<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\PrivateChatRoom;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
// Broadcast::channel('room', function ($user) {
//     return Auth::check();
// });

Broadcast::channel('privateChatRoom{senderId}-{receiverId}', function ($user,$senderId ,$receiverId) {
    return  PrivateChatRoom::where("sender_id" , $user->id)->where("receiver_id" , $receiverId)->count();
});