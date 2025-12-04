<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\SupportRequest;
use App\Models\WebsiteSetting;
use App\Mail\SupportRequestMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportRequestThankYouMail;

class SupportController extends Controller
{
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'phone'   => 'required|string|max:50',
    //         'message' => 'required|string',
    //     ]);

    //     // ডাটাবেজে সেভ
    //     $support = SupportRequest::create($data);

    //     // চাইলে ইমেইল পাঠাতে পারো (optional)
    //     Mail::to('sanowargiit22@gmail.com')->send(new SupportRequestMail($support));

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Support request created',
    //     ]);
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:50',
            'service_type' => 'nullable|string|max:100',
            'website_url'  => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:100',
            'message'      => 'required|string',
        ]);

        // DB তে save
        $support = SupportRequest::create($data);

        $settings = WebsiteSetting::select('website_title')->first();
        $siteName = $settings->website_title ?? config('app.name');

        // 1️⃣ Admin / Agency email এ notification
        Mail::to('sanowargiit22@gmail.com')
            ->queue(new SupportRequestMail($support));

        // 2️⃣ Client কে Thank You mail (যদি email দেয়)
        if (! empty($support->email)) {
            Mail::to($support->email)
                ->queue(new SupportRequestThankYouMail($support, $siteName));
        }

        return response()->json([
            'success' => true,
            'message' => 'Support request created',
        ]);
    }
}
