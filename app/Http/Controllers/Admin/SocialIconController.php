<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialUpdateRequest;
use App\Models\SocialIcon;

class SocialIconController extends Controller
{
    public function index()
    {
        $social = SocialIcon::first();
        return view("admin.layouts.pages.social-icon.index", compact("social"));
    }

    public function update(SocialUpdateRequest $request)
    {
        $social = SocialIcon::first() ?? new SocialIcon();

        $social->facebook_url    = $request->facebook_url;
        $social->linkedin_url    = $request->linkedin_url;
        $social->instagram_url   = $request->instagram_url;
        $social->twitter_url     = $request->twitter_url;
        $social->pinterest_url   = $request->pinterest_url; // ← fix name if you renamed
        $social->google_plus_url = $request->google_plus_url;

        $social->save();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Social icons updated successfully',
                'data'    => $social,
            ], 200);
        }

        return redirect()
            ->route('social.icon.index')
            ->with('success', 'Social icons updated successfully');
    }

}
