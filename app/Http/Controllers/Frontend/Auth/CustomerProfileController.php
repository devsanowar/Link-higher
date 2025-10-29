<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => ['nullable', 'string', 'max:255'],
            'email'   => [
                'nullable', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'   => ['nullable', 'string', 'max:255'],
            'about'   => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        // Normalize email (optional but recommended)
        if ($request->filled('email')) {
            $validated['email'] = strtolower(trim($request->email));
        }

        $user->update($validated);

        return response()->json([
            "status"  => "success",
            "message" => "User updated successfully.",
        ]);
    }

    public function profileImageUpdate(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Upload folder path
        $uploadFolder = 'uploads/profile_image';
        $uploadPath   = public_path($uploadFolder);

        // যদি ফোল্ডার না থাকে, create করুন
        if (! file_exists($uploadPath)) {
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
            'status'    => 'success',
            'message'   => 'Profile image updated successfully!',
            'image_url' => asset($user->image),
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        // current password verify
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optional: Auth check
        if ($user->id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $user->delete(); // যদি soft delete না থাকে, তাহলে একদম মুছে যাবে
        Auth::logout();

        return redirect()->route('customer.register')->with('success', 'Your account has been deleted successfully.');
    }

}
