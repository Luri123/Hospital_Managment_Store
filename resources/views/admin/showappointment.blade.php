<!DOCTYPE html>
<html lang="en">
  <head>
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
            <div class="container mt-5" align="center">

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Doctor Name</th>
                <th scope="col">Date</th>
                <th scope="col">Message</th>
                <th scope="col">Status</th>
                <th scope="col">Approved</th>
                <th scope="col">Canceled</th>
                <th scope="col">Send Mail</th>
              </tr>
            </thead>
            <tbody>
              @foreach($appoint as $appoints)
              <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $appoints->name }}</td>
                <td>{{ $appoints->email }}</td>
                <td>{{ $appoints->phone }}</td>
                <td>{{ $appoints->doctor }}</td>
                <td>{{ $appoints->date }}</td>
                <td>{{ $appoints->message }}</td>
                <td>{{ $appoints->status }}</td>
                <td>
                    <a href="{{ url('approved',$appoints->id) }}" class="btn btn-primary">Approved</a>
                </td>
                <td>
                    <a href="{{ url('canceled',$appoints->id) }}" class="btn btn-danger">Canceled</a>
                </td>
                <td>
                  <a href="{{ url('emailview',$appoints->id) }}" class="btn btn-info">Send Mail</a>
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>