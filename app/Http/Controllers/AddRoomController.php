<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\Rooms;
use Exception;

class AddRoomController extends Controller
{
    use ResponseTrait;
    public function addNewRoom(Request $request)
    {
        if ($request->name != "") {
            try {
                Rooms::create([
            
            "name" => $request->name
         ]);
                return $this->successWithData($request->name, "Your Group has been Created Successfully", "Add New Room");
            } catch (Exception $e) {
                return $this->errorResponse($e->getMessage().". \nplease contact your Technolgoy team to solve the issue", "Add New Room");
            }
        } else {
            return $this->errorResponse("Failed", "Add New Room");
        }
    }
}
