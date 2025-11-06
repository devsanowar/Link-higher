<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\PackagePlan;
use Illuminate\Http\Request;

class ServicePlanController extends Controller
{
    public function servicePlanDetails($id){
        $package = PackagePlan::with('service')->findOrFail($id);
        $faqs = Faq::where('status', 1)->get();
        return view('website.service-plan-details', compact('package','faqs'));
    }
}
