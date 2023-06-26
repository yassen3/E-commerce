<?php

namespace App\Http\Controllers;
use Stripe;



use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;


use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        $products = Product::paginate(9);
        return view('home.userPage',compact('products'),compact('categories'));
    }
    public function redirect()
    {
        $usertype= Auth::user()->usertype;
        if($usertype=='1')
        {
            $total_product = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_users = User::all()->count();
            $orders = Order::all();

            $total_revenue = 0;
            foreach($orders as $order)
            {
               $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = Order::where('delivery_status','=','delivered')->get()->count();

            $total_processing = Order::where('delivery_status','=','Processing')->get()->count();


            return view('admin.home',compact('total_product','total_orders','total_users','total_revenue','total_delivered','total_processing'));
        }
        else
        {
            $categories = Category::all();
        $products = Product::paginate(9);
        return view('home.userPage',compact('products'),compact('categories'));
    }
        }
        public function product_details($id)
        {
            $products = Product::find($id);
            return view ('home.product_details',compact('products'));
        }


        public function product_search(request $request)
        {
            $search_Text = $request->search;
            $products = Product::where('title','LIKE',"%$search_Text%")->orWhere('category','LIKE',"%$search_Text%")->orWhere('description','LIKE',"%$search_Text%")->paginate(10);
            return view('home.all_products',compact('products'));
        }

        public function products()
        {
            $products = Product::paginate(8);
            return view('home.all_products',compact('products'));
        }

        public function cash_order()
        {
            $user = Auth::user();
            $userid = $user->id;

            $data = Cart::where('user_id','=',$userid)->get();
            foreach($data as $data)
            {
                Order::create([
                 'name'=>$data->name,
                 'email'=>$data->email,
                 'phone'=>$data->phone,
                 'user_id'=>$data->user_id,
                 'price'=>$data->price,
                 'product_title'=>$data->product_title,
                 'quantity'=>$data->quantity,
                 'product_id'=>$data->product_id,
                 'image'=>$data->image,
                 'payment_status'=>'Cash On Delivery',
                 'delivery_status'=>'Processing',
                ]);


                // $order =new order;

                // $order->name = $data->name;
                // $order->email = $data->email;
                // $order->phone = $data->phone;
                // $order->user_id = $data->user_id;
                // $order->product_title = $data->product_title;
                // $order->price = $data->price;
                // $order->quantity = $data->image;
                // $order->product_id = $data->product_id;
                // $order->payment_status = 'Cash On Delivery';
                // $order->delivery_status = 'Processing';

                // $order->save();

                $cart_id = $data->id;
                $cart = Cart::find($cart_id);
                $cart->delete();
            }
            return redirect()->back()->with('message','We Recieved Ypur Order.We Will Connect With You Soon.');
        }




        public function stripe($totalprice)
        {
           return view('home.cart.stripe',compact('totalprice'));
        }

        public function stripePost(Request $request,$totalprice)

        {

            Stripe\Stripe::setApiKey('sk_test_51NGn7qE2YVdrMZZa8trFxVDL0hOrb19dVHhFHF6e6psZHj4ShqTXeQvPaoOK6jn1VvxQNmoTSKYW3RTscR6p5e8f00F1AhXzgi');



            Stripe\Charge::create ([

                    "amount" => 100 * 100,

                    "currency" => "usd",

                    "source" => $request->input('stripeToken'),

                    "description" => "Thanks For Payment",

            ]);

            Session::flash('success', 'Payment successful!');

            return back();

        }
    }