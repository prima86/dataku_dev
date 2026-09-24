<div class="fixed-top">
  <div id="nav-logo-menu" class="" style="background-color:#F0F0F0;padding:0px 20px;">
    <div>
      <nav class="navbar navbar-light navbar-expand-md" style="padding:0px;">
        <!-- <a class="navbar-brand" href="#">DATA LINK</a>  -->
        <a class="navbar-brand" href="#"  style="">
          <img src="{{asset('images/logo.png')}}" alt="" class="d-none d-sm-block" style="height:20px;">
          <img src="{{asset('images/logo.png')}}" alt="" class="d-block d-sm-none"  style="height:15px;">
        </a>
        <button style="color:#fff !important;" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" style="color:#fff !important;"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            @if (Auth::check())
              <li class="nav-item dropdown">
                <a class="nav-link p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
                  <div class="row p-0 m-0">
                    <div class="ml-auto" style="padding-top:5px;padding-right:10px;font-weight:bold;text-transform:lowercase;">
                        <font style="font-size: 14px; margin-left: 1rem;">
                            @if(Auth::user()->user_type == "instansi") 
                              <span class="badge badge-warning">OPD / Instansi Vertikal</span>
                            @else
                              <span class="badge badge-warning">{{ Auth::user()->user_type }}</span>
                            @endif
                        </font>
                        <i class="fas fa-user mr-2"></i>
                        {{Auth::user()->getSessionUserProfile()->name}}
                    </div>
                    <div>
                      @if(Auth::user()->avatar)
                        <img src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" class="img-avatar fix-orientation" alt="<<Settings>>" style="height:40px;max-width:60px;min-width:40px;object-fit:cover;">
                        {{-- <img src="{{asset('images/avatars/avatar.jpg')}}" class="img-avatar" alt="" style="height:40px;"> --}}
                      @else
                        <img src="{{ asset('images/avatars/avatar.jpg') }}" class="img-avatar fix-orientation" alt="<<Settings>>" style="height:40px;max-width:60px;min-width:40px;object-fit:cover;">
                      @endif
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="download" style="background-color:#009999;">
                  {{-- <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a> --}}
                  <a class="dropdown-item text-white" href="{{url('user/edit_profile')}}"><i class="fa fa-user  mr-2"></i> Edit Profil</a>
                  <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt  mr-3"></i>{{ __('Logout') }}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </a>
                </div>
              </li>
            @else
              <li class="my-auto py-2 font-weight-bold"><a href="{{ route('login') }}"> Login </a></li>
            @endif
          </ul>

        </div>

      </nav>

    </div>
  </div>
  <div class="navbar navbar-expand-lg navbar-light bg-info" id="nav-main-menu">
      <!-- <a href="https://bootswatch.com/" class="navbar-brand">Bootswatch</a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive"  style="">
        <ul class="navbar-nav">
          <li class="nav-item {{(Request::segment(1)=='home' or empty(Request::segment(1)))?'font-weight-bold':''}}">
            <a class="nav-link" href="{{url('home')}}">Dashboard</a>
          </li>

          <!--<li class="nav-item {{(Request::segment(1)=='dss')?'font-weight-bold':''}}">-->
            <!--<a class="nav-link" href="{{url('dss')}}">Data Statistik Sektoral</a>-->
          <!--</li>-->
          <li class="nav-item dropdown top-menu" >
            <a class="nav-link dropdown-toggle {{(Request::segment(1)=='dss')?'font-weight-bold':''}}" data-toggle="dropdown" href="#" id="download">Statistik Sektoral<span class="caret"></span></a>
            <div class="dropdown-menu" aria-labelledby="download" style="background-color:#009999;">
                <a class="dropdown-item" href="{{url('dss')}}">Data Statistik Sektoral</a>
                <a class="dropdown-item" href="#">Standar Data</a>
                <a class="dropdown-item" href="#">e-Book Metadata</a>
                <a class="dropdown-item" href="#">e-Book Data</a>
                <a class="dropdown-item" href="api/documentation">Dokumentasi API</a>
            </div>
          </li>
          <li class="nav-item {{(Request::segment(1)=='dstrategis')?'font-weight-bold':''}}">
            <a class="nav-link" href="#">Data Strategis (Satria)</a>
          </li>
          <li class="nav-item {{(Request::segment(1)=='integration/harga')?'font-weight-bold':''}}">
            <a class="nav-link" href="{{url('integration/harga')}}">Harga Komoditas</a>
          </li>
          <li class="nav-item {{(Request::segment(1)=='gender')?'font-weight-bold':''}}">
            <a class="nav-link" href="#">Data Pilah Gender</a>
          </li>
          <li class="nav-item {{(Request::segment(1)=='radio')?'font-weight-bold':''}}">
            <a class="nav-link" href="#">CCTV</a>
          </li>
          <li class="nav-item {{(Request::segment(1)=='ppid')?'font-weight-bold':''}}">
            <a class="nav-link" href="https://ppid.salatiga.go.id/">PPID</a>
          </li>
          <li class="nav-item {{(Request::segment(1)=='radio')?'font-weight-bold':''}}">
            <a class="nav-link" href="https://suarasalatiga.com/">Radio Streaming</a>
          </li>
          <li class="nav-item {{(Request::segment(1)=='website')?'font-weight-bold':''}}">
            <a class="nav-link" href="https://web.salatiga.go.id/">Website OPD</a>
          </li>
        </ul>
      </div>
  </div>
</div>
