<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserManageMentController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("admin.layouts.pages.users.index", compact("users"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password'     => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'system_admin' => ['nullable', 'in:user,admin,customer,editor'],
            'phone'        => ['nullable', 'string', 'max:30'],
        ]);

        $user = User::create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
            'system_admin' => $validated['system_admin'] ?? 'editor',
            'status'       => $validated['status'] ?? 'active',
            'phone'        => $validated['phone'] ?? null,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'User created successfully.',
            'data'    => $user->only(['id', 'name', 'email', 'system_admin']),
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.layouts.pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $roleEnum = ['admin', 'editor', 'user'];

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'        => ['nullable', 'string', 'max:20'],
            'password'     => ['nullable', 'confirmed', 'min:8'],
            'system_admin' => ['required', Rule::in($roleEnum)],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // পাসওয়ার্ড খালি হলে টাচ করব না
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        // ইমেজ আপডেট হ্যান্ডলিং (public/uploads/profile_image)
        if ($request->hasFile('image')) {
            $uploadDir = public_path('uploads/profile_image');

            // ফোল্ডার না থাকলে তৈরি করো
            if (! File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }

            // পুরনো ইমেজ ডিলিট (যদি থাকে এবং path valid হয়)
            if (! empty($user->image) && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $file     = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);

            // DB-তে relative path রাখছি যাতে asset() দিয়ে ঠিকমত লোড হয়
            $validated['image'] = 'uploads/profile_image/' . $fileName;
        }

        // আপডেট
        $user->update($validated);

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $hero = User::findOrFail($id);

        if ($hero->image && File::exists(public_path($hero->image))) {
            File::delete(public_path($hero->image));
        }

        $hero->delete();

        return redirect()->back()->with('success', 'Hero Section Deleted Successfully.');
    }
}
