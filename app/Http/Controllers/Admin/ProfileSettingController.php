<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileSettingController extends Controller
{
    public function index(){
        return view("admin.layouts.pages.profile-setting.index");
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Upload folder path
        $uploadFolder = 'uploads/profile_image';
        $uploadPath = public_path($uploadFolder);

        // যদি ফোল্ডার না থাকে, create করুন
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // আগের image delete করুন, যদি থাকে
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        // নতুন image save করুন
        $imageFile = $request->file('image');
        $imageName = time() . '_' . $imageFile->getClientOriginalName();
        $imageFile->move($uploadPath, $imageName);

        $user->image = $uploadFolder . '/' . $imageName;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile image updated successfully!',
            'image_url' => asset($user->image)
        ]);
    }

}
