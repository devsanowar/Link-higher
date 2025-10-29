<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
