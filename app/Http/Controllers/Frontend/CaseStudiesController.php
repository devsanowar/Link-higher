<?php

namespace App\Http\Controllers\Frontend;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseStudiesController extends Controller
{
    public function index(){
        $caseStudies = CaseStudy::with('service')->where('status', 1)->latest()->paginate(9);

        return view('website.case-study', compact('caseStudies'));
    }


    public function caseDetails($id){
        $caseStudy = CaseStudy::findOrFail($id);
        return view('website.case-study-details', compact('caseStudy'));
    }

}
