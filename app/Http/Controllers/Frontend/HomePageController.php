<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cta;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Reason;
use App\Models\Review;
use App\Models\Product;
use App\Models\Service;
use App\Models\CaseStudy;
use App\Models\WhyChoseUs;
use App\Models\Achievement;
use App\Models\HeroSection;
use App\Models\GoalProgress;
use Illuminate\Http\Request;
use App\Models\SmartSolution;
use App\Models\SmartStrategy;
use App\Models\TrustedClient;
use App\Models\SmarterWorkflow;
use App\Models\CustomerFocusTone;
use App\Http\Controllers\Controller;
use App\Models\SmartSolutionFeature;
use App\Models\SmarterWorkflowsImage;
use App\Models\GoalProgressInsightSectionTitle;

class HomePageController extends Controller
{
    public function index(){
        $hero = HeroSection::first();
        $services = Service::all();
        $smartStrategy = SmartStrategy::first();
        $smarterWorkFlowImage = SmarterWorkflowsImage::first();
        $smarterWorkFlows = SmarterWorkflow::all();
        $goalProgressSectionTitile = GoalProgressInsightSectionTitle::first();
        $goalProgesses = GoalProgress::all();
        $smartSolution = SmartSolution::first();
        $smartSolutionFeatures = SmartSolutionFeature::where('status', 1)->latest()->get();
        $whyChoseUs = WhyChoseUs::first();
        $reasons = Reason::where('status', 1)->latest()->get();
        $customerFocusTone = CustomerFocusTone::first();
        $reviews = Review::where('status',1)->latest()->get();
        $clients = TrustedClient::where('status',1)->latest()->get();
        $faqs = Faq::where('status',1)->latest()->get();
        $cta = Cta::first();
        $caseStudies = CaseStudy::with('service')->where('status', 1)->latest()->get();
        $posts = Post::with(['category','user'])->where('status', 1)->latest()->take(15)->get();

        $sites = Product::with('category')
                ->where('status', 1)
                ->latest()
                ->take(10)
                ->get();

        return view("website.home", compact("hero","services", "smartStrategy", "smarterWorkFlowImage", "smarterWorkFlows", "goalProgressSectionTitile", "goalProgesses", "smartSolution", "smartSolutionFeatures", "whyChoseUs", "reasons", "customerFocusTone", "reviews", "clients", "faqs", "cta", "caseStudies", "posts", "sites"));
    }
}
