@php
  header("X-Frame-Options:SAMEORIGIN");
  header("X-XSS-Protection:1");
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="DataKu Single Data Sistem Pemerintah Kota Salatiga">
  <meta name="author" content="infinite.codeworks">
  <meta name="keyword" content="Dataku Pemkot Pemerintah Kota Salatiga Single Data Statistik Sektoral Strategis Pilah Gender Triwulan Indikator Kinerja">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>DataKu</title>

  <link rel="icon" type="image/png"  href="{{asset('public/dataku/images/favicon.png')}}">

  <link href="{{asset('public/fonts/Font-Awesome/css/fontawesome-all.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/fonts/font-me-123/me123.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('public/dataku/css/bootstrap.min.css')}}" media="screen">
  <link rel="stylesheet" href="{{asset('public/dataku/css/dataku.css')}}">
</head>
@if (@$user->username == 'thor' || @$user->username == 'admin')
  {{-- <body class="app flex-row align-items-center" style = "background: url({{asset('dataku/images/background/wallhaven-94714.jpg')}})no-repeat center center fixed;background-size: cover;height: 100vh;"> --}}
  <body class="app flex-row align-items-center" style = "background: url({{asset(display_background())}})no-repeat center center fixed;background-size: cover;height: 100vh;">
@else
  <body class="app flex-row align-items-center" style = "background: url({{asset(display_background())}})no-repeat center center fixed;background-size: cover;height: 100vh;">
@endif
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="">
          <div class="p-4" style="background-color:transparent;">
            <div class="">
              <h4 style="font-family: me123;" class="text-center">
                <font style="color:#404042;text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.5);">Data</font>
                <font style="color:#007BFF;text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.5);">Ku</font>
              </h4>
              <!--Content-->
              @yield('content')

            </div>
          </div>
          <!-- <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sign up</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <button type="button" class="btn btn-primary active mt-3">Register Now!</button>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <div style="width:100%;text-align:center;color:white;margin-top:20px;">
      <div>
        <a href="http://diskominfo.salatiga.go.id" style="text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.3);">DISKOMINFO SALATIGA</a>
        <span style="text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);">&copy; 2018</span>
      </div>
    <div>
  </div>



  <script src="{{asset('public/dataku/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/dataku/js/thor.custom.js')}}"></script>
  <script src="{{asset('public/dataku/js/bootstrap.min.js')}}"></script>

</html>
