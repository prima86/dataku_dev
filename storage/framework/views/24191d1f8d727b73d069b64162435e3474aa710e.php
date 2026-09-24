


<?php $__env->startSection('content'); ?>

  <?php if(@session('user_profile')->user_type): ?>
  <div class="row no-gutters" style="background: #FFFFFF;">
    <?php if(Auth::user()->user_type == "admin"): ?>
      <div class="card" style="width: 100%; background: #FFFFFF;">      
        <div class="card-body" style="background: #FFFFFF;">
          <div class="row text-white" style="background: #FFFFFF;">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card bg-info ml-4 mb-2" style="width: 100%;">
                <div class="card-body">
                  <div class="card-body-icon" style="position: absolute; z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                    <i class="fas fa-database mr-2"></i>
                  </div>
                  <h5 class="card-title">Total Dataset</h5>
                  <div class="display-4" style="font-weight: bold;"><?php echo e($counter['dss_toc_active']); ?></div>
                  <p class="card-text text-white"><?php echo e($counter['txt_tahun_now']); ?></p>
                  <!-- <a href="#">
                    <p class="card-text text-white">Lihat detail<i class="fas fa-angle-double-right ml-2"></i></p>
                  </a> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card bg-success ml-4 mb-2" style="width: 100%;">
                <div class="card-body">
                  <div class="card-body-icon" style="position: absolute; z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                    <i class="fas fa-check mr-2"></i>
                  </div>
                  <h5 class="card-title">Sudah Publish</h5>
                  <div class="display-4" style="font-weight: bold;"><?php echo e($counter['dss_stat_publish']); ?></div>
                  <p class="card-text text-white"><?php echo e($counter['txt_tahun_now']); ?></p>
                  <!-- <a href="#">
                    <p class="card-text text-white">Lihat detail<i class="fas fa-angle-double-right ml-2"></i></p>
                  </a> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card bg-warning ml-4 mb-2" style="width: 100%;">
                <div class="card-body">
                  <div class="card-body-icon" style="position: absolute; z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                    <i class="fas fa-clock mr-2"></i>
                  </div>
                  <h5 class="card-title">Dalam Verifikasi</h5>
                  <div class="display-4" style="font-weight: bold;"><?php echo e($counter['dss_stat_verif']); ?></div>
                  <p class="card-text text-white"><?php echo e($counter['txt_tahun_now']); ?></p>
                  <!-- <a href="#">
                    <p class="card-text text-white">Lihat detail<i class="fas fa-angle-double-right ml-2"></i></p>
                  </a> -->
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card bg-secondary ml-4 mb-2" style="width: 100%;">
                <div class="card-body">
                  <div class="card-body-icon" style="position: absolute; z-index: 0; top: 25px; right: 4px; opacity: 0.4; font-size: 90px;">
                    <i class="fas fa-table mr-2"></i>
                  </div>
                  <h5 class="card-title">Belum Input</h5>
                  <div class="display-4" style="font-weight: bold;"><?php echo e($counter['dss_stat_empty']); ?></div>
                  <p class="card-text text-white"><?php echo e($counter['txt_tahun_now']); ?></p>
                  <!-- <a href="#">
                    <p class="card-text text-white">Lihat detail<i class="fas fa-angle-double-right ml-2"></i></p>
                  </a> -->
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="background: #FFFFFF;">
            <!-- <div class="card border-info ml-4 mb-2" style="width: 43.5rem;">
              <div class="card-body text-info">
                <h5 class="card-title"><i>Arsip Tabel Data Statistik Sektoral pada Database Sistem</i></h5>
                <div class="card-body-icon" style="position: absolute; z-index: 0; top: 40px; right: 24px; opacity: 0.4; font-size: 90px;">
                  <i class="fas fa-database mr-2"></i>
                </div>
                <p>
                  <font>Database menampung <b><?php echo e($counter['all_dss_toc']); ?> tabel</b> data Statistik Sektoral, terdiri dari :</font>
                </p>
                <p>
                  <font>- <b><?php echo e($counter['dss_toc_active']); ?> Tabel</b> aktif (masih digunakan oleh OPD sampai saat ini) </font>
                </p>
                <p>
                  <font>- <b><?php echo e($counter['all_dss_toc'] - $counter['dss_toc_active']); ?> Tabel</b> tidak aktif (sudah tidak digunakan User OPD / Instansi Vertikal) </font>
                </p>
              </div>
            </div> -->
            <div class="col-xl-6 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card border-info ml-4 mb-2" style="width: 100%;">
                <div class="card-body text-info">
                  <!-- <h5 class="card-title"><i>Whats New....!!! </i></h5> -->
                  <div class="card border-info mb-" style="max-width: 100%;">
                    <div class="card-header">Setting Tanggal Verval</div>
                    <div class="card-body text-info">
                      <h5 class="card-title"></h5>
                      <p class="card-text">Menu ini adalah menu untuk mencatat Tanggal Verval Data Statistis Sektoral.</p>
                      <a href="<?php echo e(url('dss/set_dss_verval_date')); ?>" class="btn btn-success">Input Tanggal Verval</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card border-success ml-4 mb-2" style="width: 100%;">
                <!-- <div class="card-header bg-transparent border-success" style="color: #009900; font-weight: bold;">Jumlah User</div> -->
                <div class="card-body text-success">
                  <div class="card-body-icon" style="position: absolute; z-index: 0; top: 40px; right: 22px; opacity: 0.4; font-size: 90px;">
                    <i class="fas fa-building mr-2"></i>
                  </div>
                  <h4 class="card-title">Jumlah Produsen Data</h4>
                  <div class="display-4" style="font-weight: bold;"><?php echo e($instansi_list->count()); ?></div>
                  <p class="card-text mt-2">OPD dan Instansi Vertikal</p>
                  <a href="<?php echo e(url('instansi/list')); ?>">
                    <!-- <p class="card-text text-white">List OPD<i class="fas fa-angle-double-right ml-2"></i></p> -->
                    <button type="button" class="btn btn-outline-success">Lihat daftar OPD/Instansi</button>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card border-danger ml-4 mb-2" style="width: 100%;">
                <!-- <div class="card-header bg-transparent border-danger" style="color: #009900; font-weight: bold;">Jumlah User</div> -->
                <div class="card-body text-danger">
                  <div class="card-body-icon" style="position: absolute; z-index: 0; top: 40px; right: 22px; opacity: 0.4; font-size: 90px;">
                    <i class="fas fa-user mr-2"></i>
                  </div>
                  <h4 class="card-title">Jumlah User</h4>
                  <div class="display-4"><b><?php echo e($counter['users_admin']); ?></b> <font style="font-size: 16px;">user level Admin</font></div>
                  <div class="display-4"><b><?php echo e($counter['users_instansi']); ?></b> <font style="font-size: 16px;">user level OPD/Instansi Vertikal</font></div>
                  <a href="<?php echo e(url('user/list')); ?>">
                    <button type="button" class="btn btn-sm btn-outline-danger">Lihat List User</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php elseif(Auth::user()->user_type === "instansi"): ?>
      <div class="card" style="width: 100%; background: #FFFFFF;">          
        <div class="card-body">          
          <div class="row">
            <div class="card text-white bg-secondary ml-4 mr-4 mb-2" style="width: 100%;">
              <div id="accordion">
                <div class="card-header" id="headingOne">
                  <i class="fas fa-database mr-2"></i> Tabel Statistik <?php echo e($nama_instansi_user); ?> &nbsp;
                  <!-- <i class="fas fa-angle-double-right ml-2"></i> -->
                  <button class="btn btn-success btn-sm text-white" mode="min" title="Show or hide" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <b><font class="txt-button" style="vertical-align: top;">Show / Hide</font></b>
                    <!-- <i class="fas fa-angle-double-down ml-2"></i> -->
                  </button>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="list-group">
                    <?php $__currentLoopData = $user_dss_toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <a href="https://dataku.salatiga.go.id/<?php echo e($value->url); ?>" target="blank_" class="list-group-item list-group-item-action list-group-item-info"><i class="fas fa-table mr-2"></i>  <?php echo e($value->name); ?>

                      <?php if($value->status === NULL): ?>
                        &nbsp <span class="badge badge-secondary">Empty</span>
                      <?php elseif($value->status === '1'): ?>
                        &nbsp <span class="badge badge-warning">Verifikasi</span>
                      <?php elseif($value->status === '2'): ?>
                        &nbsp <span class="badge badge-success">Publish</span>
                      <?php else: ?>
                        &nbsp <span class="badge badge-danger">Other</span>
                      <?php endif; ?>
                      </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  
  <?php if(!empty(Auth::user()->user_type) && Auth::user()->user_type == 'admin'): ?>
  <div class="d-none d-md-block">
    <div class="progress mt-2" style="height: 20px;">
      <div class="progress-bar dss-toc bg-success font-weight-bold" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100"></div>
      <div class="progress-bar dss-toc bg-warning font-weight-bold" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
      <div class="progress-bar dss-toc bg-secondary font-weight-bold" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div>
  <?php endif; ?>
  <div class="d-block d-md-none">
    <div class="progress mt-1">
      <div class="progress-bar dss-toc bg-success font-weight-bold" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="progress mt-1">
      <div class="progress-bar dss-toc bg-warning font-weight-bold" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="progress mt-1">
      <div class="progress-bar dss-toc bg-secondary font-weight-bold" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div>

  <form id="form-data-table" action="<?php echo e(url('dss/dss_2_1_store')); ?>" method="post" class="">
    <?php echo $__env->make('statistik_sektoral.partials.search_form', ['expand_form' => 'show'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </form>

  <!-- Modal -->
  <div class="modal fade" id="alert_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Info...</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="alert_editable_mode_text">
          Kami telah mengupdate javascript halaman ini. Mohon tekan CTRL-SHIFT-R untuk menampilkan list data.        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok baiklah</button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app_plugins', ['app_plugins' => ['jquery.treeview','bootstrap-notify','jquery.blockUI','select2','sheetjs',
                                                    'system/statistik_sektoral/index/']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.main_layout', ['breadcrumb' => ['Statistik Sektoral','Index ']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dataku\resources\views/statistik_sektoral/index.blade.php ENDPATH**/ ?>