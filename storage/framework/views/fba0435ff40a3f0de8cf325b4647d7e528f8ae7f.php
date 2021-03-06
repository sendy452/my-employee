
<?php $__env->startSection('title', 'List Divisi'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Data Divisi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Master Divisi</li>
          <li class="breadcrumb-item active">List Data Divisi</li>
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
              <h5 class="card-title">Tambah Divisi</h5>

              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(route('add.divisi')); ?>">
                <?php echo csrf_field(); ?>

                <div class="row mb-3">
                    <label for="inputDivisi" class="col-sm-2 col-form-label">Nama Divisi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_divisi">
                    </div>
                </div>
                <div class="row mb-3" style="flex-wrap: nowrap;">
                  <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bidang">
                  </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Divisi</button>
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
                <h5 class="card-title">List Data Divisi</h5>
  
                <!-- Default Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Divisi</th>
                      <th scope="col">Bidang</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>          
                      <form method="post" action="<?php echo e(route('change.divisi')); ?>">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field("PUT"); ?>          
                      
                      <th scope="row"><input type="text" class="form-control" name="id_divisi" value="<?php echo e($data->id_divisi); ?>" hidden><?php echo e($no+1); ?></th>
                      <td><input type="text" class="form-control" name="nama_divisi" value="<?php echo e($data->nama_divisi); ?>"></td>
                      <td><input type="text" class="form-control" name="bidang" value="<?php echo e($data->bidang); ?>"></td>
                      <td><button type="submit" class="btn btn-success">Ubah</button> <a href="<?php echo e(url('hapus-divisi').'/'.$data->id_divisi); ?>" class="btn btn-danger" type="button">Hapus</a></td>
                      
                      </form>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\scoring\resources\views/list-divisi.blade.php ENDPATH**/ ?>