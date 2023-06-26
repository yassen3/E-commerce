<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.product.showproduct',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $image = $request->file('image')->store('public/product');
        Product::create([
            'title'=>$request->title,
             'description'=>$request->description,
             'image'=>$image,
             'category'=>$request->category,
             'price'=>$request->price,
             'quantity'=>$request->quantity,
             'discount_price'=>$request->discount_price
        ]);
        return redirect()->back()->with('message','Product Add Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $products = Product::find($id);
        return view('admin.product.edit',compact('products'),compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
            'category'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'discount_price'=>'required'
        ]);
        $product = Product::findorFail($id);
         $image = $product->image;
         if($request->hasFile('image')){
            Storage::delete($product->image);
            $image = $request->file('image')->store('public/product');
         }
         $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$image,
            'category'=>$request->category,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'discount_price'=>$request->discount_price
         ]);
         return to_route('product.create')->with('message','Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');

    }

    public function searchproduct(Request $request)
    {
        $searchText = $request->searchproduct;
        $products = Product::where('title','LIKE',"%$searchText%")->orWhere('category','LIKE',"%$searchText%")->orWhere('description','LIKE',"%$searchText%")->get();
        return view('admin.product.showproduct',compact('products'));

    }
}