<!DOCTYPE html>
<html>
    <head>
        <!-- Basic -->

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="{{('/images/favicon.png')}}" type= "">
        <title>Famms - Fashion HTML Template</title>
        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
        <!-- font awesome style -->
        <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
        <!-- responsive style -->
        <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
     </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

         @if (session()->has('message'))
         <div class="alert alert-success">
             {{session()->get('message')}}
         </div>
         @endif


         <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                             Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delete
                        </th>
                    </tr>
                    <?php $totalprice = 0; ?>
                </thead>
                <tbody>
                      @foreach ($carts as $cart)
                      <tr class="">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->product_title}}
                        </th>

                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            <img src="{{Storage::url($cart->image)}}"class="w-20 h-20 rounded" >
                        </td>

                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->price}}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->quantity}}
                        </td>
                       <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->total_price}}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->name}}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->email}}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            {{$cart->phone}}
                        </td>
                        <td>
                        <form method="POST" action="{{route('cart.destroy',$cart->id)}}"

                            onsubmit="return confirm('Are You Sure');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                       </td>
                    </tr>

                    <?php $totalprice = $totalprice + $cart->total_price; ?>
                      @endforeach


                </tbody>
            </table>

        </div>
        <div class="card mb-5">
            <div class="card-body p-4">

              <div class="float-end">
                <p class="mb-0 me-5 d-flex align-items-center">
                  <span class="d-flex justify-content-end">Order total:</span> <span
                    class="lead fw-normal">{{$totalprice}}</span><br><br>

                    <a class="btn btn-outline-info ml-2"  href="{{route('print_pdf',$Userid)}}">Print PDF</a>
                </p>

                <div class="d-flex justify-content-center">
                    {{-- <button type="submit" class="btn btn-outline-success">Cash on Delivery</button> --}}
                    <a class="btn btn-outline-success mr-2" href="{{url('cash_order')}}">Cash on Delivery</a>
                    <a class="btn btn-outline-success" href="{{url('stripe',$totalprice)}}">Pay Using Card</a>


                    {{-- <button type="submit" class="btn btn-outline-success">Pay Using Card</button> --}}
                    {{-- <button type="button" class="btn btn-primary btn-lg">Add to cart</button> --}}
                  </div>
              </div>

            </div>
          </div>

    </div>
</div>
<!-- container-scroller -->



          <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
     </div>
     <!-- jQery -->
     <script src="home/js/jquery-3.4.1.min.js"></script>
     <!-- popper js -->
     <script src="home/js/popper.min.js"></script>
     <!-- bootstrap js -->
     <script src="home/js/bootstrap.js"></script>
     <!-- custom js -->
     <script src="home/js/custom.js"></script>
  </body>
</html>
