<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view("admin.layouts.pages.services.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_title'             => 'required|string|max:255',
            'service_short_description' => 'nullable|string',
            'service_long_description'  => 'nullable|string',
            'service_features.*'        => 'nullable|string|max:255',

            'status'                    => 'required|in:0,1',
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ]);

        $service                = new Service();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
