<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('status', 1)->latest()->get();
        return view("admin.layouts.pages.country.index", compact("countries"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_name' => ['required', 'string'],
            'status'       => ['required', 'in:1,0'],
        ]);

        Country::create([
            'country_name' => $request->country_name,
            'status' => $request->status,
        ]);

        return redirect()->route('country.index')->with('success', 'Country added successfully.');

    }

    public function update(Request $request, $id){
        $request->validate([
            'country_name' => ['required', 'string'],
            'status'       => ['required', 'in:1,0'],
        ]);

        $country = Country::findOrFail($id);

        $country->update([
            'country_name' => $request->country_name,
            'status' => $request->status,
        ]);

        return redirect()->route('country.index')->with('success', 'Country updated successfully');
    }


    public function destroy($id){
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->back()->with('success', 'Country deleted successfully.');
    }
}
