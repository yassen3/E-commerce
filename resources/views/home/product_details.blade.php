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

         <section style="background-color: #eee;">
            <div class="container py-5">
              <div class="row justify-content-center mb-3">
                <div class="col-md-12 col-xl-10">
                  <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                          <div class="bg-image hover-zoom ripple rounded ripple-surface">
                            <img src="{{Storage::url($products->image)}}"
                              class="w-100" />
                            <a href="#!">
                              <div class="hover-overlay">
                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                              </div>
                            </a>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <h5>{{$products->title}}</h5>
                          <div class="d-flex flex-row">
                            <div class="text-danger mb-1 me-2">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <span>310</span>
                          </div>
                          <div class="mt-1 mb-0 text-muted small">
                            <span>100% cotton</span>
                            <span class="text-primary"> • </span>
                            <span>Light weight</span>
                            <span class="text-primary"> • </span>
                            <span>Best finish<br /></span>
                          </div>
                          <div class="mb-2 text-muted small">
                            <span>Unique design</span>
                            <span class="text-primary"> • </span>
                            <span>For men</span>
                            <span class="text-primary"> • </span>
                            <span>Casual<br /></span>
                          </div>
                          <p class="text-truncate mb-4 mb-md-0">
                            {{$products->description}}.
                          </p>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                          <div class="d-flex flex-row align-items-center mb-1">
                            <h4 class="mb-1 me-1">{{$products->discount_price}} LE.</h4>
                            <span class="text-danger"><s>{{$products->price}}</s></span>
                          </div>
                          <h6 class="text-success">Free shipping</h6>
                          <form method="post" action="{{route('cart.store',$products->id)}}" enctype="multipart/form-data">
                             {{ csrf_field() }}
                            @method('GET')
                          <div class="d-flex flex-column mt-4">
                            <label>Quantity</label>
                            <input name="quantity" type="number" min="1" placeholder="1" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black" >
                            <button class="btn btn-outline-primary btn-sm mt-2" name="Add to Cart" type="submit">Add to Cart</button>
                        </form>
                        @if ($errors->any()) @foreach ($errors->all() as $error)
                          {{ $error }}
                        @endforeach @endif

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>



         <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

           Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
     </div>
     <!-- jQery -->
     <script src="{{asset('assets/home/js/jquery-3.4.1.min.js')}}"></script>
     <!-- popper js -->
     <script src="{{asset('assets/home/js/popper.min.js')}}"></script>
     <!-- bootstrap js -->
     <script src="{{asset('assets/home/js/bootstrap.js')}}"></script>
     <!-- custom js -->
     <script src="{{asset('assets/home/js/custom.js')}}"></script>
  </body>
</html>
