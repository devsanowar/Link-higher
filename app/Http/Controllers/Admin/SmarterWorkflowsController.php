<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmarterWorkflow;
use App\Models\SmarterWorkflowsImage;
use Illuminate\Http\Request;

class SmarterWorkflowsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workflows     = SmarterWorkflow::all();
        $workflowImage = SmarterWorkflowsImage::first();
        return view('admin.layouts.pages.home-page.smarter-workflows.index', compact('workflows', 'workflowImage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.home-page.smarter-workflows.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status'      => ['nullable', 'in:0,1'], // default 0
        ]);

        $workflow = SmarterWorkflow::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'status'      => (int) ($validated['status'] ?? 0),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Workflow created successfully.',
            'data'    => $workflow,
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
        $workflow = SmarterWorkflow::findOrFail($id);
        return view("admin.layouts.pages.home-page.smarter-workflows.edit", compact("workflow"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status'      => ['nullable', 'in:0,1'], // default 0
        ]);

        $workflow = SmarterWorkflow::findOrFail($id);

        $workflow->title       = $validated['title'];
        $workflow->description = $validated['description'];
        $workflow->status      = $validated['status'];
        $workflow->save();

        $redirectUrl = route('home.smarter-workflows.index');

        return response()->json([
            'status'   => 'success',
            'message'  => 'Workflow updated successfully.',
            'data'     => $workflow,
            'redirect' => $redirectUrl,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workflow = SmarterWorkflow::findOrFail($id);
        $workflow->delete();
        return redirect()->route('home.smarter-workflows.index')->with('success', 'Smarter workflow successfully deleted!');
    }

    /** Image update */

    public function imageUpdate(Request $request)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:1024'],
        ]);

        $workflowImage = SmarterWorkflowsImage::first() ?? new SmarterWorkflowsImage();

        $uploadDir  = 'uploads/smarter-workflow-image';
        $uploadPath = public_path($uploadDir);
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if ($request->hasFile('image')) {
            if ($workflowImage->image && file_exists(public_path($workflowImage->image))) {
                @unlink(public_path($workflowImage->image));
            }

            $file     = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $workflowImage->image = "$uploadDir/$fileName";
        }

        $workflowImage->save();
        $imageUrl = $workflowImage->image ? asset($workflowImage->image) : null;

        return response()->json([
            'status'   => 'success',
            'message'  => 'Image successfully updated!',
            'imageUrl' => $imageUrl,
        ]);
    }

}
