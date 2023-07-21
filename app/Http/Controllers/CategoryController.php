<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $data = [
            'categories' => $categories,
        ];

        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();

        $category->name = $validated['name'];

        $category->save();

        return redirect()->route('categories')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Category $catcategoryegories)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'category' => $category,
        ];

        return view('categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if($request->name != $category->name){
            $validated = $request->validate([
                'name' => 'required|unique:categories|max:255',
            ]);
            $category->name = $validated['name'];

            $category->save();
        }

        return redirect()->route('categories.edit', $category->id)->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully');
    }
}
