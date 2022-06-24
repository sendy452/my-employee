
<?php $__env->startSection('title', 'List Penilaian Kinerja'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Penilaian Kinerja</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Master Penilaian</li>
          <li class="breadcrumb-item active">List Penilaian Kinerja</li>
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

    <!--section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Kategori Penilaian Kinerja</h5>

              <form method="post" action="<?php echo e(route('add.kategori')); ?>">
                <?php echo csrf_field(); ?>

                <div class="row mb-3">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kategori">
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
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>
    </section-->
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Kategori Penilaian Kinerja</h5>
  
                <div class="table-responsive">
                <!-- Default Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Kategori Penilaian</th>
                      <th scope="col">Bobot (%)</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>          
                      <form method="post" action="<?php echo e(route('change.kategori')); ?>">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field("PUT"); ?>          
                      
                      <th scope="row"><input type="text" class="form-control" name="id_kategori" value="<?php echo e($data->id_kategori); ?>" hidden><?php echo e($no+1); ?></th>
                      <td><input style="width: auto;" type="text" class="form-control" name="kategori" value="<?php echo e($data->kategori); ?>"></td>
                      <td><input type="number" class="form-control" name="bobot" value="<?php echo e($data->bobot); ?>"></td>
                      <td><button type="submit" class="btn btn-success">Ubah</button> <!--a href="<?php echo e(url('hapus-kategori').'/'.$data->id_kategori); ?>" class="btn btn-danger" type="button">Hapus</a--></td>
                      
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
        </div>
      </section>

      <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tambah Penilaian Kinerja</h5>
  
                <!-- General Form Elements -->
                <form method="post" action="<?php echo e(route('add.kinerja')); ?>">
                  <?php echo csrf_field(); ?>
  
                  <div class="row mb-3">
                      <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kinerja</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="kinerja">
                      </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputtKategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                    <select class="form-select" name="id_kategori">
                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($data->id_kategori); ?>"><?php echo e($data->kategori); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>     
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputtDivisi" class="col-sm-2 col-form-label">Penilaian Jabatan</label>
                    <div class="col-sm-10">
                    <select class="form-select" name="id_divisi">
                        <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($data->id_divisi); ?>"><?php echo e($data->nama_divisi.' - '.$data->bidang); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>     
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputBobot" class="col-sm-2 col-form-label">Bobot</label>
                    <div class="col-sm-10">
                      <div class="input-group">
                          <input type="number" class="form-control" name="bobot" min="0" max="100">
                          <span class="input-group-text"><i class="bi bi-percent"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Target</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="target" placeholder="100" min="1" max="100">
                    </div>
                </div>
                  
                  <div class="row mb-3 text-end">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary">Tambah Kinerja</button>
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
                <h5 class="card-title">List Penilaian Kinerja Tiap Jabatan</h5>
  
                <!-- General Form Elements -->
                <form method="post" action="<?php echo e(url('list-kinerja')); ?>">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field("GET"); ?>
  
                  <div class="row mb-3">
                    <label for="inputtDivisi" class="col-sm-2 col-form-label">Pilih Jabatan</label>
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
                      <button type="submit" class="btn btn-primary">Tampilkan Kinerja</button>
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
                  <h5 class="card-title">List Penilaian Kinerja</h5>
    
                  <div class="table-responsive">
                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Penilaian Kinerja</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penilaian Jabatan</th>
                        <th scope="col">Bobot (%)</th>
                        <th scope="col">Target</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>               
                      
                      <?php $__currentLoopData = $kinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $kinerja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>   
                        <form method="post" action="<?php echo e(route('change.kinerja')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field("PUT"); ?>     

                        <th scope="row"><input type="text" class="form-control" name="id_kinerja" value="<?php echo e($kinerja->id_kinerja); ?>" hidden><?php echo e($no+1); ?></th>
                        <td><input type="text" style="width: auto;" class="form-control" name="kinerja" value="<?php echo e($kinerja->kinerja); ?>"></td>
                        <td>
                            <select style="width: auto;" class="form-select" name="id_kategori">
                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($data->id_kategori); ?>" <?php echo e($data->id_kategori == $kinerja->id_kategori ? "selected" : ""); ?>><?php echo e($data->kategori); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>  
                        </td>
                        <td><?php echo e($kinerja->nama_divisi.' - '.$kinerja->bidang); ?></td>
                        <td><input type="number" class="form-control" name="bobot" value="<?php echo e($kinerja->bobot); ?>"></td>
                        <td><input type="number" class="form-control" name="target" value="<?php echo e($kinerja->target); ?>"></td>
                        <td><button type="submit" class="btn btn-success">Ubah</button> <a href="<?php echo e(url('hapus-kinerja').'/'.$kinerja->id_kinerja); ?>" class="btn btn-danger" type="button">Hapus</a></td>
                        
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
          </div>
        </section>

  </main>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/list-kinerja.blade.php ENDPATH**/ ?>