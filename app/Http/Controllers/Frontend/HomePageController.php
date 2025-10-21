<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Service;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $hero = HeroSection::first();
        $services = Service::all();
        return view("website.home", compact("hero","services"));
    }
}
