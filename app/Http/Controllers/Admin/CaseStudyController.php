<?php
namespace App\Http\Controllers\Admin;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CaseStudyCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CaseStudyController extends Controller
{
    public function index()
    {
        $cases = CaseStudy::with('category')->latest()->where("status", 1)->get();
        $trashedDataCount = CaseStudy::onlyTrashed()->count();
        return view("admin.layouts.pages.case-study.index", compact("cases", "trashedDataCount"));
    }

    public function create()
    {
        $categories = CaseStudyCategory::where("status", 1)->get();
        return view("admin.layouts.pages.case-study.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'        => 'required|exists:case_study_categories,id',
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
        $publicUploadDir = public_path('uploads/case-studies-images');
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
            $imagePath = 'uploads/case-studies-images/' . $filename;
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
                $galleryPaths[] = 'uploads/case-studies-images/' . $gname;
            }
        }

        // ===== Create Case Study =====
        $caseStudy                     = new CaseStudy();
        $caseStudy->category_id        = $request->category_id;
        $caseStudy->title              = $request->title;
        $caseStudy->description        = $request->description;
        $caseStudy->overview_challenge = $request->overview_challenge;
        $caseStudy->project_summary    = $request->project_summary;
        $caseStudy->solution_result    = $request->solution_result;
        $caseStudy->client_name        = $request->client_name;
        $caseStudy->website_url        = $request->website_url;
        $caseStudy->start_date         = $request->start_date;
        $caseStudy->end_date           = $request->end_date;

        // features -> JSON (schema: longText)
        $caseStudy->features = json_encode($request->input('features', []));

        // single image path
        $caseStudy->image = $imagePath;

        // gallery images -> JSON (schema: longText)
        $caseStudy->images = json_encode($galleryPaths);

        $caseStudy->status = (int) ($request->status ?? 1);
        $caseStudy->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Case Study created successfully.',
        ]);
    }

    public function edit($id)
    {
        $case       = CaseStudy::findOrFail($id);
        $categories = CaseStudyCategory::where("status", 1)->get();
        return view("admin.layouts.pages.case-study.edit", compact("case", "categories"));
    }

    public function update(Request $request, $id)
    {
        $case = CaseStudy::findOrFail($id);

        $request->validate([
            'category_id'               => 'required|exists:case_study_categories,id',
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
        $uploadDir = public_path('uploads/case-studies-images');
        if (! is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        // ---------- assign basic fields ----------
        $case->category_id        = $request->category_id;
        $case->title              = $request->title;
        $case->description        = $request->description;
        $case->overview_challenge = $request->overview_challenge;
        $case->project_summary    = $request->project_summary;
        $case->solution_result    = $request->solution_result;

        // features -> JSON (longText)
        $case->features = json_encode($request->input('features', []));

        // optional fields (if columns exist)
        if ($case->isFillable('client_name')) {
            $case->client_name = $request->client_name;
        }

        if ($case->isFillable('website_url')) {
            $case->website_url = $request->website_url;
        }

        if ($case->isFillable('start_date')) {
            $case->start_date = $request->start_date ? Carbon::parse($request->start_date) : null;
        }

        if ($case->isFillable('end_date')) {
            $case->end_date = $request->end_date ? Carbon::parse($request->end_date) : null;
        }

        $case->status = (int) $request->status;

        // ---------- main image replace ----------
        if ($request->hasFile('image')) {
            // delete old
            if (! empty($case->image)) {
                $oldPath = public_path($case->image);
                if (File::exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            // save new
            $img      = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move($uploadDir, $filename);
            $case->image = 'uploads/case-studies-images/' . $filename;
        }

        // ---------- gallery: start from existing ----------
        $existing = [];
        if (! empty($case->images)) {
            $decoded = is_array($case->images) ? $case->images : json_decode($case->images, true);
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
                $existing[] = 'uploads/case-studies-images/' . $gname;
            }
        }

        // save gallery (JSON)
        $case->images = json_encode($existing);

        // ---------- persist ----------
        $case->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Case study updated successfully!',
            'data'    => [
                'id'     => $case->id,
                'image'  => $case->image,
                'images' => $existing,
            ],
        ]);
    }

    public function destroy($id)
    {
        $case = CaseStudy::findOrFail($id);
        $case->delete();

        return redirect()->route('case.study.index')->with('success', 'Case Study deleted successfully.');
    }

    // Trashed case studies
    public function trashed(){
        $cases = CaseStudy::onlyTrashed();
        return view("admin.layouts.pages.case-study.recycle-bin", compact("cases"));
    }

    // Restore a trashed case study
    public function restore($id){
        $case = CaseStudy::onlyTrashed()->findOrFail($id);
        $case->restore();
        return redirect()->route('case.study.trashed')->with('success', 'Case Study restored successfully.');
    }

    // Permanently delete a trashed case study
    public function forceDelete($id){
        $case = CaseStudy::onlyTrashed()->findOrFail($id);

        // delete main image
        if (! empty($case->image)) {
            $oldPath = public_path($case->image);
            if (File::exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        // delete gallery images
        $gallery = [];
        if (! empty($case->images)) {
            $decoded = is_array($case->images) ? $case->images : json_decode($case->images, true);
            if (is_array($decoded)) {
                $gallery = $decoded;
            }
        }

        if (count($gallery)) {
            foreach ($gallery as $imgPath) {
                $abs = public_path($imgPath);
                if (File::exists($abs)) {
                    @unlink($abs);
                }
            }
        }

        // finally force delete the record
        $case->forceDelete();

        return redirect()->route('case.study.trashed')->with('success', 'Case Study permanently deleted.');
    }

}
