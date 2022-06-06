
<?php $__env->startSection('title', 'List Role'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Master Role</li>
          <li class="breadcrumb-item active">List Role</li>
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
              <h5 class="card-title">Tambah Role</h5>

              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(route('add.role')); ?>">
                <?php echo csrf_field(); ?>

                <div class="row mb-3">
                    <label for="inputIDRole" class="col-sm-2 col-form-label">ID Role</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="id_role">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNamaRole" class="col-sm-2 col-form-label">Nama Role</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="role">
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Role</button>
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
                <h5 class="card-title">List Data Karyawan</h5>
  
                <!-- Default Table -->
                <table class="table table-bordered dataTable" id="table">

                  <thead>
                    <tr>
                      <th scope="col">ID Role</th>
                      <th scope="col">Nama Role</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"><?php echo e($data->id_role); ?></th>
                      <td style="width: 80%"><?php echo e($data->role); ?></td>
                      <td><a href="<?php echo e(url('hapus-role').'/'.$data->id_role); ?>" class="btn btn-danger" type="button">Hapus Role</a></td>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/list-role.blade.php ENDPATH**/ ?>