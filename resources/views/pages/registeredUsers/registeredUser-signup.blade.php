@extends('layout.app')

@section('content')

@include('inc.nav')

<br>
<br>
<br>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">

    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Employee Registeration</p>
                </div>
                <div class="card-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>

                    @endif
                  <form role="form" method="post" action="{{ route('registeredUser.store') }}" enctype="multipart/form-data">

                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Firstname</label>
                      <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control">

                    </div>
                    @error('firstname')
                    <p style="color:red">{{ $message }}</p>
                        @enderror

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Lastname</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control">

                          </div>
                          @error('lastname')
                          <p style="color:red">{{ $message }}</p>
                              @enderror
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control">

                    </div>
                    @error('email')
                    <p style="color:red">{{ $message }}</p>
                        @enderror
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" value="{{ old('password') }}" class="form-control">

                    </div>
                    @error('password')
                    <p style="color:red">{{ $message }}</p>
                        @enderror
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Password Confirm</label>
                        <input type="password" name="password_confirm" value="{{ old('password_confirm') }}" class="form-control">

                      </div>
                      @error('confirmed')
                      <p style="color:red">{{ $message }}</p>
                        @enderror

                          <div class="input-group input-group-outline mb-3">
                            <label class="form-label"></label>
                            <input type="file" name="image" value="{{ old('location') }}" class="form-control">
                          </div>
                          @error('image')
                          <p style="color:red">{{ $message }}</p>
                            @enderror


                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>
@endsection
</html>
