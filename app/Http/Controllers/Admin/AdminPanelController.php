<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminPanelController extends Controller
{
    public function index()
    {
        $loginpage = AdminPanel::first();
        return view("admin.layouts.pages.login-page.index", compact("loginpage"));
    }

    public function update(Request $request)
    {
        $request->validate([
            'login_page_bg_color' => 'nullable|string|max:255', // e.g., rgba(255,255,255,1)
            'login_page_bg'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        if (! $request->hasFile('login_page_bg') && ! $request->filled('login_page_bg_color')) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Please provide either a background color or an image.',
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                // get or create a single row
                $panel = AdminPanel::query()->first();

                if (! $panel) {
                    $panel = new AdminPanel();
                }

                // if image is uploaded -> image wins, color cleared
                if ($request->hasFile('login_page_bg')) {
                    // delete old image file if exists
                    if (! empty($panel->login_page_bg)) {
                        $oldPath = public_path($panel->login_page_bg);
                        if (is_file($oldPath)) {
                            @unlink($oldPath);
                        }

                    }

                    $image    = $request->file('login_page_bg');
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $dir      = public_path('uploads/login_page');
                    if (! is_dir($dir)) {
                        @mkdir($dir, 0755, true);
                    }
                    $image->move($dir, $filename);

                    // save relative path so asset() works
                    $panel->login_page_bg       = 'uploads/login_page/' . $filename;
                    $panel->login_page_bg_color = null; // mutually exclusive
                    $panel->save();

                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Login page image updated successfully.',
                    ]);
                }

                // else if color provided -> color wins, image cleared
                if ($request->filled('login_page_bg_color')) {
                    // remove image file & null the column
                    if (! empty($panel->login_page_bg)) {
                        $oldPath = public_path($panel->login_page_bg);
                        if (is_file($oldPath)) {
                            @unlink($oldPath);
                        }

                    }

                    $panel->login_page_bg       = null;
                    $panel->login_page_bg_color = $request->login_page_bg_color;
                    $panel->save();

                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Login page color updated successfully.',
                    ]);
                }

                // fallback (shouldn’t hit)
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Nothing to update.',
                ], 422);
            });
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
