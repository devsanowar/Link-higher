<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackagePlan;
use Illuminate\Http\Request;

class PackagePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = PackagePlan::all();
        return view("admin.layouts.pages.package-plan.index", compact("plans"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.package-plan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:120',
            'slug'                => 'required|string|max:120|unique:package_plans,slug',
            'subtitle'            => 'nullable|string|max:500',
            'cta_text'            => 'nullable|string|max:120',
            'cta_url'             => 'nullable|string|max:255',
            'currency'            => 'required|string|size:3',
            'monthly_amount'      => 'required|numeric|min:0',
            'yearly_amount'       => 'required|numeric|min:0',
            'monthly_label'       => 'nullable|string|max:10',
            'yearly_label'        => 'nullable|string|max:10',
            'yearly_save_percent' => 'nullable|integer|min:0|max:100',
            'yearly_save_text'    => 'nullable|string|max:160',
            'trial_days'          => 'nullable|integer|min:0',
            'money_back_days'     => 'nullable|integer|min:0',
            'position'            => 'nullable|integer|unique:package_plans,position',
            'features'            => 'nullable|string', // JSON string
            'is_free'             => 'nullable|boolean',
            'is_popular'          => 'nullable|boolean',
            'is_active'           => 'nullable|boolean',
        ]);

        $validated['features']   = $validated['features'] ?: '[]';
        $validated['is_free']    = $request->boolean('is_free');
        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['is_active']  = (int) $request->input('is_active', 1);

        $plan = PackagePlan::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Package Plan created successfully!',
            'id'      => $plan->id,
        ]);
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
        $plan = PackagePlan::findOrFail($id);
        return view("admin.layouts.pages.package-plan.edit", compact("plan"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plan = PackagePlan::findOrFail($id);

        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'slug'                => 'required|string|max:255|unique:package_plans,slug,' . $plan->id,
            'subtitle'            => 'nullable|string',
            'monthly_amount'      => 'nullable|numeric',
            'yearly_amount'       => 'nullable|numeric',
            'yearly_save_percent' => 'nullable|numeric',
            'currency'            => 'nullable|string|max:5',
            'position'       => ['required', 'numeric', 'unique:package_plans,position,' . $id],
            'is_active'           => 'nullable|boolean',
        ]);

        $plan->update([
            'name'                => $request->name,
            'slug'                => $request->slug,
            'subtitle'            => $request->subtitle,
            'cta_text'            => $request->cta_text,
            'cta_url'             => $request->cta_url,
            'currency'            => $request->currency,
            'monthly_amount'      => $request->monthly_amount,
            'yearly_amount'       => $request->yearly_amount,
            'yearly_save_percent' => $request->yearly_save_percent,
            'yearly_save_text'    => $request->yearly_save_text,
            'features'            => $request->features,
            'position'            => $request->position,
            'is_active'           => $request->is_active ?? 1,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Package Plan updated successfully.',
            'id'      => $plan->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = PackagePlan::findOrFail($id);
        $plan->delete();
        return redirect()->back()->with('success', 'Plan deleted successfully!');
    }
}
