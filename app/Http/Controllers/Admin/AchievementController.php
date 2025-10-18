<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::all();
        return view("admin.layouts.pages.home-page.achievement.index", compact("achievements"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.home-page.achievement.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'count_value' => ['required', 'numeric'],
            'order'       => ['required', 'numeric', 'unique:achievements,order'],
            'status'      => ['required', 'in:0,1'],
        ]);

        Achievement::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Achievement created successfully',
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
        $achievement = Achievement::find($id);
        return view('admin.layouts.pages.home-page.achievement.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'count_value' => ['required', 'numeric'],
            'order'       => ['required', 'numeric', 'unique:achievements,order,' . $id],
            'status'      => ['required', 'in:0,1'],
        ]);

        $achievement = Achievement::findOrFail($id);

        $achievement->update([
            'title'       => $request->title,
            'count_value' => $request->count_value,
            'order'       => $request->order,
            'status'      => $request->status,
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => 'Achievement updated successfully.',
            'redirect' => route('home.achievements.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();
        return redirect()->route('home.achievements.index')->with('success', 'Achievement deleted successfully !');
    }
}
