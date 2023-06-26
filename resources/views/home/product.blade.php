<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
          <form method="get" action="{{url('product_search')}}">
          <div class="form-group">
            <label>Search</label>
            <input type="text" name="search" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black" placeholder="Search">
          </div>
          <div class="text-center">
            <button type="submit" name="Search" class="btn btn-outline-success">Search</button>
          </div>
        </form>

       </div>
       <div class="row">
        @foreach ($products as $product)

          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details',$product->id)}}" class="option1">
                      Product Details
                      </a>

                   </div>
                </div>
                <div class="img-box">
                   <img width="100%" height="auto" src="{{Storage::url($product->image)}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{$product->title}}
                   </h5>

                    @if ($product->discount_price!=null)
                    <h5>
                        {{$product->discount_price}} LE
                    </h5>

                    <h6 style="text-decoration: line-through; text-decoration-style: double; color:red ">
                    {{$product->price}} LE
                    </h6>

                    @else
                    {{$product->price}} LE
                    @endif


                </div>
             </div>
          </div>
          @endforeach
<br>
       </div>
       <span style="padding-top:30px">
        {{ $products->links() }}
      </span>
    </div>
 </section>

 {{-- <section style="background-color: #eee;">
  <div class="text-center container py-5">
    <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4>

    <div class="row">
        @foreach ($products as $product)
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src="{{Storage::url($product->image)}}"
              class="w-100" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-primary ms-2">New</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-3">{{$product->title}}</h5>
            </a>
            <a href="" class="text-reset">

            </a>
            @if ($product->discount_price!=null)
                    <h5>
                        {{$product->discount_price}} LE
                    </h5>

                    <h6 style="text-decoration: line-through; text-decoration-style: double; color:red ">
                    {{$product->price}} LE
                    </h6>

                    @else
                    {{$product->price}} LE
                    @endif
          </div>
        </div>
      </div>
      @endforeach

        </div>
      </div>

</section> --}}
