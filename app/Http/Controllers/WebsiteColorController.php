<?php

namespace App\Http\Controllers;

use App\Models\WebsiteColor;
use Illuminate\Http\Request;

class WebsiteColorController extends Controller
{
    public function index(){
        $color = WebsiteColor::first();
        return view("admin.layouts.pages.website-color.index", compact("color"));
    }

    public function update(Request $request){
        $color = WebsiteColor::first() ?? new WebsiteColor();
        $color->primary_color = $request->primary_color;
        $color->secondary_color = $request->secondary_color;
        $color->background_color = $request->background_color;
        $color->text_color = $request->text_color;
        $color->heading_color = $request->heading_color;
        $color->link_color = $request->link_color;
        $color->link_hover_color = $request->link_hover_color;
        $color->dark_color = $request->dark_color;
        $color->light_color = $request->light_color;
        $color->button_background_color = $request->button_background_color;
        $color->button_hover_color = $request->button_hover_color;
        $color->button_text_color = $request->button_text_color;
        $color->header_background_color = $request->header_background_color;
        $color->header_text_color = $request->header_text_color;
        $color->footer_background_color = $request->footer_background_color;
        $color->footer_text_color = $request->footer_text_color;
        $color->save();
        return response()->json([
            'status' => 'success',
            'message'=> 'Website color updated!',
        ]);
    }
}
