<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartStoreRequest;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::id())
        {
        $Userid = Auth::user()->id;

        $carts= Cart::where('user_id','=',$Userid)->get();
        // $users = User::all();

        return view('home.cart.showcart',compact('carts','Userid'));
        }
        else
        {
            return redirect('login');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CartStoreRequest $request,$id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $products =Product::find($id);

// dd($products);
            // $image = $request->file('image')->store('public/cart');
        //     Cart::create([
        //         'name'=>$user->name,
        //         'email'=>$user->email,
        //         'phone'=>$user->phone,
        //         'product_title'=>$products->title,
        //         'price'=>$products->price,
        //         'quantity'=>$request->quantity,
        //         'image'=>$products->image,
        //         'product_id'=>$products->id,
        //         'user_id'=>$user->id,
        // ]);

        $cart =new cart;
        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->phone = $user->phone;
        $cart->product_title = $products->title;
        if($products->discount_price != null){
            $cart->price = $products->discount_price;
        }
        else{
            $cart->price = $products->price;
        }
        if($products->discount_price != null){
            $cart->total_price = $products->discount_price *$request->quantity ;
        }
        else{
            $cart->price = $products->price * $request->quantity;
        }
        $cart->quantity = $request->quantity;
        $cart->image = $products->image;
        $cart->product_id = $products->id;
        $cart->user_id = $user->id;

        $cart->save();

        return redirect()->back()->with('message','Product Added To Cart');

    }
    else {
        return redirect('login');
    }

}
    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);

        $cart->delete();
        return redirect()->back()->with('message','Product Deleted');
    }

    public function print_pdf($id)
    {  $user = Auth::user();
        $userid = $user->id;

        $carts = Cart::where('user_id','=',$userid)->get();

         //############ Permitir ver imagenes si falla ################################
         $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
        ]);

        $pdf = \PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->setHttpContext($contxt);
        //#################################################################################



        $pdf->loadView('home.cart.pdf',compact('carts'));
        return $pdf->stream('order_details.pdf');
    }
}