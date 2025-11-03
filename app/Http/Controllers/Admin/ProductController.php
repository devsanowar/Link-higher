<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        $trashedDataCount = Product::onlyTrashed()->count();
        return view('admin.layouts.pages.product.index', compact('products', 'trashedDataCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('status', 1)->latest()->get();
        return view('admin.layouts.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $uploadPath = 'uploads/product_images/';
        $product_slug = Str::slug($request->product_name, '-');

        if( $request->hasFile('image') ){
            $image = $request->file('image');
            $imageName = $product_slug. '-' . time().'_'.$image->getClientOriginalName();
            $image->move(public_path($uploadPath), $imageName);
            $productImage = $uploadPath . $imageName;
        }

        Product::create([
            'product_category_id'   => $request->product_category_id,
            'product_name'          => $request->product_name,
            'product_slug'          => $product_slug,
            'website_url'           => $request->website_url,
            'price'                 => $request->price,
            'ahrefs_dr'             => $request->ahrefs_dr,
            'moz_da'                => $request->moz_da,
            'moz_pa'                => $request->moz_pa,
            'traffic'               => $request->traffic,
            'target_country'        => $request->target_country,
            'product_description'   => $request->product_description,
            'image'                 => $productImage ?? null,
            'news'                  => $request->news,
            'status'                => $request->status,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Product created successfully.'
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
        $product = Product::findOrFail($id);
        $categories = ProductCategory::where('status', 1)->latest()->get();
        return view('admin.layouts.pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product_slug = Str::slug($request->product_name);

        $uploadPath = 'uploads/product_images/';

        if($request->hasFile('image')){

            if (! empty($product->image)) {
                $oldPath = public_path($product->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $image = $request->file('image');
            $imageName = $product_slug. '-' . time().'_'.$image->getClientOriginalName();
            $image->move(public_path($uploadPath), $imageName);
            $productImage = $uploadPath . $imageName;

        }

        $product->update([
            'product_category_id'   => $request->product_category_id,
            'product_name'          => $request->product_name,
            'product_slug'          => $product_slug,
            'website_url'           => $request->website_url,
            'price'                 => $request->price,
            'ahrefs_dr'             => $request->ahrefs_dr,
            'moz_da'                => $request->moz_da,
            'moz_pa'                => $request->moz_pa,
            'traffic'               => $request->traffic,
            'target_country'        => $request->target_country,
            'product_description'   => $request->product_description,
            'image'                 => $productImage ?? null,
            'status'                => $request->status,
            'news'                  => $request->news,
        ]);

        return response()->json([
            'status'=> 'success',
            'message'=> 'Product updated successfully.',
            'redirectUrl' => route('products.index'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Show only trashed products.
     */

    public function trashed(){
        $trashedProducts = Product::onlyTrashed()->get();
        return view('admin.layouts.pages.product.trashed', compact('trashedProducts'));
    }

    /**
     * Restore a trashed product.
     */

    public function restore($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.trashed')->with('success', 'Product restored successfully.');
    }

    /**
     * Permanently delete a trashed product.
     */

    public function forceDelete($id){

        $product = Product::onlyTrashed()->findOrFail($id);

        // delete main image
        if (! empty($product->image)) {
            $oldPath = public_path($product->image);
            if (File::exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        // finally force delete the record
        $product->forceDelete();

        return redirect()->route('products.trashed')->with('success', 'Product permanently deleted.');
    }
}
