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

        $WhoWeAre = WhoWeAre::first() ?? new WhoWeAre();


        if ($request->hasFile('image')) {
            if ($WhoWeAre->image && file_exists(public_path($WhoWeAre->image))) {
                @unlink(public_path($WhoWeAre->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/who_we_are/'), $imageName);

            $WhoWeAre['image']   = 'uploads/who_we_are/' . $imageName;
            $WhoWeAre->video_url = null;
        }


        if (! $request->hasFile('image') && $request->filled('video_url')) {
            if ($WhoWeAre->image && file_exists(public_path($WhoWeAre->image))) {
                @unlink(public_path($WhoWeAre->image));
            }
            $WhoWeAre->image     = null;
            $WhoWeAre->video_url = $request->video_url;
        }

        // ফিল্ডস
        $WhoWeAre->name        = $request->name;
        $WhoWeAre->profession  = $request->profession;
        $WhoWeAre->description = $request->description;

        if (isset($WhoWeAre['image'])) {
            $WhoWeAre->image = $WhoWeAre['image'];
        }

        $WhoWeAre->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data updated successfully!',
        ]);
    }

}
