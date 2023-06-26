<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index',compact('orders'));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders = Order::find($id);
        $orders->delete();
        return redirect()->back()->with('message','Order Deleted Successfully by Admin');
    }

    public function delivered($id)
    {
       $orders = Order::find($id);
       $orders->delivery_status='delivered';
       $orders->payment_status='paid';
       $orders->save();
       return redirect()->back();
    }

    public function searchdata(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")
        ->orWhere('email','LIKE',"%$searchText%")->get();
        return view('admin.order.index',compact('orders'));

    }
}