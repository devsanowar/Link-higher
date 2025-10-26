<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqPageController extends Controller
{
    public function index(){
        $faqs = Faq::orderBy("created_at","desc")->get();
        return view("website.faq-page", compact("faqs"));
    }
}
