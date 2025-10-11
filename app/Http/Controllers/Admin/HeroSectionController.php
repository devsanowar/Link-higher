<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroSection = HeroSection::first();
        return view("admin.layouts.pages.home-page.hero-section.index", compact("heroSection"));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $hero = HeroSection::first();

        $heroImage = $hero->image ?? null;

        if ($request->hasFile('image')) {

            if (! empty($heroImage) && File::exists(public_path($heroImage))) {
                File::delete(public_path($heroImage));
            }

            $file     = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/hero-section-image'), $fileName);

            $heroImage = 'uploads/hero-section-image/' . $fileName;
        }


        $data = [
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'image'             => $heroImage,
        ];

        if ($hero) {
            $hero->update($data);
        } else {
            $hero = HeroSection::create($data);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Hero section updated successfully!',
            'image'   => asset($hero->image),
        ]);

    }



}
