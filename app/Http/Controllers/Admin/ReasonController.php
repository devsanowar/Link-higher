<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reasons = Reason::all();
        return view("admin.layouts.pages.home-page.why-chose-us.reason.index", compact("reasons"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.home-page.why-chose-us.reason.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'     => ['nullable', 'in:0,1'],
        ]);

        if ($request->image) {
            $image     = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/reason/'), $imageName);
            $validated['image'] = 'uploads/reason/' . $imageName;
        }

        $reason = Reason::create([
            'title'       => $validated['title'],
            'description'     => $validated['description'],
            'image'      => $validated['image'] ?? null,
            'status'     => (int) ($validated['status'] ?? 1),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Reason created successfully.',
            'data'    => $reason,
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
        $reason = Reason::findOrFail($id);
        return view("admin.layouts.pages.home-page.why-chose-us.reason.edit", compact("reason"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reason = Reason::findOrFail($id);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'status'     => ['nullable', 'in:0,1'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($reason->image && file_exists(public_path($reason->image))) {
                unlink(public_path($reason->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/reason/'), $imageName);
            $validated['image'] = 'uploads/reason/' . $imageName;
        }

        // ডাটাবেজ আপডেট
        $reason->update([
            'title'       => $validated['title'],
            'description'     => $validated['description'],
            'image'      => $validated['image'] ?? $reason->image,
            'status'     => (int) ($validated['status'] ?? $reason->status),
        ]);

        $redirectUrl = route('home.reason.index');

        return response()->json([
            'status'  => 'success',
            'message' => 'Review updated successfully.',
            'data'    => $reason,
            'redirect' => $redirectUrl,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reason = Reason::findOrFail($id);
        if ($reason->image && file_exists(public_path($reason->image))) {
            unlink(public_path($reason->image));
        }
        $reason->delete();

        return redirect()->route('home.reason.index')->with('success', 'Reason deleted successfully.');
    }
    
}
