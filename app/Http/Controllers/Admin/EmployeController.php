<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employes = Employe::all();
        return view("admin.layouts.pages.employe.index", compact("employes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.employe.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'image'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'order' => ['required', 'numeric', 'unique:employes,order'],
            'status' => ['nullable','in:1,0'],
        ]);

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/employe/'), $imageName);
            $employe['image'] = 'uploads/employe/' . $imageName;
        }

        Employe::create([
            'name'       => $request->name,
            'profession' => $request->profession,
            'image'      => $employe['image'],
            'order' => $request->order,
            'status' => $request->status,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Employe added successfully!',
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
        $employe = Employe::find($id);
        return view("admin.layouts.pages.employe.edit", compact("employe"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'image'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'order'       => ['required', 'numeric', 'unique:employes,order,' . $id],
            'status' => ['nullable','in:1,0'],
        ]);

        $employe = Employe::find($id);

        if ($request->hasFile('image')) {
            if ($employe->image && file_exists(public_path($employe->image))) {
                unlink(public_path($employe->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/employe/'), $imageName);
            $employe['image'] = 'uploads/employe/' . $imageName;
        }


        $employe->name = $request->name;
        $employe->profession = $request->profession;
        $employe->image = $employe['image'];
        $employe->order = $request->order;
        $employe->status = $request->status;

        $employe->save();

        $redirectUrl = route('employe.index');

        return response()->json([
            'status'  => 'success',
            'message' => 'Employe updated successfully.',
            'redirect' => $redirectUrl,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employe = Employe::findOrFail($id);
        if ($employe->image && file_exists(public_path($employe->image))) {
                unlink(public_path($employe->image));
            }
        $employe->delete();

        return redirect()->back()->with('success','Employe Deleted Successfully!');
    }
}
