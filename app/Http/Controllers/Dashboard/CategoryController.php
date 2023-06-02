<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Category\Store;
use App\Http\Requests\Category\Put;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
       $categories = Category::orderBy('id','DESC')->paginate(5);
       return inertia('Dashboard/Category/Index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('Dashboard/Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        //
        // dd($request->all());
        // Category::create([
        //     'title' => request('title'),
        //     'slug' => request('slug'),
        // ]);
        // dd($request->slug);
        // //************************** */
        // $category = new Category();
        // $category->title = $request->title;
        // $category->slug = $request->slug;
        // $category->save();
        Category::create($request->validated());
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
    public function edit(Category $category)
    {
        //
        return inertia('Dashboard/Category/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, Category $category)
    {
        // dd($request->all());
        $category->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
    }
}
