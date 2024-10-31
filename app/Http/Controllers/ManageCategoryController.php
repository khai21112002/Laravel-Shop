<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ManageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::paginate(3);
        return view('categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,name',
            ]);

        // Create a new category
        $category = Category::create([
            'name' => $request->categoryName,
        ]);

        return redirect()->back()->with('success','Category added successfully');
            
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        Log::info('Update category called with:', [
        'request' => $request->all(),
        'category_id' => $category->id,
        ]);


        $request->validate([
            'categoryName' => 'required|string|max:255|unique:categories,name,' . $category->id, 
        ]);

        $category->update(['name' => $request->categoryName]);

        return redirect()->back()->with('message', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('message', 'Category deleted successfully.');
    }
}
