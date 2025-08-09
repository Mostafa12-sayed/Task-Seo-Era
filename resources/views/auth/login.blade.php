<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{asset('dashboard')}}/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=" {{asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{asset('dashboard/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Seo</b>Era</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{route('send.login')}}" method="post">
          @csrf
        <div class="input-group mb-3">
          <input type="text" name="identifier" class="form-control " value="{{old('identifier')}}" placeholder="Email Or Phone">

        </div>
          <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
          <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
      </form>


{{--      <p class="mb-1">--}}
{{--        <a href=" pages/examples/forgot-password.html">I forgot my password</a>--}}
{{--      </p>--}}
{{--      <p class="mb-0">--}}
{{--        <a href=" pages/examples/register.html" class="text-center">Register a new membership</a>--}}
{{--      </p>--}}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src=" {{asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src=" {{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
