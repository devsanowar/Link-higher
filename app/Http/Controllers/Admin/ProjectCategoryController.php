<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectCategories = ProjectCategory::latest()->get();
        return view("admin.layouts.pages.project.category.index", compact("projectCategories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:project_categories,slug',
            'status' => 'nullable|in:0,1',
        ]);

        ProjectCategory::create([
            'name'   => $validated['name'],
            'slug'   => $validated['slug'],
            'status' => (int) ($validated['status'] ?? 0),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Project category created successfully.',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:project_categories,slug,' . $id,
            'status' => 'nullable|in:0,1',
        ]);


        ProjectCategory::findOrFail($id)->update([
            'name'   => $validated['name'],
            'slug'   => $validated['slug'],
            'status' => (int) ($validated['status'] ?? 0),
        ]);

        return back()->with('success', 'Project category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProjectCategory::findOrFail($id)->delete();
        return back()->with('success','Category deleted successfully!');
    }
}
