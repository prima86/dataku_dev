

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="card mb-2">
        <div class="card-header" style="background-color:#FFFFFF;">
          <div class="row no-gutters">
            <div class="col-md-1">
              <img src="<?php echo e(asset('images/logo_pemkot_salatiga_300.png')); ?>" alt="..." class="img-thumbnail" style="border:0px; width:55px; margin-left: 3rem">
            </div>
            <div class="col-md-2" style="font-weight:bold;font-style:italic;">
              DINAS PERDAGANGAN<br/>KOTA SALATIGA
            </div>
            <div class="col-md-8">
              <img src="<?php echo e(asset('images/home/info-harga.jpg')); ?>" alt="..." class="img-thumbnail" style="border:0px; width:180px; margin-top: 0rem;">
              <p class="lead" style="margin-left:0.4rem;margin-top:-0.4rem;">Informasi harga komoditas pasar dari Dinas Perdagangan Kota Salatiga</p>
            </div>
            <div class="col-md-1">
              <img src="<?php echo e(asset('images/home/berakhlak-bangga-melayani-bangsa.png')); ?>" alt="Bangga melayani bangsa" style="height:35px; vertical-align:top; float:right;" class="mr-2"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- BAGIAN TABEL PASAR REJOSARI -->
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card mb-2">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.153142278473!2d110.49549167495215!3d-7.336692772163912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a79596e3e5811%3A0xfb49e3b2549163e7!2sPasar%20Rejosari!5e0!3m2!1sid!2sid!4v1709638751621!5m2!1sid!2sid" width="auto" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div class="card-header font-weight-bold">PASAR REJOSARI</div>
        <div class="card-body">
          <b>Last Updated : <?php echo e(ina_date($tanggal)); ?></b>
          <div class="table-responsive">
            <table class="table table-sm table-striped">
              <tr>
                <th>Komoditi</th>
                <th class="text-right">Harga</th>
              </tr>
              <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value->nama_pasar === "PASAR REJOSARI"): ?>
                  <tr>
                    <td><?php echo e($value->nama_komoditi); ?></td>
                    <td class="text-right"><?php echo e(number_format($value->harga)); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </div>
        </div>
      </div>
    </div>

    <!-- BAGIAN TABEL PASAR BLAURAN -->
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card mb-2">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.3071997509938!2d110.50720548818467!3d-7.328179873049325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a79e42ac28e0b%3A0x6af70d9fa1634a4f!2sPasar%20Blauran%20Salatiga!5e0!3m2!1sid!2sid!4v1709638931390!5m2!1sid!2sid" width="auto" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div class="card-header font-weight-bold">PASAR BLAURAN</div>
        <div class="card-body">
          <b>Last Updated : <?php echo e(ina_date($tanggal)); ?></b>
          <div class="table-responsive">
            <table class="table table-sm table-striped">
              <tr>
                <th>Komoditi</th>
                <th class="text-right">Harga</th>
              </tr>
              <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value->nama_pasar === "PASAR BLAURAN"): ?>
                  <tr>
                    <td><?php echo e($value->nama_komoditi); ?></td>
                    <td class="text-right"><?php echo e(number_format($value->harga)); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </div>
        </div>
      </div>
    </div>

    <!-- BAGIAN TABEL PASAR RAYA I -->
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card mb-2">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2121676946495!2d110.50252677495213!3d-7.330052072091068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a7830e86dea77%3A0xd1dff1ebdc58e1d1!2sPasar%20Raya%20I%20Salatiga!5e0!3m2!1sid!2sid!4v1709639038086!5m2!1sid!2sid" width="auto" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div class="card-header font-weight-bold">PASAR RAYA I</div>
        <div class="card-body">
          <b>Last Updated : <?php echo e(ina_date($tanggal)); ?></b>
          <div class="table-responsive">
            <table class="table table-sm table-striped">
              <tr>
                <th>Komoditi</th>
                <th class="text-right">Harga</th>
              </tr>
              <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value->nama_pasar === "PASAR RAYA I"): ?>
                  <tr>
                    <td><?php echo e($value->nama_komoditi); ?></td>
                    <td class="text-right"><?php echo e(number_format($value->harga)); ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            </div>
        </div>
      </div>
    </div>
  </div>
  Sumber : simdag.salatiga.go.id
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main_layout', ['breadcrumb' => ['Info Harga']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dataku\resources\views/harga/index.blade.php ENDPATH**/ ?>