
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="DataKu Single Data Sistem Pemerintah Kota Salatiga">
  <meta name="author" content="infinite.codeworks">
  <meta name="keyword" content="Dataku Pemkot Pemerintah Kota Salatiga Single Data Statistik Sektoral Strategis Pilah Gender Triwulan Indikator Kinerja">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <meta http-equiv="pragma" content="no-cache">

  <title>DataKu</title>

  <link rel="icon" type="image/png"  href="<?php echo e(asset('dataku/images/favicon.png')); ?>">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="screen">
  <link rel="stylesheet" href="<?php echo e(asset('dataku/css/bootstrap.min.css')); ?>" media="screen">
  <link rel="stylesheet" href="<?php echo e(asset('dataku/css/dataku.css')); ?>">

  <!-- HighCharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <?php
    $night_mode = @Cookie::get('night_mode');
  ?>
  <?php if($night_mode == 2): ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('dataku/css/dataku_night_mode.css')); ?>">
  <?php elseif($night_mode == 1): ?>
    
    <?php
    $current_time = date('H:i:s');
    $start = "06:00:00";
    $end = "18:00:00";
    $date1 = DateTime::createFromFormat('H:i:s', $current_time);
    $date2 = DateTime::createFromFormat('H:i:s', $start);
    $date3 = DateTime::createFromFormat('H:i:s', $end);
    if ($date1 > $date2 && $date1 < $date3)
    {
      // echo 'day';
    }else{
      echo '<link rel="stylesheet" href="'.asset('dataku/css/dataku_night_mode.css').'">';
      // echo 'night';
    }
    ?>
  <?php endif; ?>
  <link href="<?php echo e(asset('fonts/Font-Awesome/css/fontawesome-all.min.css')); ?>" rel="stylesheet">

  

  <!-- Custom Style -->
	<?php echo $__env->yieldContent('header'); ?>
</head>

<body style="">
  <!--TOP MENU-->
	<?php echo $__env->make('layouts.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!--BREADCRUMB-->
  <?php if(is_array(@$breadcrumb)): ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(url('home')); ?>" class="text-info">Home</a></li>
        <?php for($i=0; $i < count($breadcrumb); $i++): ?>
          <li class="breadcrumb-item text-info"><?php echo e($breadcrumb[$i]); ?></li>
        <?php endfor; ?>
      </ol>
    </nav>
  <?php endif; ?>

  <!-- CONTENT -->
  <div id="dataku-content" class="container-fluid" style=" min-height: calc(100vh - 240px);">
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <footer id="footer" style="background-color:#d3d9e5;margin:0px;margin-top:10px;">
    <div class="card text-center" style="border:none;">
      <div class="card-body text-info">
        <!-- <div class="card text-center"> -->
          <div class="card-body">
            <h5 class="card-title">Dinas Komunikasi dan Informatika Kota Salatiga</h5>
            <p class="card-text">Jalan Letjen Sukowati Nomor 51 Salatiga Kode Pos 50724 Telp. (0298) 326767</p>
            <p class="card-text">Faks. (0298) 321398 Situs : <a href="https://diskominfo.salatiga.go.id">https://diskominfo.salatiga.go.id</a></p>
            <p class="card-text mb-2">Surat elektronik : diskominfo@salatiga.go.id</p>
            <a href="https://www.instagram.com/pemkotsalatiga/" target="_blank">
              <img src="<?php echo e(asset('images/home/ig-logo.png')); ?>" alt="instagram" style="width: 35px;" data-toggle="tooltip" data-placement="right" title="facebook">
            </a>
            <a href="https://www.youtube.com/@pemkot_salatiga" target="_blank">
              <img src="<?php echo e(asset('images/home/yt-logo.png')); ?>" alt="youtube" style="width: 35px;" data-toggle="tooltip" data-placement="right" title="facebook">
            </a>
            <a href="https://www.facebook.com/dinaskominfosala3/" target="_blank">
              <img src="<?php echo e(asset('images/home/fb-logo.png')); ?>" alt="facebook" style="width: 35px;" data-toggle="tooltip" data-placement="right" title="facebook">
            </a>
            <a href="https://twitter.com/pemkot_salatiga" target="_blank">
              <img src="<?php echo e(asset('images/home/tw-logo.png')); ?>" alt="twitter" style="width: 35px;" data-toggle="tooltip" data-placement="right" title="facebook">
            </a>
          </div>
        <!-- </div> -->
        <a href="#top">Back to top</a>

        <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
        <!-- Histats.com  START  (aync)-->
        <!-- <script type="text/javascript">var _Hasync= _Hasync|| [];
        _Hasync.push(['Histats.start', '1,4702838,4,408,270,55,00011101']);
        _Hasync.push(['Histats.fasi', '1']);
        _Hasync.push(['Histats.track_hits', '']);
        (function() {
        var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
        hs.src = ('//s10.histats.com/js15_as.js');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
        })();</script>
        <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4702838&101" alt="counter free hit unique web" border="0"></a></noscript> -->
        <!-- Histats.com  END  -->

        <!--<div class="row px-3">-->
        <!--  <div><a href="http://diskominfo.salatiga.go.id">Dinas Komunikasi dan Informatika Kota Salatiga</a> © 2018</div>-->
        <!--  <div class="ml-auto">-->
        <!--    <select class="form-control" name="night_mode" style="height: 25px;line-height:25px;padding:0px;">-->
        <!--      <option value="" disabled selected>night mode :</option>-->
        <!--      <option value="0" <?php echo ($night_mode == '0')? 'selected':''; ?> >disable</option>-->
        <!--      <option value="1" <?php echo ($night_mode == '1')? 'selected':''; ?> >adaptive</option>-->
        <!--      <option value="2" <?php echo ($night_mode == '2')? 'selected':''; ?> >persistance</option>-->
        <!--    </select>-->
        <!--  </div>-->
        <!--</div>-->
        
      </div>
      <div class="card-footer bg-info text-white">Copyright © 2018 | Dinas Komunikasi dan Informatika Kota Salatiga</div>
    </div>
  </footer>

  <script src="<?php echo e(asset('dataku/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dataku/js/popper.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dataku/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('app_plugins/bootbox/bootbox.min.js')); ?>"></script>
  <script src="<?php echo e(asset('app_plugins/jquery.number/jquery.number.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dataku/js/thor.custom.js')); ?>"></script>

  

  <!-- Custom script -->
  <?php echo $__env->yieldContent('custom_script'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\dataku\resources\views/layouts/main_layout.blade.php ENDPATH**/ ?>