<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return view("admin.layouts.pages.review.index", compact("reviews"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.review.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'review'     => ['required', 'string'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'     => ['nullable', 'in:0,1'],
        ]);

        if ($request->image) {
            $image     = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/review/'), $imageName);
            $validated['image'] = 'uploads/review/' . $imageName;
        }

        $review = Review::create([
            'name'       => $validated['name'],
            'profession' => $validated['profession'],
            'review'     => $validated['review'],
            'image'      => $validated['image'] ?? null,
            'status'     => (int) ($validated['status'] ?? 1),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Review created successfully.',
            'data'    => $review,
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
        $review = Review::findOrFail($id);
        return view("admin.layouts.pages.review.edit", compact("review"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'review'     => ['required', 'string'],
            'status'     => ['nullable', 'in:0,1'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($review->image && file_exists(public_path($review->image))) {
                unlink(public_path($review->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/review/'), $imageName);
            $validated['image'] = 'uploads/review/' . $imageName;
        }

        // ডাটাবেজ আপডেট
        $review->update([
            'name'       => $validated['name'],
            'profession' => $validated['profession'],
            'review'     => $validated['review'],
            'image'      => $validated['image'] ?? $review->image,
            'status'     => (int) ($validated['status'] ?? $review->status),
        ]);

        $redirectUrl = route('reviews.index');

        return response()->json([
            'status'  => 'success',
            'message' => 'Review updated successfully.',
            'data'    => $review,
            'redirect' => $redirectUrl,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        if ($review->image && file_exists(public_path($review->image))) {
            unlink(public_path($review->image));
        }
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
