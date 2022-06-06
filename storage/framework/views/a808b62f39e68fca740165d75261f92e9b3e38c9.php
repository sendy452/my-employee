
<?php $__env->startSection('title', 'List Penilaian Keahlian'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Penilaian Keahlian</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Master Penilaian</li>
          <li class="breadcrumb-item active">List Penilaian Keahlian</li>
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
              <h5 class="card-title">Tambah Penilaian Keahlian</h5>

              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(route('add.keahlian')); ?>">
                <?php echo csrf_field(); ?>

                <div class="row mb-3">
                    <label for="inputKeahlian" class="col-sm-2 col-form-label">Nama Keahlian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="keahlian">
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-sm-2 col-form-label">Divisi Yang Membutuhkan</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="id_divisi">
                      <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($data->id_divisi); ?>"><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>     
                  </div>
                </div>
                <div class="row mb-3" style="flex-wrap: nowrap;">
                  <label for="inputBobot" class="col-sm-2 col-form-label">Bobot</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" name="bobot">
                        <span class="input-group-text"><i class="bi bi-percent"></i></span>
                    </div>
                  </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Keahlian</button>
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
              <h5 class="card-title">List Penilaian Keahlian Tiap Divisi</h5>

              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(url('list-keahlian')); ?>">
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
                <h5 class="card-title">List Penilaian Keahlian</h5>
  
                <!-- Default Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Keahlian</th>
                      <th scope="col">Divisi</th>
                      <th scope="col">Bobot (%)</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    <?php $__currentLoopData = $keahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>          
                      <form method="post" action="<?php echo e(route('change.keahlian')); ?>">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field("PUT"); ?>          
                      
                      <th scope="row"><input type="text" class="form-control" name="id_keahlian" value="<?php echo e($data->id_keahlian); ?>" hidden><?php echo e($no+1); ?></th>
                      <td><input type="text" class="form-control" name="keahlian" value="<?php echo e($data->keahlian); ?>"></td>
                      <td><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></td>
                      <td><input type="number" class="form-control" name="bobot" value="<?php echo e($data->bobot); ?>"></td>
                      <td><button type="submit" class="btn btn-success">Ubah</button> <a href="<?php echo e(url('hapus-keahlian').'/'.$data->id_keahlian); ?>" class="btn btn-danger" type="button">Hapus</a></td>
                      
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/list-keahlian.blade.php ENDPATH**/ ?>