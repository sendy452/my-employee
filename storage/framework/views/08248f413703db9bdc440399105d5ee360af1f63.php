
<?php $__env->startSection('title', 'Laporan Kinerja'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Kinerja Per Divisi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Kinerja</li>
          <li class="breadcrumb-item active">Laporan Kinerja Per Divisi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $danger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <h6 class="alert alert-danger"><?php echo e($danger); ?></h6>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    <?php if(session('message')): ?>
        <h6 class="alert alert-success"><?php echo e(session('message')); ?></h6>
    <?php endif; ?>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List Penilaian Kinerja Tiap Divisi</h5>
              
              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(url('laporan-penilaian-kinerja-divisi')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field("GET"); ?>

                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-sm-2 col-form-label">Pilih Divisi</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="id_divisi">
                      <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($data->id_divisi); ?>"><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>     
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="Bulan" class="col-sm-2 col-form-label">Bulan Penilaian</label>
                    <div class="col-sm-10">
                        <input type="month" class="form-control" name="bulan" max="<?php echo e(date('Y-m')); ?>">
                    </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tampilkan Keahlian</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Penilaian Kinerja Per Divisi <a href="<?php echo e(url('export-divisi-pdf/'.date('F-Y',strtotime($bulan)).'/'.$id_divisi)); ?>" type="button" class="btn btn-danger float-end" <?php echo e($bulan == null ? "hidden" : ""); ?>>Cetak PDF</a></h5>
  
                <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama Karyawan</th>
                      <th scope="col">Email</th>
                      <th scope="col">Divisi</th>
                      <th scope="col">Penilaian Bulan</th>
                      <th scope="col">Total Nilai</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    <?php $__currentLoopData = $kinerja_divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>          
                      <th scope="row"><input type="text" class="form-control" name="id_keahlian" value="<?php echo e($data->id_keahlian); ?>" hidden><?php echo e($no+1); ?></th>
                      <td><?php echo e($data->nip); ?></td>
                      <td><?php echo e($data->nama); ?></td>
                      <td><?php echo e($data->email); ?></td>
                      <td><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></td>
                      <td><?php echo e($data->bulan); ?></td>
                      <td><?php echo e($data->total); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
                <!-- End Default Table Example -->
              </div>
            </div>

          </div>
        </div>
      </section>

  </main>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/laporan-kinerja-divisi.blade.php ENDPATH**/ ?>