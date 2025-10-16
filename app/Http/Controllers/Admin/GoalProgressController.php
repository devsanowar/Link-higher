<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoalProgress;
use App\Models\GoalProgressInsightSectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GoalProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = GoalProgress::all();
        $sectionTitle = GoalProgressInsightSectionTitle::first();
        return view("admin.layouts.pages.home-page.goal-progress-insight.index", compact("items", "sectionTitle"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.home-page.goal-progress-insight.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ]);

        $goal              = new GoalProgress();
        $goal->title       = $request->title;
        $goal->description = $request->description;

        $uploadPath = public_path('uploads/goal_progress');

        // if (! file_exists($uploadPath)) {
        //     mkdir($uploadPath, 0755, true);
        // }

        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $path        = 'uploads/goal_progress/' . $filename;
            $goal->image = $path;
        }

        $goal->status = $request->status;

        $goal->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Goal progress created successfully!',
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
        $goal = GoalProgress::find($id);
        return view('admin.layouts.pages.home-page.goal-progress-insight.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ]);

        $goal = GoalProgress::findOrFail($id);

        $goal->title       = $request->title;
        $goal->description = $request->description;
        $goal->status      = $request->status;

        $uploadPath = public_path('uploads/goal_progress');

        if ($request->hasFile('image')) {
            if ($goal->image && File::exists(public_path($goal->image))) {
                File::delete(public_path($goal->image));
            }

            // upload new image
            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $goal->image = 'uploads/goal_progress/' . $filename;
        }

        $goal->save();

        $redirectUrl = route('home.goal-progress-insight.index');

        return response()->json([
            'status'   => 'success',
            'message'  => 'Goal progress updated successfully!',
            'redirect' => $redirectUrl,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $goal = GoalProgress::findOrFail($id);

        if ($goal->image && File::exists(public_path($goal->image))) {
            File::delete(public_path($goal->image));
        }

        $goal->delete();
        return redirect()->route('home.goal-progress-insight.index')->with('success', 'Goal progress successfully deleted!');
    }


    public function updateTitle(Request $request){
        $goal = GoalProgressInsightSectionTitle::first() ?? new GoalProgressInsightSectionTitle();

        $request->validate([
            'section_title' => ['required','string'],
            'section_subtitle' => ['nullable','string'],
        ]);

        $goal->section_title = $request->section_title;
        $goal->section_subtitle = $request->section_subtitle;
        $goal->save();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Section title updated',
        ]);
    }
}
