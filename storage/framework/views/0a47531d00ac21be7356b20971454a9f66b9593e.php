
<?php $__env->startSection('title', 'Ubah Role User'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ubah Role User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Master Role</li>
          <li class="breadcrumb-item active">Ubah Role User</li>
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
              <h5 class="card-title">Cari Data User</h5>

              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(url('ubah-role-user')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field("GET"); ?>

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Email User</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>Pilih Email!</h1></option>
                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id_karyawan); ?>"><?php echo e($data->email); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Pilih Akun</button>
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
                  <h5 class="card-title">Ubah Data User</h5>
    
                  <!-- Ubah Data Karyawan Form -->
                  <form class="row g-3" method="post" action="<?php echo e(route('change.role')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PUT"); ?>

                    <?php $__currentLoopData = $bio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                      <label for="inputName" class="form-label">Nama Lengkap</label>
                      <input name="id_karyawan" type="text" class="form-control" value="<?php echo e($data->id_karyawan); ?>" hidden>
                      <input name="nama" type="text" class="form-control" value="<?php echo e($data->nama); ?>" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputNIK" class="form-label">NIK/KTP</label>
                      <input name="nik" type="number" class="form-control" value="<?php echo e($data->nik); ?>" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputNIP" class="form-label">NIP</label>
                      <input name="nip" type="text" class="form-control" value="<?php echo e($data->nip); ?>" disabled>
                    </div>
                    <div class="col-12">
                      <label for="inputEmail" class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" value="<?php echo e($data->email); ?>" disabled>
                    </div>
                    <div class="col-12">
                      <label for="inputNoHP" class="form-label">No HP</label>
                      <input name="nohp" type="number" class="form-control" value="<?php echo e($data->nohp); ?>" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputTLahir" class="form-label">Tempat Lahir</label>
                      <input name="tlahir" type="text" class="form-control" value="<?php echo e($data->tlahir); ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="inputTglLahir" class="form-label">Tanggal Lahir</label>
                        <input name="tgllahir" type="date" class="form-control" value="<?php echo e($data->tgllahir); ?>" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputAlamat" class="form-label">Alamat</label>                    
                      <textarea name="alamat" class="form-control" disabled><?php echo e($data->alamat); ?></textarea>                      
                    </div>
                    <div class="col-md-6">
                      <label for="inputNegara" class="form-label">Negara</label>
                      <input name="negara" type="text" class="form-control" value="<?php echo e($data->negara); ?>" disabled>
                    </div>
                    <div class="col-md-2">
                        <label for="Jenis Kelamin" class="form-label">Jenis Kelamin</label>                        
                        <select class="form-select" name="jekel" disabled>
                            <option value="Laki-Laki" <?php echo e($data->jekel == "Laki-Laki" ? "selected" : ""); ?> >Laki-Laki</option>
                            <option value="Perempuan" <?php echo e($data->jekel == "Perempuan" ? "selected" : ""); ?>>Perempuan</option>
                        </select>                       
                    </div>
                    <div class="col-md-8">
                      <label for="inputtDivisi" class="form-label">Divisi</label>
                      <select class="form-select" name="id_divisi" disabled>
                          <option></option>
                          <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($divisi->id_divisi); ?>" <?php echo e($divisi->id_divisi == $data->id_divisi ? "selected" : ""); ?>><?php echo e($divisi->nama_divisi); ?> - <?php echo e($divisi->bidang); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>     
                    </div>
                    <div class="col-md-2">
                      <label for="inputRole" class="form-label">Role Akun</label>
                      <select class="form-select" name="id_role">
                          <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($role->id_role); ?>" <?php echo e($role->id_role == $data->id_role ? "selected" : ""); ?>><?php echo e($role->role); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </form>
                  <!-- End Ubah Data Karyawan Form -->
    
                </div>
            </div>

          </div>
        </div>
      </section>

  </main>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/ubah-role-user.blade.php ENDPATH**/ ?>