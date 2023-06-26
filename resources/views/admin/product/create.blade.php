<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
@include('admin.sidebar');
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('admin.header');
        <!-- partial -->

            <div class="row w-100 m-0">
              <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{session()->get('message')}}
                    </div>
                    @endif
                  <div class="card-body px-5 py-5">
                    <h3 class="card-title text-left mb-3">Add Product</h3>
                    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('HEAD') --}}
                      <div class="form-group">
                        <label >Product Name</label>
                        <input type="text" name="title" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" name="description" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="number" name="quantity" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="form-group">
                        <label>Discount Price</label>
                        <input type="text" name="discount_price" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control p_input text-white" name="category" id="">
                           @foreach ($categories as $category)

                         <option>{{$category->category_name}}</option>
                         @endforeach
                        </select><br>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="image" class="form-control p_input text-white">
                          </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
                      </div>
                    </form>

                  </div>

                </div>

              </div>
              @include('admin.script');

              <!-- End custom js for this page -->
            </body>

          </html>
