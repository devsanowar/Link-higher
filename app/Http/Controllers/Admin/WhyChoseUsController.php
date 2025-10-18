<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChoseUs;
use Illuminate\Http\Request;

class WhyChoseUsController extends Controller
{
    public function index(){
        $reason = WhyChoseUs::first();
        return view("admin.layouts.pages.home-page.why-chose-us.index",compact("reason"));
    }

    public function update(Request $request){
        $reason = WhyChoseUs::first() ?? new WhyChoseUs();

        $request->validate([
            'title' => ['required','string'],
            'subtitle' => ['nullable','string'],
            'description' => ['required','string'],
        ]);

        $reason->title = $request->title;
        $reason->subtitle = $request->subtitle;
        $reason->description = $request->description;
        $reason->save();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Why Chose Us updated successfully.',
        ]);

    }
}
