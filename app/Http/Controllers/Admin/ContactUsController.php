<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Service;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $messages = ContactUs::latest()->get();

        return view("admin.layouts.pages.contact-message.index",compact("messages"));
    }


    public function destroy($id)
    {
        $msg = ContactUs::findOrFail($id);
        $msg->delete();

        return back()->with('success', 'Contact message deleted successfully.');
    }
}
