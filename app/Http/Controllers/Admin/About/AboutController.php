<?php
namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\About\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view("admin.layouts.pages.about-page.about-section.index", compact("about"));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $about = AboutUs::first() ?? new AboutUs();

        $imagePath = $about->image;

        if ($request->hasFile('image')) {
            if ($about->image && file_exists(public_path($about->image))) {
                @unlink(public_path($about->image));
            }
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about-us/'), $imageName);
            $imagePath = 'uploads/about-us/' . $imageName;
        }



        $about->title = $request->title;
        $about->description = $request->description;
        $about->image = $imagePath;

        $about->save();

        return response()->json([
            'status'=> 'success',
            'message' => 'About Us successfully updated!'
        ]);

    }
}
