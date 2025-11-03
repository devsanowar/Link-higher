<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view("admin.layouts.pages.product-category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.layouts.pages.product-category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $uploadPath = public_path('uploads/product_category');
        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $imagePath = 'uploads/product_category/' . $filename;
        }

        ProductCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'image'         => $imagePath ?? null,
            'status'        => $request->status,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Product Category created successfully.'
        ], 201);

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
        $productCategory = ProductCategory::find($id);
        return view("admin.layouts.pages.product-category.edit", compact("productCategory"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $productCategory = ProductCategory::find($id);

        $uploadPath = public_path('uploads/product_category');

        if ($request->hasFile('image')) {
            // Delete old file if exists
            if (! empty($productCategory->image)) {
                $oldPath = public_path($productCategory->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $image    = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);

            $productCategory->image = 'uploads/product_category/' . $filename;
        }

        $productCategory->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'image'         => $productCategory->image,
            'status'        => $request->status,
        ]);



        return response()->json([
            'status'=> 'success',
            'message'=> 'Product Category updated successfully.',
            'redirectUrl'=> route('product-category.index'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::find($id);

        // Delete image file if exists
        if (! empty($productCategory->image)) {
            $oldPath = public_path($productCategory->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $productCategory->delete();

        return redirect()->route('product-category.index')->with('success', 'Product Category deleted successfully.');
    }
}
