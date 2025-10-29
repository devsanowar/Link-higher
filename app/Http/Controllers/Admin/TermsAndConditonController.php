<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;

class TermsAndConditonController extends Controller
{
    public function index(){
        $termsAndCondition = TermsAndCondition::first();
        return view("admin.layouts.pages.terms-and-condition.index", compact("termsAndCondition"));
    }

    public function update(Request $request){
        $request->validate([
            'terms_and_conditions' => 'required',
        ]);

        $termsAndCondition = TermsAndCondition::first();
        if (!$termsAndCondition) {
            $termsAndCondition = new TermsAndCondition();
        }
        $termsAndCondition->terms_and_conditions = $request->terms_and_conditions;
        $termsAndCondition->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Terms and Conditions updated successfully.'
        ], 200);
    }
}
