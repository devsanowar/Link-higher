<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\About\MissionVision;
use Illuminate\Http\Request;

class MissionAndVissionController extends Controller
{
    public function index(){
        $missionAndVission = MissionVision::first();
        return view("admin.layouts.pages.about-page.mission-vision.index", compact("missionAndVission"));
    }

    public function update(Request $request){
        $request->validate([
            "mission_title" =>["nullable","string"],
            "vision_title" => ["nullable","string"],
            "mission" => ["nullable","string"],
            "vision" => ["nullable","string"],
        ]);

        $missionAndVission = MissionVision::first() ?? new MissionVision();
        $missionAndVission->fill($request->all());
        $missionAndVission->save();
        return response()->json([
            "status" => "success",
            "message"=> "Data successfully updated!",
        ]);
    }
}
