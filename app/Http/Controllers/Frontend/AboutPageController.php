<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About\AboutUs;
use App\Models\About\MissionVision;
use App\Models\About\WhoWeAre;
use App\Models\Achievement;
use App\Models\Employe;
use App\Models\Review;
use App\Models\TrustedClient;

class AboutPageController extends Controller
{
    public function index()
    {
        $missionVision = MissionVision::first();
        $about         = AboutUs::first();
        $achievements   = Achievement::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        $whoWeAre = WhoWeAre::first();
        $clients = TrustedClient::where('status',1)->latest()->get();

        $employes = Employe::where('status', 1)
                    ->orderBy('order','asc')
                    ->latest()->take(4)
                    ->get();

        $reviews = Review::where('status',1)->latest()->get();
        return view("website.about-page", compact("about", "missionVision", "achievements", "whoWeAre", "clients", "employes", "reviews"));
    }
}
