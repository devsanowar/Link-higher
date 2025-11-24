<?php

namespace App\Http\Controllers\Frontend;

use App\Models\PartnerSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerSiteController extends Controller
{
    public function index(){
        $sites = PartnerSite::where('status', 1)->latest()->get();
        return view('website.footer', compact('sites'));
    }
}
