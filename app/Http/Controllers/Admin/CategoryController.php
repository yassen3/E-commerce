<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category',compact('categories'));
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
    public function store(CategoryStoreRequest $request)
    {
        $categories= Category::create([
            'category_name'=>$request->category_name,

        ]);

        return redirect()->back()->with('message','Category Add Successfully',compact('categories'));

    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $categories = Category::find($id);
       return view('admin.category.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name'=>'required'
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'category_name'=>$request->category_name
        ]);
        return to_route('category.index')->with('message','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $category= Category::find($id);
        $category->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }
}