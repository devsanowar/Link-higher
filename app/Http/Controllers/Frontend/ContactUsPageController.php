<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use App\Models\ContactUs;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContectMessageStoreRequest;

class ContactUsPageController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view("website.contact-page", compact("services"));
    }

    public function submit(ContectMessageStoreRequest $request)
    {

        // TODO: এখানে ইমেইল পাঠানো / ডাটাবেজে সেভ করা ইত্যাদি কাজ করো
        ContactUs::create([
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'service_name'   => $request->input('service_name'),
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'message' => 'Thank you! Your request has been received.',
        ], 200);
    }
}
