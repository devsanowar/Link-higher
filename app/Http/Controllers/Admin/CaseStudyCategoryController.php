<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CaseStudyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CaseStudyCategory::orderBy('id', 'DESC')->get();
        return view("admin.layouts.pages.case-study.category.category", compact('categories'));
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

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique((new CaseStudyCategory)->getTable(), 'category_slug'),
            ],
            'status'        => 'required|in:0,1',
        ]);

        CaseStudyCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug ?? Str::slug($request->category_name),
            'status'        => (int) $request->status,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Category created successfully!',
        ], 201);
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
    public function update(Request $request, $id)
    {
        $category = CaseStudyCategory::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_slug' => 'nullable|string|max:255|unique:case_study_categories,category_slug,' . $category->id,
            'status'        => 'required|in:0,1',
        ]);

        $category->category_name = $request->category_name;
        $category->category_slug = $request->category_slug ?: Str::slug($request->category_name);
        $category->status        = (int) $request->status;
        $category->save();

        return redirect()
            ->back()
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CaseStudyCategory::findOrFail($id);
        $category->delete();

        return redirect()
            ->back()
            ->with('success', 'Category deleted successfully!');
    }
}
