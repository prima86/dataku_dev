<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="DataKu Single Data Sistem Pemerintah Kota Salatiga">
  <meta name="author" content="infinite.codeworks">
  <meta name="keyword" content="Dataku Pemkot Pemerintah Kota Salatiga Single Data Statistik Sektoral Strategis Pilah Gender Triwulan Indikator Kinerja">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>DataKU</title>

  <!-- <link href="fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"> -->
  <link rel="shortcut icon" href="{{asset('dataku/images/favicon.png')}}">
  <link href="{{asset('dataku/Font-Awesome/css/fontawesome-all.min.css')}}" rel="stylesheet">
  <link href="{{asset('dataku/font-me-123/me123.css')}}" rel="stylesheet">
  <link href="{{asset('dataku/css/dataku.css')}}" rel="stylesheet">
  <link href="{{asset('dataku/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body class="app flex-row align-items-center" style = "background: url({{asset('dataku/images/background/infinite.codeworks.jpg')}})no-repeat center center fixed;background-size: cover;height: 100vh;">
  <div id="cl-wrapper" class="error-container mx-auto">
		<div class="page-error">
			@yield('content')
			<h3 class="text-center">Would you like to go <a href="{{url('home')}}">home</a> or go <a href="{{url()->previous()}}">back</a> ?</h3>
		</div>
    <div class="text-center copy" style="font-size:16px;"><a href="#"  >infinite.codeworks</a>@2018</div>
  </div>

  <script src="{{asset('dataku/js/jquery.min.js')}}"></script>
  <script src="{{asset('dataku/js/bootstrap.min.js')}}"></script>
</body>

</html>
