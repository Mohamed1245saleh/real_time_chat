<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rooms Routes
Route::Post("/AddNewRoom", [App\Http\Controllers\RoomController::class, 'addNewRoom'])->name('addRoom');
Route::get('/getAllRooms', [App\Http\Controllers\RoomController::class, 'getAllRooms'])->name('allRooms');
Route::get('/getMyRooms', [App\Http\Controllers\RoomController::class, 'getMyRooms'])->name('myRooms');
Route::get('/deleteCurrentRoom/{room_id}', [App\Http\Controllers\RoomController::class, 'deleteCurrentRoom'])->name('deletemyRoom');
Route::get('/whoisonline/{room_id}', [App\Http\Controllers\RoomController::class, 'whoIsOnline'])->name('online_users');
Route::get('/leavingCurrentRoom/{room_id}', [App\Http\Controllers\RoomController::class, 'leavingCurrentRoom'])->name('leavingCurrentUser');


//End of Rooms Routes

//Messages Routes
Route::Post("/AddNewMessage", [App\Http\Controllers\MessagesController::class, 'addNewMessage'])->name('addMessage');

//End of Messages Routes

//User Routes
Route::Post("/uploadAvatar", [App\Http\Controllers\UserController::class, 'uploadAvatar'])->name('uploadAvatar');


//End Of User Routes
Route::Post("/createNewPrivateChat", [App\Http\Controllers\privateRoomController::class, 'privateRoom'])->name('createNewPrivateChat');
Route::Post("/AddNewPrivateMessage", [App\Http\Controllers\privateRoomController::class, 'AddNewPrivateMessage'])->name('AddNewPrivateMessage');

//private Rooms

//End of private rooms