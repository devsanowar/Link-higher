<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BlogPageController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->where('status', 1)->latest()->paginate(12);
        return view('website.blog-page', compact('posts'));
    }

    public function blogDetails($slug)
    {
        $postDetail = Post::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('website.blog-details', compact('postDetail'));
    }

}
