<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServicePageController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view("website.service-page", compact("services"));
    }

    public function serviceDetails($id)
    {

        $service = Service::find($id);

        $otherServices = Service::query()
            ->where('id', '!=', $service->id)
            ->where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        return view("website.service-details", compact("service", "otherServices"));
    }
}
