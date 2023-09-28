<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      @include('admin.sidebar')

      <div class="container-fluid page-body-wrapper">

        @include('admin.navbar')

       
        
        <div class="container-fluid page-body-wrapper">
            <div class="container mt-5" style="width:40%">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-bs-dismiss="alert" >
                        X {{ session()->get('message') }}
                    </button> 
                </div>
                
                @endif
                
                <form action="{{ url('updatedoctor',$doctors->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Doctor's Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $doctors->name }}" style="background-color:white;color:black" REQUIRED>
                    </div>
                    <div class="form-group">
                        <label for="phone">Doctor's Number</label>
                        <input type="number" class="form-control" name="phone" value="{{ $doctors->phone }}" style="background-color:white;color:black" REQUIRED>
                    </div>
                    <div class="form-group">
                        <label for="speciality">Speciality</label>
                        <input type="text" class="form-control" name="speciality" value="{{ $doctors->speciality }}" style="background-color:white;color:black" REQUIRED>
                      </div>
                      <div class="form-group">
                        <label for="room">Room Number</label>
                        <input type="text" class="form-control" name="room" value="{{ $doctors->room }}" style="background-color:white;color:black" REQUIRED>
                    </div>
                    <div class="form-group">
                        <label for="image">Doctor Image</label>
                        <img src="{{ asset('/storage/'.$doctors->image) }}" width="100" height="100" alt="">
                        <input type="file" class="form-control-file" name="image" >
                    </div>
                    <input type="submit" class="btn btn-primary"value="Submit">

                </form>
            </div>



        </div>


      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>