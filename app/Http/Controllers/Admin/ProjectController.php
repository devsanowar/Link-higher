<?php
namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects         = Project::with('category')->latest()->where("status", 1)->get();
        $trashedDataCount = Project::onlyTrashed()->count();
        return view("admin.layouts.pages.project.index", compact("projects", "trashedDataCount"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::where("status", 1)->get();
        return view("admin.layouts.pages.project.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'        => 'required|exists:project_categories,id',
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'overview_challenge' => 'nullable|string',
            'project_summary'    => 'nullable|string',
            'solution_result'    => 'nullable|string',
            'client_name'        => 'nullable|string|max:255',
            'website_url'        => 'nullable|url|max:255',
            'start_date'         => 'nullable|date',
            'end_date'           => 'nullable|date|after_or_equal:start_date',

            // features: array -> JSON
            'features'           => 'nullable|array',
            'features.*'         => 'nullable|string|max:255',

            // single image
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // multiple images
            'images'             => 'nullable|array',
            'images.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            'status'             => 'nullable|in:0,1',
        ]);

        // ===== File upload base path =====
        $publicUploadDir = public_path('uploads/project');
        if (! is_dir($publicUploadDir)) {
            @mkdir($publicUploadDir, 0755, true);
        }

        // ===== Single image =====
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($publicUploadDir, $filename);
            // path saved in DB (relative to public/)
            $imagePath = 'uploads/project/' . $filename;
        }

        // ===== Multiple images (gallery) =====
        $galleryPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                if (! $img) {
                    continue;
                }

                $gname = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move($publicUploadDir, $gname);
                $galleryPaths[] = 'uploads/project/' . $gname;
            }
        }

        // ===== Create project Study =====
        $project                     = new Project();
        $project->category_id        = $request->category_id;
        $project->title              = $request->title;
        $project->description        = $request->description;
        $project->overview_challenge = $request->overview_challenge;
        $project->project_summary    = $request->project_summary;
        $project->solution_result    = $request->solution_result;
        $project->client_name        = $request->client_name;
        $project->website_url        = $request->website_url;
        $project->start_date         = $request->start_date;
        $project->end_date           = $request->end_date;

        // features -> JSON (schema: longText)
        $project->features = json_encode($request->input('features', []));

        // single image path
        $project->image = $imagePath;

        // gallery images -> JSON (schema: longText)
        $project->images = json_encode($galleryPaths);

        $project->status = (int) ($request->status ?? 1);
        $project->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'project Study created successfully.',
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
        $project       = Project::findOrFail($id);
        $categories = ProjectCategory::where("status", 1)->get();
        return view("admin.layouts.pages.project.edit", compact("project", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'category_id'               => 'required|exists:project_categories,id',
            'title'                     => 'required|string|max:255',
            'description'               => 'required|string',
            'overview_challenge'        => 'nullable|string',
            'project_summary'           => 'nullable|string',
            'solution_result'           => 'nullable|string',

            // features: array -> JSON
            'features'                  => 'nullable|array',
            'features.*'                => 'nullable|string|max:255',

            // main image (optional replace)
            'image'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // gallery: add new
            'images'                    => 'nullable|array',
            'images.*'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // gallery: remove existing (hidden inputs)
            'removed_existing_images'   => 'nullable|array',
            'removed_existing_images.*' => 'nullable|string',

            // optional extra fields (drop if not in schema)
            'client_name'               => 'nullable|string|max:255',
            'website_url'               => 'nullable|string|max:255',
            'start_date'                => 'nullable|date',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',

            'status'                    => 'required|in:0,1',
        ]);

        // ---------- base upload dir ----------
        $uploadDir = public_path('uploads/project');
        if (! is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        // ---------- assign basic fields ----------
        $project->category_id        = $request->category_id;
        $project->title              = $request->title;
        $project->description        = $request->description;
        $project->overview_challenge = $request->overview_challenge;
        $project->project_summary    = $request->project_summary;
        $project->solution_result    = $request->solution_result;

        // features -> JSON (longText)
        $project->features = json_encode($request->input('features', []));

        // optional fields (if columns exist)
        if ($project->isFillable('client_name')) {
            $project->client_name = $request->client_name;
        }

        if ($project->isFillable('website_url')) {
            $project->website_url = $request->website_url;
        }

        if ($project->isFillable('start_date')) {
            $project->start_date = $request->start_date ? Carbon::parse($request->start_date) : null;
        }

        if ($project->isFillable('end_date')) {
            $project->end_date = $request->end_date ? Carbon::parse($request->end_date) : null;
        }

        $project->status = (int) $request->status;

        // ---------- main image replace ----------
        if ($request->hasFile('image')) {
            // delete old
            if (! empty($project->image)) {
                $oldPath = public_path($project->image);
                if (File::exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            // save new
            $img      = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move($uploadDir, $filename);
            $project->image = 'uploads/project/' . $filename;
        }

        // ---------- gallery: start from existing ----------
        $existing = [];
        if (! empty($project->images)) {
            $decoded = is_array($project->images) ? $project->images : json_decode($project->images, true);
            if (is_array($decoded)) {
                $existing = $decoded;
            }

        }

        // ---------- remove existing images if requested ----------
        $toRemove = $request->input('removed_existing_images', []);
        if (is_array($toRemove) && count($toRemove)) {
            // physical delete + filter out from list
            $toRemoveSet = array_flip($toRemove);
            foreach ($existing as $idx => $path) {
                if (isset($toRemoveSet[$path])) {
                    $abs = public_path($path);
                    if (File::exists($abs)) {
                        @unlink($abs);
                    }
                    unset($existing[$idx]);
                }
            }
            // reindex
            $existing = array_values($existing);
        }

        // ---------- add new gallery images ----------
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                if (! $img) {
                    continue;
                }

                $gname = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move($uploadDir, $gname);
                $existing[] = 'uploads/project/' . $gname;
            }
        }

        // save gallery (JSON)
        $project->images = json_encode($existing);

        // ---------- persist ----------
        $project->save();


        return response()->json([
            'status'  => 'success',
            'message' => 'project study updated successfully!',
            'data'    => [
                'id'     => $project->id,
                'image'  => $project->image,
                'images' => $existing,
                'redirect_url' => route('project.index'),
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
