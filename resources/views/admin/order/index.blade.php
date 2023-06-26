
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
                @endif
                <div class="card-body px-5 py-5">

                    <form method="get" action="{{url('search')}}" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('HEAD') --}}
                      <div class="form-group">
                        <label>Search</label>
                        <input type="text" name="search" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="text-center">
                        <button type="submit" name="Search" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">Search</button>
                      </div>
                    </form>

                  </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-2 py-2">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product Name
                                </th>
                                <th scope="col" class="px-1 py-1">
                                    Quantity
                                </th>
                                <th scope="col" class="px-2 py-2">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delivered
                                </th>
                                <th scope="col" class="px-2 py-2">
                                    Delivery Status
                                </th>
                                <th scope="col" class="px-2 py-2">
                                    Payment Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($orders as $order)
                              <tr class="">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  {{$order->name}}
                                </th>

                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->email}}
                                </td>

                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->phone}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->product_title}}
                                </td>
                               <td scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$order->quantity}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->price}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   <img width="100%" height="auto" src="{{Storage::url($order->image)}}">
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->created_at}}
                                </td>
                                <td >
                                    @if($order->delivery_status=='Processing')
                                    <a href="{{route('delivered',$order->id)}}" onclick="return confirm('Are You Sure This Product is Delivered!!')" class="btn btn-primary"> Delivered</a>

                                    @else
                                        <p>Delivered</p>
                                    @endif
                                </td>

                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->delivery_status}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->payment_status}}
                                </td>
                                <td>
                                <form method="POST" action="{{route('order.destroy',$order->id)}}"

                                    onsubmit="return confirm('Are You Sure');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">Delete</button>
                                </form>
                               </td>
                            </tr>
                         @endforeach


                        </tbody>
                    </table>
                </div>


            </div>
        </div>

              @include('admin.script');

              <!-- End custom js for this page -->
            </body>

          </html>
