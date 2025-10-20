<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $hero = HeroSection::first();
        return view("website.home", compact("hero"));
    }
}
