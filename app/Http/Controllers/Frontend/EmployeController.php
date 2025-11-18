<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function employePage(){
        $employes = Employe::where('status', 1)->orderByRaw("ISNULL(`order`), `order` ASC")->get();
        return view('website.employe-page', compact('employes'));
    }
}
