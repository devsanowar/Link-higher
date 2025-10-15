<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmartStrategy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SmartStrategyController extends Controller
{
    public function index()
    {
        $strategy = SmartStrategy::first();
        return view("admin.layouts.pages.home-page.smart-strategy.index", compact("strategy"));
    }

    public function update(Request $request)
{
    $request->validate([
        'title'         => 'required|string|max:255',
        'subtitle'      => 'required|string|max:255',
        'description'   => 'required|string',
        'feature_title' => 'required|string|max:255',
        'features.*'    => 'nullable|string|max:255',
        'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $strategy = SmartStrategy::first() ?? new SmartStrategy();


    $imagePath = $strategy->image;

    if ($request->hasFile('image')) {
        if ($strategy->image && file_exists(public_path($strategy->image))) {
            @unlink(public_path($strategy->image));
        }
        $image     = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/smart-strategy/'), $imageName);
        $imagePath = 'uploads/smart-strategy/'.$imageName;
    }


    $strategy->fill([
        'title'         => $request->title,
        'subtitle'      => $request->subtitle,
        'description'   => $request->description,
        'feature_title' => $request->feature_title,
        'features'      => json_encode($request->features ?? []),
        'image'         => $imagePath,
    ])->save();

    $imageUrl = $imagePath
        ? (Str::startsWith($imagePath, ['http://','https://','/storage']) ? $imagePath : asset($imagePath))
        : null;

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status'    => 'success',
            'message'   => 'Smart Strategy updated successfully.',
            'image_url' => $imageUrl,
        ]);
    }

    return redirect()
        ->route('smart-strategy.index')
        ->with('success', 'Smart Strategy updated successfully.');
}

}
