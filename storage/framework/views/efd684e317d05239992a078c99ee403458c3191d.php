<div class="card mb-2 mt-3">
  
  <div class="card-header text-success text-center" style="background-color: #e6f7ff; font-weight: bold;">
    
    <div class="px-12">
      <marquee direction="right">
        <img src="<?php echo e(asset('images/bedug-gif.gif')); ?>" style="height:40px;margin-left:0.5rem;margin-right:0.5rem;"> 
        Rilis data Statistik Sektoral dilaksanakan pada tanggal 31 Januari dan 31 Juli
        <img src="<?php echo e(asset('images/bedug-gif.gif')); ?>" style="height:40px;margin-left:0.5rem;margin-right:0.5rem;">
        Selamat menjalankan ibadah puasa...
        <img src="<?php echo e(asset('images/bedug-gif.gif')); ?>" style="height:40px;margin-left:0.5rem;margin-right:0.5rem;">
      </marquee>
      <!-- Bagian grafik tren tahunan -->
      <div id="grafik"></div>
      <!-- <div>
          <small class="blockquote-footer">Beberapa halaman mungkin tidak dapat menampilkan grafik karena <cite title="Source Title">struktur tabel tidak mendukung</cite></small>
      </div> -->
      <div><span class="badge badge-link" id="badge_tahun_usul">Data diusulkan OPD dan ditambahkan tahun : <text id="tahun_usul"></text></span></div>
    </div>    
    
  </div>
  <div class="card-body">
    
    <div class="row">
      <div class="col-md-4">
        <input type="text" id="dss-keyword" class="form-control" name="" id="" value="" placeholder="Ketik kata kunci pencarian....">
      </div>
      <div class="col-md-3 col-lg-4">
          <select id="instansi" name="instansi" class="form-control input-sm">
            <option value="">-- Semua Instansi --</option>
            <?php $__currentLoopData = $instansi_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instansi_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($instansi_list->alias); ?>"><?php echo e($instansi_list->instansi); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
      </div>
      <div class="col-lg-2 col-md-2 col-sm">
        <?php
          $arr_year = array_combine(range(date("Y"),2018), range(date("Y"),2018));

          foreach ($arr_year as $key => $value) {
            $key_1  = $key.'_1';
            $new_arr_year[$key_1] = $value.' (Semester I)';
            $new_arr_year[$key] = $value;
          }
        ?>

        <select class="form-control" name="year" id="year">
          <?php $__currentLoopData = $new_arr_year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php echo ((string) session('dss_toc_year') == (string) $key) ? 'selected="selected"' : ' '; ?> value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <option <?php echo ((string) session('dss_toc_year') == '2017') ? 'selected="selected"' : ' '; ?> value="2017">2017</option>
        </select>

      </div>


      <!-- <div class="col-md-4">
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="#">HTML</a></li>
            <li><a tabindex="-1" href="#">CSS</a></li>
            <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                <li class="dropdown-submenu">
                  <a class="test" href="#">Another dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">3rd level dropdown</a></li>
                    <li><a href="#">3rd level dropdown</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div> -->

      <div class="col-lg-2 col-md-2 col-sm">
        <div class="btn btn-primary mouse-pointer" data-toggle="collapse" data-target="#search-body" aria-expanded="true" aria-controls="search-body">
          Table of Contents
        </div>
      </div>
    </div>

    

    <div id="search-body" class="collapse <?php echo e(@$expand_form); ?>">
      <div id="sidetree">
        <div class="treeheader">&nbsp;</div>
        <div id="sidetreecontrol">
          <a href="#" style="display:none;">Collapse All |</a>
          <a href="#" style="display:none;">Expand All |</a>
          <a title="Toggle the tree below, opening closed branches, closing open branches" href="#"><span class="btn btn-primary">Toggle All</span></a>
          <span id="btn-current-list" class="btn btn-primary">Current List</span>
        </div>
        <br />
        <div id=''>
          <ul id="tree">
            <?php $__currentLoopData = $dss_toc_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bab => $bab_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a title="" href="#"><?php echo e($bab); ?></a>
                <ul bab="<?php echo e($bab); ?>">
                  
                </ul>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <ul id="bab_1" class="treeview-famfamfam" style="background-color: #000000;">
        </ul>
      </div>
    </div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\dataku\resources\views/statistik_sektoral/partials/search_form.blade.php ENDPATH**/ ?>