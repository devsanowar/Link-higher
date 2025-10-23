<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::where('status', 1)->latest()->paginate(8);
        return view("website.project", compact("projects"));
    }

    public function projectDetails($id){
        $project = Project::findOrFail($id);
        return view("website.project-details", compact("project"));
    }
}
