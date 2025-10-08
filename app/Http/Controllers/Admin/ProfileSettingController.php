<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function profileInfoUpdate(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'    => ['required','string','max:255'],
            'email'   => [
                'required','email','max:255',
                Rule::unique('users','email')->ignore($user->id), // ignore current user
            ],
            'phone'   => ['nullable','string','max:30'],
            'address' => ['nullable','string','max:255'],
            'about'   => ['nullable','string','max:5000'],
        ]);

        $user->fill($validated)->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Profile updated successfully.',
            'data'    => [
                'name'    => $user->name,
                'email'   => $user->email,
                'phone'   => $user->phone,
                'address' => $user->address,
                'about'   => $user->about,
            ],
        ]);
    }


    public function passwordUpdate(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',                     // matches password_confirmation
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),          // checks haveibeenpwned
            ],
        ]);

        $user->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();


        return response()->json([
            'status'  => 'success',
            'message' => 'Password updated successfully.',
        ]);
    }

}
