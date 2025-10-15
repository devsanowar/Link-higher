<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedClient;
use Illuminate\Http\Request;

class TrustedClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = TrustedClient::all();
        return view("admin.layouts.pages.trusted_client.index", compact("clients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.trusted_client.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'  => ['required', 'string', 'max:255'],
            'company_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'        => ['nullable', 'in:0,1'],
        ]);

        if ($request->hasFile('company_image')) {
            $image     = $request->file('company_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/trusted_clients/'), $imageName);
            $validated['company_image'] = 'uploads/trusted_clients/' . $imageName;
        }

        $client = TrustedClient::create([
            'company_name'  => $validated['company_name'],
            'company_image' => $validated['company_image'] ?? null,
            'status'        => (int) ($validated['status'] ?? 1),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Client created successfully.',
            'data'    => $client,
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
        $client = TrustedClient::findOrFail($id);
        return view("admin.layouts.pages.trusted_client.edit", compact("client"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = TrustedClient::findOrFail($id);

        $validated = $request->validate([
            'company_name'  => ['required', 'string', 'max:255'],
            'company_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'        => ['nullable', 'in:0,1'],
        ]);

        if ($request->hasFile('company_image')) {
            if ($client->company_image && file_exists(public_path($client->company_image))) {
                @unlink(public_path($client->company_image));
            }
            $image     = $request->file('company_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/trusted_clients/'), $imageName);
            $validated['company_image'] = 'uploads/trusted_clients/' . $imageName;
        }

        $client->update([
            'company_name'  => $validated['company_name'],
            'company_image' => $validated['company_image'] ?? $client->company_image,
            'status'        => (int) ($validated['status'] ?? $client->status),
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => 'Client updated successfully.',
            'data'     => $client,
            'redirect' => route('clients.index'), // চাইলে বাদ দিতে পারো
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = TrustedClient::findOrFail($id);

        if ($client->company_image && file_exists(public_path($client->company_image))) {
            @unlink(public_path($client->company_image));
        }

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
