<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageProductImages extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('productImages')->paginate(3); // Eager load images relationship
        return view('ProductImage', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can be omitted if not needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'images.*' => 'required|mimes:png,jpg,jpeg|max:2048', 
        ]);

        try {
            $product = Product::findOrFail($request->product_id);
            if ($request->hasFile('images')) { 
                foreach ($request->file('images') as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'img_url' => $path,
                    ]);
                }
            }
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Failed to add images.');
        }

        return redirect()->back()->with('success', 'Images added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // This method can be omitted if not needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method can be omitted if not needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // This method can be omitted if not needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = ProductImage::findOrFail($id);
        if (Storage::disk('public')->exists($image->img_url)) {
            Storage::disk('public')->delete($image->img_url);
        }
        $image->delete(); 
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
