<?php
namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.layouts.pages.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ServiceCategory::latest()->get();
        return view("admin.layouts.pages.services.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_category_id'        => 'required|exists:service_categories,id',
            'service_title'             => 'required|string|max:255',
            'service_short_description' => 'nullable|string',
            'service_long_description'  => 'nullable|string',
            'service_features.*'        => 'nullable|string|max:255',

            'status'                    => 'required|in:0,1',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ]);

        $service                = new Service();
        $service->service_category_id = $request->service_category_id;
        $service->service_title = $request->service_title;
        $service->service_slug  = Str::slug($request->service_title);

        $service->service_short_description = $request->service_short_description;
        $service->service_long_description  = $request->service_long_description;
        $service->service_features          = json_encode($request->service_features ?? []);

        $uploadPath = public_path('uploads/service_image');

        if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $path           = 'uploads/service_image/' . $filename;
            $service->image = $path;
        }

        $service->status = $request->status;

        $service->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Service created successfully!',
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
        $service = Service::find($id);
        return view("admin.layouts.pages.services.edit", compact("service"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'service_category_id'        => 'required|exists:service_categories,id',
            'service_title'             => 'required|string|max:255',
            'service_slug'              => 'nullable|string|max:255|unique:services,service_slug,' . $service->id,
            'service_short_description' => 'nullable|string',
            'service_long_description'  => 'nullable|string',
            'service_features.*'        => 'nullable|string|max:255',
            'status'                    => 'required|in:0,1',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ]);

        // Basic fields
        $service->service_category_id = $request->service_category_id;
        $service->service_title = $request->service_title;

        // If user provided slug, use it; else derive from title
        $incomingSlug = $request->filled('service_slug')
            ? Str::slug($request->service_slug)
            : Str::slug($request->service_title);
        $service->service_slug = $incomingSlug;

        $service->service_short_description = $request->service_short_description;
        $service->service_long_description  = $request->service_long_description;
        $service->service_features          = json_encode($request->service_features ?? []);
        $service->status                    = $request->status;

        // Image handling (same folder strategy as store)
        $uploadPath = public_path('uploads/service_image');
        if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if ($request->hasFile('image')) {
            // Delete old file if exists
            if (! empty($service->image)) {
                $oldPath = public_path($service->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $service->image = 'uploads/service_image/' . $filename;
        }

        $service->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Service updated successfully!',
            'redirect_url' => route('services.index'),

        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && File::exists(public_path($service->image))) {
            File::delete(public_path($service->image));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Service Deleted Successfully.');
    }
}
