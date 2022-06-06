
<?php $__env->startSection('title', 'Profile'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>

      <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $danger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <h6 class="alert alert-danger"><?php echo e($danger); ?></h6>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <?php if(session('message')): ?>
        <h6 class="alert alert-success"><?php echo e(session('message')); ?></h6>
      <?php endif; ?>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <?php $__currentLoopData = $profil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
              <img src="<?php echo e(asset('img/profile-img.jpg')); ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo e($data->nama); ?></h2>
              <h3><?php echo e($data->bidang); ?></h3>
              <h6><?php echo e($data->nama_divisi); ?></h6>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">
                
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->nama); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->email); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIK/KTP</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->nik); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIP</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->nip); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">No HP</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->nohp); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tempat Lahir</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->tlahir); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8"><?php echo e(date('d-m-Y', strtotime($data->tgllahir))); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->alamat); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Negara</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->negara); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->jekel); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Divisi</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->nama_divisi); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Bidang</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->bidang); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Role Akun</div>
                    <div class="col-lg-9 col-md-8"><?php echo e($data->role); ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" action="<?php echo e(route('profile.change')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PUT"); ?>

                    <div class="row mb-3">
                      <label for="Nama Lengkap" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama" type="text" class="form-control" value="<?php echo e($data->nama); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" value="<?php echo e($data->email); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Nik" class="col-md-4 col-lg-3 col-form-label">NIK/KTP</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nik" type="number" class="form-control" value="<?php echo e($data->nik); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Nip" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nip" type="text" class="form-control" value="<?php echo e($data->nip); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="No HP" class="col-md-4 col-lg-3 col-form-label">No HP</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nohp" type="number" class="form-control" value="<?php echo e($data->nohp); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Tempat Lahir" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tlahir" type="text" class="form-control" value="<?php echo e($data->tlahir); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Tgl Lahir" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tgllahir" type="date" class="form-control" value="<?php echo e($data->tgllahir); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="alamat" class="form-control" style="height: 100px"><?php echo e($data->alamat); ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Negara" class="col-md-4 col-lg-3 col-form-label">Negara</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="negara" type="text" class="form-control" value="<?php echo e($data->negara); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="jekel">
                            <option value="Laki-Laki" <?php echo e($data->jekel == "Laki-Laki" ? "selected" : ""); ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo e($data->jekel == "Perempuan" ? "selected" : ""); ?>>Perempuan</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Divisi</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" value="<?php echo e($data->nama_divisi); ?>" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Bidang</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" value="<?php echo e($data->bidang); ?>" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Role Akun</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" value="<?php echo e($data->role); ?>" disabled>
                      </div>
                    </div>
                      
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" action="<?php echo e(route('pass.change')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PUT"); ?>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/profil.blade.php ENDPATH**/ ?>