<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Models\ReturnRefund;

class LegalController extends Controller
{
    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('website.layouts.pages.legal.privacy-policy', compact('privacyPolicy'));
    }

    public function termsAndCondition(){
        $termsAndCondition = TermsAndCondition::first();
        return view('website.layouts.pages.legal.terms-and-condition', compact('termsAndCondition'));
    }

    public function returnRefund(){
        $returnRefund = ReturnRefund::first();
        return view('website.layouts.pages.legal.return-refund', compact('returnRefund'));
    }
}
