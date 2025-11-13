<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SitePageController extends Controller
{
    public function index(){
        $sites = Product::with('category')
                ->where('status', 1)
                ->latest()
                ->get();

        return view('website.site-page', compact('sites'));
    }
}
