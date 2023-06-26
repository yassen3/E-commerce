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
                    <h3 class="card-title text-left mb-3">Add Category</h3>
                    <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('HEAD') --}}
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="category_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">
                      </div>
                      <div class="text-center">
                        <button type="submit" name="addCategory" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 text-black">Add</button>
                      </div>
                    </form>

                  </div>

                </div>

              </div>

              <table class="table table-dark table-striped">

                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                  <tr>

                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->category_name}}</td>
                    <td><a class="btn btn-primary" href="{{route('category.edit',$category->id)}}" role="button">Edit</a></td>
                    <td>
                        <form action="{{route('category.destroy',$category->id)}}" method="post"
                            onsubmit="return confirm('Are You Sure');">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    @endforeach
                  </tr>

                </tbody>
              </table>
              <!-- content-wrapper ends -->
            </div>

            <!-- row ends -->
          </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');

    <!-- End custom js for this page -->
  </body>

</html>
