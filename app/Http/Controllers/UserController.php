<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        $path = public_path()."/images/avatars/";
        $user = Auth::user();
        $image = $request->file("image");
        $images = explode("/", $request->imageType);
        $iamgeName = $user->id.".".$images[1];
        $img = Image::make($image);
        $img->resize(100, 100);
        if (file_exists($path.$iamgeName)) {
            @unlink();
        }
        $img->save($path.$iamgeName);
        $user->avatar = $iamgeName;
        $user->save();
        return $path.$iamgeName;
    }
}
