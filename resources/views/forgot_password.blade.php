<!doctype html>
<html lang="en">
<head>
  <title>SIAKSI</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
  <link rel="stylesheet" href="assets/login/css/style.css">
</head>
<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <h2 class="heading-section">Instrumen Akreditasi Program Studi (IAPS) <br> LAMDIK untuk program Sarjana</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url(assets/login/images/bg-2.jpeg);">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4">Forgot password</h3>
                </div>
                <div class="w-100">
                  <p class="social-media d-flex justify-content-end">
                  <!-- <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a> -->
                  <!-- <a href="https://www.instagram.com/baku.kele" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a> -->
                </p>
              </div>
            </div>
            @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{route('password.reset')}}" class="signin-form" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label class="label" for="name">Email user</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="ketik disini" value="{{old('email')}}" autofocus>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <button type="submit" class="form-control btn btn-primary rounded submit px-3" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">Reset password</button>
              </div>
              <div class="form-group d-md-flex">
                <div class="w-50 text-md-right">
                  <a href="{{route('login')}}">Login</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="assets/login/js/jquery.min.js"></script>
<script src="assets/login/js/popper.js"></script>
<script src="assets/login/js/bootstrap.min.js"></script>
<script src="assets/login/js/main.js"></script>

</body>
</html>
