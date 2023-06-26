<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id','title','description','image','category','quantity','price','discount_price'];
}


// <form method="post" action="{{route('cart.store',$products->id)}}" enctype="multipart/form-data">
// {{ csrf_field() }}
// @method('HEAD')
// <div class="d-flex flex-column mt-4">
//     <label>Quantity</label>
//     <input name="quantity" type="number" min="1" placeholder="1" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black" >
// <button class="btn btn-outline-primary btn-sm mt-2" name="Add to Cart" type="submit">Add to Cart</button>
// {{-- <input type="submit" name="Add to Cart" class="btn btn-outline-primary btn-sm mt-2" value="Add to Cart"> --}}
// </form>

// <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
//    @csrf
//    <div class="d-flex flex-column mt-4">
// <button class="btn btn-outline-primary btn-sm mt-2" type="submit">
//     Add to wishlist
// </button>
// </div>
// </form>