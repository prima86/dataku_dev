@extends('layouts.main_layout', ['breadcrumb' => ['Dashboard']])

@section('content')
  @php
    // print_array(Session('user_profile'));
    // Cookie::queue(Cookie::forever('night_mode', '1'));
    // echo Cookie::get('night_mode');
  @endphp

    <div class="card mb-2" style="width:100%;border:none;">
      <div class="card-header" style="background-color:#FFFFFF;">
        <div class="row no-gutters">
          <div class="col-md-10">
            <img src="{{asset('images/home/satu-data-indonesia.png')}}" alt="Satu Data Indonesia" style="height:50px;" class="mr-2"/>
            <img src="{{asset('images/home/logo-bps.jpg')}}" alt="BPS Kota Salatiga" style="height:50px;" class="mr-2"/>            
            <img src="{{asset('images/home/logo-bappeda.jpg')}}" alt="Bappeda Kota Salatiga" style="height:40px;" class="mr-2"/>            
            <img src="{{asset('images/home/logo-diskominfo.jpg')}}" alt="Diskominfo Kota Salatiga" style="height:50px;" class="mr-2"/>
          </div>
          <div class="col-md-2">
            <img src="{{asset('images/home/berakhlak-bangga-melayani-bangsa.png')}}" alt="Bangga melayani bangsa" style="height:35px; vertical-align:top; float:right;" class="mr-2"/>
          </div>
        </div>
      </div>
      
      @if(Auth::check())
      <div class="card-header text-secondary" style="background-color: #e6f7ff">
        <div class="d-flex flex-column align-items-center text-center">
        </div>
        <div class="card-body-icon" style="position: absolute; z-index: 0; bottom: 6px; left: 18px; font-size: 40px;">
          <img alt="user img" class="img-fluid d-block rounded-circle border" style="width: 66px; height: 66px;" @if(isset(Auth::user()->avatar)) @if(substr(Auth::user()->avatar, -3) == 'png' || substr(Auth::user()->avatar, -3) == 'jpg' || substr(Auth::user()->avatar, -4) == 'jpeg') src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" @else src="{{asset('images/avatars/no-photo.jpg')}}" @endif @else {{asset('images/avatars/no-image-available.jpg')}} @endif >
        </div>

        <div class="card-body-photo" style="position: absolute; z-index: 0; bottom: 12px; left: 282px; opacity: 0.8; font-size: 20px;">
          <i class="fas fa-key mr-2"></i>
        </div>
        <h6 style="margin-left: 4.4rem;">
          <font style="font-weight: bold; color: #00b33c; font-style: italic;">Welcome back, </font>
          <font style="font-weight: bold; color: #0073e6;">{{ @session('user_profile')->name }} !!</font>
        </h6>
        <h6 style="font-size: 14px; margin-left: 4.4rem; margin-bottom: 0.5rem; color: #5c5c3d;">Mulai login :
          <font style="font-size: 12px; font-style: italic;">{{ Auth::user()->last_login }}</font>
        </h6>
      </div>
      @endif
      <!-- <div class="card-body d-block d-sm-none" style="font-weight:bold;font-size:1.2em;color:#D53343;align:center;font-style:italic;">
        <div class="text-center">
          <img src="{{asset('dataku/images/logo_pemkot_salatiga_300.png')}}" alt="logo pemkot salatiga" style="height:40px;" class="mr-2"/>
        </div>
        <div class="text-center">
          "Salatiga menuju SATU DATA"
        </div>
      </div> -->
    </div>

    <!-- <div class="card" style="border:none;">
      <div class="card-body" style="background-color:#FFFFFF;">
        <a href="https://salatiga.go.id/logo-hut-kota-salatiga-ke-1274/" target="_blank">
          <img src="{{asset('images/home/banner-1274.jpg')}}" alt="hut-1274-salatiga" style="max-width: 100%;" class="mr-2 img-fluid"/>
        </a>
      </div>
    </div> -->

    <!-- <div class="card" style="border:none;">
      <div class="card-body" style="background-color:#FFFFFF;">
        <a href="https://salatiga.go.id/logo-hut-kota-salatiga-ke-1274/" target="_blank">
          <img src="{{asset('images/home/banner-hut-ri-79.jpg')}}" alt="hut-1274-salatiga" style="max-width: 100%;" class="mr-2 img-fluid"/>
        </a>
      </div>
    </div> -->

    <div class="card mb-3" style="max-width:100%;border:none;">
      <div class="row no-gutters" style="background: #FFFFFF;">
        <div class="col-md-4">
          <div class="card-body" style="background: #FFFFFF;">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-1.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-2.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-3.jpg')}}" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-4.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-5.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-6.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-7.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-8.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-9.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-10.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-11.jpg')}}" alt="Forth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{asset('images/slider_infografis/infografis-12.jpg')}}" alt="Forth slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

            <!-- <div class="card mt-3" style="width: 100%;">
              <img class="card-img-top" src="{{ asset('images/home/matur-mas-wali-1x1.jpg') }}" alt="">
            </div>
            <div class="card" style="width: 100%;">
              <img src="{{asset('images/home/salatiga-kalender-event-agustus.jpg')}}" alt="hut-ri-79" style="max-width: 100%;" class="mr-2 img-fluid"/>
            </div> -->

            <div class="card mt-3" style="width: 100%;">
              <a href="https://www.instagram.com/p/C_PWCFSPAGd/?hl=en" target="_blank">
                <img class="card-img-top" src="{{ asset('images/home/jadwal_kegiatan_statistik_2025.jpg') }}" alt="">
              </a>
            </div>

            <div class="card mt-3" style="width: 100%;">
              <a href="https://trustpositif.kominfo.go.id/" target="_blank">
                <img class="card-img-top" src="{{ asset('images/home/lapor-konten-negatif.jpg') }}" alt="lapor.go.id">
              </a>
            </div>

            <div class="card mt-3" style="width: 100%;">
              <a href="https://www.instagram.com/pemkotsalatiga/p/DaRZTA3j8xS/?hl=en" target="_blank">
                <img class="card-img-top" src="{{ asset('images/home/kalender-event-juli-2026-1.jpg') }}" alt="lapor.go.id">
              </a>
            </div>
            
            <!-- <div class="card mt-3" style="width: 100%;">
              <img class="card-img-top" src="{{ asset('images/home/tandahoax.jpg') }}" alt="Card image cap">
            </div> -->
          </div>
          <!-- <div class="card" style="width: 100%;">
            <a href="https://ppid.salatiga.go.id">
              <img class="card-img-top" src="{{ asset('images/home/ppid-2.jpg') }}" alt="lapor.go.id">
            </a>
          </div> -->
        </div>
        <div class="col-md-8">
          <div class="card-body" style="background: #FFFFFF;">
            <!-- Banner Bulan November -->
            <div class="row row-cols-1 row-cols-md-3 mb-3">
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <a href="{{url('kelcantik')}}">
                    <img class="card-img-top" src="{{asset('images/home/logo-kelurahan-cantik.png')}}" alt="">
                  </a>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <img class="card-img-top" src="{{asset('images/home/des-banner-general.jpg')}}" alt="">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <img class="card-img-top" src="{{asset('images/home/penghargaan-salatiga-informatif.jpg')}}" alt="">
                </div>
              </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 mt-2">
                <div class="col">
                    <div class="card h-100">
                      <a href="https://s.id/Salatiga1276" target="_blank">
                        <img src="{{asset('images/home/rilis-logo-hari-jadi-salatiga-1276.jpg')}}" alt="..." style="width: 100%;">
                      </a>
                    </div>
                </div>
            </div>
            <div class="row">
              <!-- <div class="col-12">
                <a href="https://salatiga.go.id/banner-resmi-hut-ri-ke-79/" target="_blank">
                  <img src="{{asset('images/home/banner-hut-ri-79-putih-5x1.jpg')}}" alt="hut-ri-79" style="max-width: 100%;" class="mr-2 img-fluid"/>
                </a>
                <marquee behavior='alternate' style="background-color:#A52A2A; font-weight:bold; color:white; font-family:monospace;"> Download banner logo HUT RI ke-79 </marquee>
              </div> -->
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/sektoral.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Data Statistik Sektoral</h5>
                    <p class="card-text">Menampilkan data Statistik Sektoral Kota Salatiga.</p>
                    <a href="{{url('dss')}}" class="btn btn-outline-info">Detail >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/gender.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Data Pilah Gender</h5>
                    <p class="card-text">Menampilkan data Pilah Gender Kota Salatiga.</p>
                    <a href="{{url('dsg')}}" class="btn btn-outline-info">Detail >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/data_strategis.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">SATRIA</h5>
                    <p class="card-text">Kumpulan Data Strategis Kota Salatiga.</p>
                    <a href="{{url('dstrategis')}}" class="btn btn-outline-info">Detail >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto; margin-top: 1.5rem;">
                  <img class="card-img-top" src="{{asset('images/icons/dashboard/open_data.gif')}}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Open Data</h5>
                    <p class="card-text">Portal Open Data Pemerintah Kota Salatiga.</p>
                    <!-- <a href="https://web.salatiga.go.id/" class="btn btn-outline-info">Go to websites >></a> -->
                    <a href="https://data.salatiga.go.id/" class="btn btn-outline-info">Detail >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto; margin-top: 1.5rem;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/e-book.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">e-Book Statistik Sektoral</h5>
                    <p class="card-text">Download file e-book Data Statistik Sektoral Kota Salatiga.</p>
                    <a href="{{url('elibrary')}}" class="btn btn-outline-info">Download >>.</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto; margin-top: 1.5rem;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/markets.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Informasi Harga</h5>
                    <p class="card-text">Informasi harga kebutuhan pokok di pasar-pasar Kota Salatiga.</p>
                    <a href="{{url('integration/harga')}}" class="btn btn-outline-info">Detail >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto; margin-top: 1.5rem;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/statistik_dasar.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Statistik BPS</h5>
                    <p class="card-text">Menampilkan data Statistik dari website BPS Kota Salatiga.</p>
                    <a href="{{url('http://salatigakota.bps.go.id')}}" class="btn btn-outline-info">Go to websites >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto; margin-top: 1.5rem;">
                  <img class="card-img-top" src="{{ asset('images/icons/dashboard/ppid.gif') }}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Website PPID</h5>
                    <p class="card-text">Pejabat Pengelola Informasi dan Dokumentasi</p>
                    <a href="https://ppid.salatiga.go.id/" class="btn btn-outline-info">Go to websites >></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto; margin-top: 1.5rem;">
                  <img class="card-img-top" src="{{asset('images/icons/dashboard/websites.gif')}}" alt="Card image cap">
                  <div class="card-body" style="background-color: #F0FFFF; color: #191970;">
                    <h5 class="card-title">Website OPD</h5>
                    <p class="card-text">Menampilkan website Organisasi Perangkat Daerah Kota Salatiga.</p>
                    <!-- <a href="https://web.salatiga.go.id/" class="btn btn-outline-info">Go to websites >></a> -->
                    <a href="{{url('website')}}" class="btn btn-outline-info">Go to websites >></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card-body" style="background: #FFFFFF;">
            <div class="row row-cols-1 row-cols-md-3">
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <a href="https://www.kominfo.go.id/content/all/laporan_isu_hoaks" target="_blank">
                    <img class="card-img-top" src="{{asset('images/home/banner-laporan-hoaks-kemenkominfo.png')}}" alt="Laporan isu hoax">
                  </a>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <a href="https://www.lapor.go.id" target="_blank">
                    <img class="card-img-top" src="{{asset('images/home/banner-lapor-go-id.jpg')}}" alt="https://www.lapor.go.id">
                  </a>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card" style="width: auto;">
                  <a href="https://laporgub.jatengprov.go.id" target="_blank">
                    <img class="card-img-top" src="{{asset('images/home/laporgub.jpg')}}" alt="https://laporgub.jatengprov.go.id">
                  </a>
                </div>
              </div>
            </div>

            <!-- <div class="row row-cols-1 row-cols-md-3">
              <div class="col">
                <div class="card h-100">
                  <img src="{{asset('images/home/banner-matur-mas-wali.jpg')}}" alt="..." style="width: 100%;">
                </div>
              </div>
            </div> -->
            <!-- <div class="card mt-2" style="width: 100%;">
              <a href="https://ppid.salatiga.go.id">
                <img class="card-img-top" src="{{ asset('images/home/ppid-2.jpg') }}" alt="lapor.go.id">
              </a>
            </div> -->
            <!-- <div class="row row-cols-1 row-cols-md-3">
              <div class="col mt-3">
                <div class="card" style="border-width: 0px;">
                  <img src="{{asset('images/home/ppid-banner.jpg')}}" alt="..." style="width: 90%;">
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <!-- </div> -->
    </div>
    <!-- <div class="card">
      {{-- <div class="card-header">
        Dashboard
      </div> --}}
    </div> -->
@endsection
