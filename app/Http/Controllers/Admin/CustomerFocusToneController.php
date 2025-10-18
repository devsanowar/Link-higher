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

    public function update(Request $request) {

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video_url'   => ['nullable', 'url', 'max:2048'],
        ]);


        if (array_key_exists('video_url', $validated) && $validated['video_url'] === '') {
            $validated['video_url'] = null;
        }

        $model = CustomerFocusTone::first();

        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'video_url'   => $validated['video_url'] ?? null,
        ];

        // create or update (upsert-style)
        if ($model) {
            $ok   = $model->fill($data)->save(); // exists হলে fill+save
            $mode = 'updated';
        } else {
            $model = CustomerFocusTone::create($data); // না থাকলে create
            $ok    = (bool) $model;
            $mode  = 'created';
        }

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
