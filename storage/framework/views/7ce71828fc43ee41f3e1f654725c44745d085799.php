
<?php $__env->startSection('title', 'Laporan Kinerja'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Per Tahun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Kinerja</li>
          <li class="breadcrumb-item active">Laporan Per Tahun</li>
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
              <h5 class="card-title">Laporan Kinerja Per Tahun</h5>
              
              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(url('laporan-penilaian-kinerja-tahun')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field("GET"); ?>

                <div class="row mb-3">
                    <label for="Nama" class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Karyawan-----</h1></option>
                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id_karyawan); ?>"><?php echo e($data->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Bulan" class="col-sm-2 col-form-label">Tahun Penilaian</label>
                    <div class="col-sm-10">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'  class="form-control" name="tahun">
                        <?php for($year = (int)date('Y'); 2000 <= $year; $year--): ?>
                            <option value="<?=$year;?>"><?=$year;?></option>
                        <?php endfor; ?>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
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
                        <h5 class="card-title">Grafik Penilaian Karyawan Per Tahun <?php echo e($tahun ?? ''); ?></h5>
            
                        <!-- Line Chart -->
                        <canvas id="lineChart" style="max-height: 400px;"></canvas>
                        <script>
                        const labels = <?php echo json_encode($labels); ?>;
                        const datas = <?php echo json_encode($datas); ?>;
                        console.log(datas);
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                label: 'Nilai Karyawan',
                                data: datas,
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                y: {
                                    beginAtZero: true
                                }
                                }
                            }
                            });
                        });
                        </script>
                        <!-- End Line CHart -->
            
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
                <h5 class="card-title">Penilaian Kinerja Karyawan Per Tahun <?php echo e($tahun ?? ''); ?><a href="<?php echo e(url('export-tahun-pdf/'.$tahun.'/'.$id_karyawan)); ?>" type="button" class="btn btn-danger float-end" <?php echo e($tahun == null ? "hidden" : ""); ?>>Cetak PDF</a></h5>
  
                <div class="table-responsive">
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
                      <th scope="col">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    <?php $__currentLoopData = $kinerja_tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>          
                      <th scope="row"><input type="text" class="form-control" name="id_keahlian" value="<?php echo e($data->id_keahlian); ?>" hidden><?php echo e($no+1); ?></th>
                      <td><?php echo e($data->nip); ?></td>
                      <td><?php echo e($data->nama); ?></td>
                      <td><?php echo e($data->email); ?></td>
                      <td><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></td>
                      <td><?php echo e($data->bulan); ?></td>
                      <td><?php echo e($data->total); ?>/100</td>
                      <td><?php if($data->total >= 1 && $data->total <= 25): ?> Buruk <?php elseif($data->total >= 26 && $data->total <= 50): ?> Sedang <?php elseif($data->total >= 51 && $data->total <= 75): ?> Baik <?php elseif($data->total >= 76 && $data->total <= 100): ?> Sangat Baik <?php endif; ?></td>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/laporan-kinerja-tahun.blade.php ENDPATH**/ ?>