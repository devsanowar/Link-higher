<?php
namespace App\Http\Controllers\Admin;

use App\Models\PartnerSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerSiteRequest;
use App\Http\Requests\UpdatePartnerSiteRequest;

class SiteListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = PartnerSite::latest()->get();
        return view('admin.layouts.pages.partner-site-list.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerSiteRequest $request)
    {
        PartnerSite::create([
            'site_name' => $request->site_name,
            'site_url'  => $request->site_url,
            'status'    => $request->status,
        ]);

        return redirect()->back()->with('success', 'Partner site added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerSiteRequest $request, string $id)
    {
        $site = PartnerSite::findOrFail($id);

        $site->update([
            'site_name' => $request->site_name,
            'site_url'  => $request->site_url,
            'status'    => $request->status,
        ]);

        return redirect()->back()->with('success', 'Partner site updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $site = PartnerSite::findOrfail($id);
        $site->delete();

        return redirect()->back()->with('success', 'Partner site deleted successfully!');
    }
}
