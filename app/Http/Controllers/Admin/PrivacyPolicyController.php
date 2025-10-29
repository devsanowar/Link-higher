<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $privacy_policy = PrivacyPolicy::first();
        return view("admin.layouts.pages.privacy-policy.index", compact('privacy_policy') );
    }

    public function update(Request $request){
        $request->validate([
            'privacy_policy_content' => 'required',
        ]);

        $privacy_policy = PrivacyPolicy::first();
        if(!$privacy_policy){
            $privacy_policy = new PrivacyPolicy();
        }
        $privacy_policy->privacy_policy_content = $request->privacy_policy_content;
        $privacy_policy->save();

        return response()->json([
            'status'=> 'success',
            'message' => 'Privacy Policy updated successfully.'
        ]);
    }
}
