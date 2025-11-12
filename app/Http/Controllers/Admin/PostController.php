<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('admin.layouts.pages.post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PostCategory::where('status', 1)->latest()->get();
        return view('admin.layouts.pages.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:posts,slug',
            'excerpt'          => 'nullable|string',
            'long_description' => 'required|string',
            'category_id'      => 'nullable|exists:post_categories,id',
            'status'           => 'required|in:0,1',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $post = new Post();

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $post->excerpt = $request->excerpt;
        $post->long_description = $request->long_description;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;

        // upload path
        $uploadPath = public_path('uploads/post_image');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);
            $post->featured_image = 'uploads/post_image/' . $filename;
        }

        $post->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully!',
            // optional: change route name if your admin route differs
            // 'redirectUrl' => route('post.index'),
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
        $post = Post::findOrfail($id);
        $categories = PostCategory::where('status', 1)->latest()->get();
        return view('admin.layouts.pages.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            // ignore current post id when validating unique slug
            'slug'             => ['nullable','string','max:255', Rule::unique('posts','slug')->ignore($post->id)],
            'excerpt'          => 'nullable|string',
            'long_description'          => 'required|string',
            'category_id'      => 'nullable|exists:post_categories,id',
            'status'           => 'required|in:0,1',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $post->excerpt = $request->excerpt;
        $post->long_description = $request->long_description;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;

        $uploadPath = public_path('uploads/post_image');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        if ($request->hasFile('featured_image')) {
            // remove old file if exists
            if (!empty($post->featured_image) && File::exists(public_path($post->featured_image))) {
                File::delete(public_path($post->featured_image));
            }

            $image = $request->file('featured_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);
            $post->featured_image = 'uploads/post_image/' . $filename;
        }

        $post->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successfully!',
            'redirectUrl' => route('post.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        // delete main image
        if (! empty($post->featured_image)) {
            $oldPath = public_path($post->featured_image);
            if (File::exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
    }


}
