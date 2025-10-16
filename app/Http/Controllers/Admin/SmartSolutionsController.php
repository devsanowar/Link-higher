<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmartSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SmartSolutionsController extends Controller
{
    public function index()
    {
        $smartSolution = SmartSolution::first();
        return view("admin.layouts.pages.home-page.smart-solution.index", compact("smartSolution"));
    }

    public function update(Request $request)
    {

        $smartSolution = SmartSolution::first() ?? new SmartSolution();

        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'subtitle'    => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image_one'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:1024'],
            'image_two'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:1024'],
        ]);

        $uploadDir = public_path('uploads/smart_solution');

        if (! File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        // ---------- Image One ----------
        if ($request->hasFile('image_one')) {
            if (! empty($smartSolution->image_one) && File::exists(public_path($smartSolution->image_one))) {
                File::delete(public_path($smartSolution->image_one));
            }

            $image    = $request->file('image_one');
            $filename = now()->timestamp . '_' . Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);

            $smartSolution->image_one = 'uploads/smart_solution/' . $filename;
        }

        // ---------- Image Two ----------
        if ($request->hasFile('image_two')) {
            if (! empty($smartSolution->image_two) && File::exists(public_path($smartSolution->image_two))) {
                File::delete(public_path($smartSolution->image_two));
            }

            $image    = $request->file('image_two');
            $filename = now()->timestamp . '_' . Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);

            $smartSolution->image_two = 'uploads/smart_solution/' . $filename;
        }

        // Text fields
        $smartSolution->title       = $request->title;
        $smartSolution->subtitle    = $request->subtitle;
        $smartSolution->description = $request->description;

        $smartSolution->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Smart solution updated successfully.',
        ]);
    }
}
