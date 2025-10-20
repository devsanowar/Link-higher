<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CtaController extends Controller
{
    public function index(){
        $cta =  Cta::first();
        return view("admin.layouts.pages.home-page.cta.index", compact("cta"));
    }

    public function update(Request $request){

        $request->validate([
            'title'            => ['nullable', 'string'],
            'content'          => ['nullable', 'string'],
            'button_one_name'  => ['nullable', 'string', 'max:255'],
            'button_one_url'   => ['nullable', 'string', 'url', 'max:255'],
            'button_two_name'  => ['nullable', 'string', 'max:255'],
            'button_two_url'   => ['nullable', 'string', 'url', 'max:255'],
        ]);

        $cta = Cta::first() ?? new Cta();

        $cta->title = $request->title;
        $cta->description = $request->description;
        $cta->button_one_name = $request->button_one_name;
        $cta->button_one_url = $request->button_one_url;
        $cta->button_two_name = $request->button_two_name;
        $cta->button_two_url = $request->button_two_url;
        $cta->save();

        return response()->json([
            "status"=> "success",
            "message"=> "Cta updated successfully.",
        ]);
    }
}
