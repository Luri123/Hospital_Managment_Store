<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/home">
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
                        <button type="button" class="close" data-dismiss="alert">
                            X
                        </button>
                        {{ session()->get('message') }}
                    </div>
                
                @endif
                <form action="{{ url('sendmail',$appoint->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="greeting">Greeting</label>
                        <input type="text" class="form-control" name="greeting" placeholder="Greeting" style="background-color:white;color:black" REQUIRED>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <input type="text" class="form-control" name="body" placeholder="Body" style="background-color:white;color:black" REQUIRED>
                    </div>
                    
                      <div class="form-group">
                        <label for="actiontext">Action Text</label>
                        <input type="text" class="form-control" name="actiontext" placeholder="Action Text" style="background-color:white;color:black" REQUIRED>
                    </div>
                    
                    <div class="form-group">
                        <label for="actionurl">Action URL</label>
                        <input type="text" class="form-control" name="actionurl" placeholder="Action URL" style="background-color:white;color:black" REQUIRED>
                    </div>

                    <div class="form-group">
                        <label for="endpart">End Part</label>
                        <input type="text" class="form-control" name="endpart" placeholder="End Part" style="background-color:white;color:black" REQUIRED>
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