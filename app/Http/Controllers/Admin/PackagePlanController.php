<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackagePlan;
use App\Models\Service;
use Illuminate\Http\Request;

class PackagePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = PackagePlan::latest()->get();
        return view("admin.layouts.pages.package-plan.index", compact("plans"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('status', 1)->latest()->get();
        return view("admin.layouts.pages.package-plan.create", compact("services"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'    => 'nullable|exists:services,id',
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percent,amount',
            'currency'      => 'required|string|max:10',
            'features'      => 'nullable',
            'is_active'     => 'nullable|boolean',
        ]);

        // Normalize features: accept JSON string or array -> ensure an array (empty array if none)
        $featuresInput = $request->input('features', null);

        if (is_string($featuresInput)) {
            $decoded  = json_decode($featuresInput, true);
            $features = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
        } elseif (is_array($featuresInput)) {
            $features = $featuresInput;
        } else {
            $features = [];
        }

        // Calculate final_price based on discount and discount_type
        $price    = (float) ($validated['price'] ?? 0);
        $discount = isset($validated['discount']) ? (float) $validated['discount'] : 0;
        $dtype    = $validated['discount_type'] ?? null;

        if ($discount > 0 && $dtype) {
            if ($dtype === 'percent') {
                $finalPrice = $price - (($price * $discount) / 100);
            } elseif ($dtype === 'amount') {
                $finalPrice = $price - $discount;
            } else {
                $finalPrice = $price;
            }
        } else {
            $finalPrice = $price;
        }

        // ensure not negative and round to 2 decimals
        $finalPrice = max($finalPrice, 0);
        $finalPrice = round($finalPrice, 2);

        // Prepare final data to save
        $data = [
            'service_id'    => $validated['service_id'] ?? null,
            'name'          => $validated['name'],
            'slug'          => $validated['slug'],
            'price'         => $validated['price'],
            'discount'      => $validated['discount'] ?? null,
            'discount_type' => $validated['discount_type'] ?? null,
            'currency'      => $validated['currency'],
            'features'      => $features,
            'is_active'     => (int) ($validated['is_active'] ?? 1),
            'final_price'   => $finalPrice, // <-- calculated field
        ];

        $plan = PackagePlan::create($data);


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
        $plan     = PackagePlan::findOrFail($id);
        $services = Service::where('status', 1)->latest()->get();
        return view("admin.layouts.pages.package-plan.edit", compact("plan", "services"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plan = PackagePlan::findOrFail($id);

        $validated = $request->validate([
            'service_id'    => 'nullable|exists:services,id',
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percent,amount',
            'currency'      => 'required|string|max:10',
            'features'      => 'nullable',
            'is_active'     => 'nullable|boolean',
        ]);

        // Normalize features: accept JSON string or array -> ensure an array (empty array if none)
        $featuresInput = $request->input('features', null);

        if (is_string($featuresInput)) {
            $decoded  = json_decode($featuresInput, true);
            $features = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
        } elseif (is_array($featuresInput)) {
            $features = $featuresInput;
        } else {
            $features = [];
        }

        // Calculate final_price based on discount and discount_type
        $price    = (float) ($validated['price'] ?? 0);
        $discount = isset($validated['discount']) ? (float) $validated['discount'] : 0;
        $dtype    = $validated['discount_type'] ?? null;

        if ($discount > 0 && $dtype) {
            if ($dtype === 'percent') {
                $finalPrice = $price - (($price * $discount) / 100);
            } elseif ($dtype === 'amount') {
                $finalPrice = $price - $discount;
            } else {
                $finalPrice = $price;
            }
        } else {
            $finalPrice = $price;
        }

        // ensure not negative and round to 2 decimals
        $finalPrice = max($finalPrice, 0);
        $finalPrice = round($finalPrice, 2);

        // Prepare data to update
        $data = [
            'service_id'    => $validated['service_id'] ?? null,
            'name'          => $validated['name'],
            'slug'          => $validated['slug'],
            'price'         => $validated['price'],
            'discount'      => $validated['discount'] ?? null,
            'discount_type' => $validated['discount_type'] ?? null,
            'currency'      => $validated['currency'],
            'features'      => $features,
            'is_active'     => (int) ($validated['is_active'] ?? 1),
            'final_price'   => $finalPrice,
        ];

        $plan->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Package Plan updated successfully.',
            'id'      => $plan->id,
            'redirectUrl' => route('package_plans.index'),
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
