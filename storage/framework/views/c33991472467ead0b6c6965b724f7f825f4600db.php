
<?php $__env->startSection('title', 'De/Aktivasi Karyawan'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>De/Aktivasi Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Data Karyawan</li>
          <li class="breadcrumb-item active">De/Aktivasi Karyawan</li>
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

        </div>
      </div>
    </section>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Data Karyawan</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">NIP</th>
                      <th scope="col">Email</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Divisi</th>
                      <th scope="col">Bidang</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aktivasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td hidden><?php echo e($data->id_karyawan); ?></td>
                      <th scope="row"><?php echo e($data->nip); ?></th>
                      <td><?php echo e($data->email); ?></td>
                      <td><?php echo e($data->nama); ?></td>
                      <td><?php echo e($data->nama_divisi); ?></td>
                      <td><?php echo e($data->bidang); ?></td>
                      <td><?php echo e($data->is_active == 1 ? 'Aktif' : 'Tidak Aktif'); ?></td>
                      <td><a style="width:110px" href="<?php echo e($data->is_active == 1 ? url('deactivate-user').'/'.$data->id_karyawan : url('activate-user').'/'.$data->id_karyawan); ?>" class="btn <?php echo e($data->is_active == 1 ? 'btn-danger' : 'btn-success'); ?>" type="button"><?php echo e($data->is_active == 1 ? 'Deaktivasi' : 'Aktivasi'); ?></a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
                <!-- End Default Table Example -->
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

  </main>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/deactivate-karyawan.blade.php ENDPATH**/ ?>