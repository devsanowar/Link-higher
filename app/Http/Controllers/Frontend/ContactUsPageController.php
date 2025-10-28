<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContectMessageStoreRequest;
use App\Models\ContactUs;

class ContactUsPageController extends Controller
{
    public function index()
    {
        return view("website.contact-page");
    }

    public function submit(ContectMessageStoreRequest $request)
    {

        // TODO: এখানে ইমেইল পাঠানো / ডাটাবেজে সেভ করা ইত্যাদি কাজ করো
        ContactUs::create([
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'message' => 'Thank you! Your request has been received.',
        ], 200);
    }
}
