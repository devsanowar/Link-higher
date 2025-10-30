<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\PackagePlan;
use Illuminate\Http\Request;
use App\Models\TrustedClient;
use App\Http\Controllers\Controller;

class PricingPageController extends Controller
{
    public function index(){
        $packages = PackagePlan::orderBy('position', 'ASC')->get();
        $clients = TrustedClient::where('status', 1)->get();
        $faqs = Faq::where('status', 1)->get();
        return view('website.pricing-page', compact('packages', 'clients', 'faqs'));
    }
}
