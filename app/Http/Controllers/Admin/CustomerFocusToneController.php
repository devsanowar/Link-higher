<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerFocusTone;
use Illuminate\Http\Request;

class CustomerFocusToneController extends Controller
{
    public function index()
    {
        $customerFocusTone = CustomerFocusTone::first() ?? null;
        return view("admin.layouts.pages.home-page.customer-focus-tone.index", compact("customerFocusTone"));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'video_url'       => ['nullable', 'url', 'max:2048'],
            'video_thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if (array_key_exists('video_url', $validated) && $validated['video_url'] === '') {
            $validated['video_url'] = null;
        }


        $model = CustomerFocusTone::first() ?? new CustomerFocusTone();


        $thumbPath = $model->video_thumbnail;


        if ($request->hasFile('video_thumbnail')) {

            if (! empty($model->video_thumbnail) && file_exists(public_path($model->video_thumbnail))) {
                @unlink(public_path($model->video_thumbnail));
            }

            $file     = $request->file('video_thumbnail');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('uploads/customer-focus-tone/');
            if (! is_dir($destPath)) {
                @mkdir($destPath, 0775, true);
            }
            $file->move($destPath, $fileName);

            $thumbPath = 'uploads/customer-focus-tone/' . $fileName;
        }

        $data = [
            'title'           => $validated['title'],
            'description'     => $validated['description'] ?? null,
            'video_url'       => $validated['video_url'] ?? null,
            'video_thumbnail' => $thumbPath,
        ];

        // create or update
        $mode = $model->exists ? 'updated' : 'created';
        $ok   = $model->fill($data)->save();

        if (! $ok) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Save failed.',
            ], 500);
        }

        return response()->json([
            'status'  => 'success',
            'message' => $mode === 'created' ? 'Data created!' : 'Data successfully updated!',
            'mode'    => $mode,
            'id'      => $model->id,
        ], $mode === 'created' ? 201 : 200);
    }

}
