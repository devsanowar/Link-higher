<?php
namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\About\WhoWeAre;
use Illuminate\Http\Request;

class WhoWeAreController extends Controller
{
    public function index()
    {
        $whoWeAre = WhoWeAre::first();
        return view("admin.layouts.pages.about-page.who-we-are.index", compact("whoWeAre"));
    }

    public function update(Request $request)
{
    $request->validate([
        "name"        => ["required", "string"],
        "profession"  => ["required", "string"],
        "description" => ["nullable", "string"],
        'video_url'   => ['nullable', 'url'],
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $whoWeAre = WhoWeAre::first() ?? new WhoWeAre();

    if ($request->hasFile('image')) {
        if ($whoWeAre->image && file_exists(public_path($whoWeAre->image))) {
            @unlink(public_path($whoWeAre->image));
        }

        $image     = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/who_we_are/'), $imageName);

        $whoWeAre->image = 'uploads/who_we_are/' . $imageName;
    }

    if ($request->filled('video_url')) {
        $whoWeAre->video_url = $request->video_url;
    }


    $whoWeAre->name        = $request->name;
    $whoWeAre->profession  = $request->profession;
    $whoWeAre->description = $request->description;

    $whoWeAre->save();

    return response()->json([
        'status'  => 'success',
        'message' => 'Data updated successfully!',
    ]);
}


}
