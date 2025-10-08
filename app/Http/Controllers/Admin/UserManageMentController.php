<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'system_admin'     => ['nullable', 'in:user,admin,customer,editor'],
            'phone'    => ['nullable', 'string', 'max:30'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'system_admin'      => $validated['system_admin'] ?? 'editor',
            'status'   => $validated['status'] ?? 'active',
            'phone'    => $validated['phone'] ?? null,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'User created successfully.',
            'data'    => $user->only(['id', 'name', 'email', 'system_admin']),
        ]);
    }
}
