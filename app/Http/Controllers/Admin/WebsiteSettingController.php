<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteSettingRequest;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::first();
        return view('admin.layouts.pages.website-setting.index', compact('settings'));
    }

    public function update(WebsiteSettingRequest $request)
{
    $websiteSetting = WebsiteSetting::first() ?? new WebsiteSetting();

    $data = $request->only([
        'website_title',
        'website_tag_title',
        'phone_one',
        'phone_two',
        'email_one',
        'email_two',
        'address_one',
        'address_two',
        'footer_copyright_text',
    ]);

    $relativeDir = 'uploads/website_settings/';
    $absoluteDir = public_path($relativeDir);

    if (!File::exists($absoluteDir)) {
        File::makeDirectory($absoluteDir, 0775, true);
    }

    // ✅ নতুন: remove-flag সাপোর্টসহ image handler
    $saveImage = function (string $field, string $suffix) use ($request, $websiteSetting, $absoluteDir, $relativeDir) {
        $removeFlag = 'remove_' . $field;

        // 1) remove-flag এলে পুরনো ফাইল ডিলিট + null
        if ($request->boolean($removeFlag)) {
            if (!empty($websiteSetting->{$field}) && File::exists(public_path($websiteSetting->{$field}))) {
                @unlink(public_path($websiteSetting->{$field}));
            }
            return null;
        }

        // 2) নতুন ফাইল এলে আপডেট (পুরনোটা ডিলিট)
        if ($request->hasFile($field)) {
            if (!empty($websiteSetting->{$field}) && File::exists(public_path($websiteSetting->{$field}))) {
                @unlink(public_path($websiteSetting->{$field}));
            }
            $file = $request->file($field);
            $ext  = strtolower($file->getClientOriginalExtension());
            $name = now()->timestamp . '_' . \Illuminate\Support\Str::random(8) . "_{$suffix}.{$ext}";
            $file->move($absoluteDir, $name);
            return $relativeDir . $name; // DB-তে relative path
        }

        // 3) না remove, না নতুন—পুরনো ভ্যালুই থাক
        return $websiteSetting->{$field};
    };

    $data['website_logo']        = $saveImage('website_logo', 'header');
    $data['website_favicon']     = $saveImage('website_favicon', 'favicon');
    $data['website_footer_logo'] = $saveImage('website_footer_logo', 'footer');

    $websiteSetting->exists ? $websiteSetting->update($data) : $websiteSetting->fill($data)->save();

    // রেসপন্সে নতুন URL/null পাঠাও, যাতে ফ্রন্টএন্ড প্রিভিউ আপডেট করতে পারে
    return response()->json([
        'status'  => 'success',
        'message' => 'Data successfully updated!',
        'data'    => [
            'website_logo'        => $websiteSetting->website_logo ? asset($websiteSetting->website_logo) : null,
            'website_favicon'     => $websiteSetting->website_favicon ? asset($websiteSetting->website_favicon) : null,
            'website_footer_logo' => $websiteSetting->website_footer_logo ? asset($websiteSetting->website_footer_logo) : null,
        ],
    ]);
}

}
