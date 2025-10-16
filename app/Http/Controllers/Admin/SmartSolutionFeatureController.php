<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmartSolutionFeature;
use Illuminate\Http\Request;

class SmartSolutionFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = SmartSolutionFeature::all();
        return view("admin.layouts.pages.home-page.smart-solution.features.index", compact("features"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.home-page.smart-solution.features.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'feature_title'       => 'required|string|max:255',
            'feature_description' => 'required|string',
            'status'              => 'required|in:0,1',
        ]);

        $feature                      = new SmartSolutionFeature();
        $feature->feature_title       = $request->feature_title;
        $feature->feature_description = $request->feature_description;
        $feature->status              = $request->status;

        $feature->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Feature created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature = SmartSolutionFeature::find($id);
        return view('admin.layouts.pages.home-page.smart-solution.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'feature_title'       => 'required|string|max:255',
            'feature_description' => 'required|string',
            'status'              => 'required|in:0,1',
        ]);

        $feature = SmartSolutionFeature::findOrFail($id);

        $feature->feature_title       = $request->feature_title;
        $feature->feature_description = $request->feature_description;
        $feature->status              = $request->status;

        $feature->save();

        $redirectUrl = route('home.smart-solution-features.index');

        return response()->json([
            'status'  => 'success',
            'message' => 'Feature updated successfully!',
            'redirect' => $redirectUrl
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = SmartSolutionFeature::findOrFail($id);
        $feature->delete();
        return redirect()->back()->with('success', 'Features deleted successfully!');
    }
}
