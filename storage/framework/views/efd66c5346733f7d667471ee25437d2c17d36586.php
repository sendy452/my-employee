
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Terbaik Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Karyawan Terbaik <?php echo e(date('F', strtotime('last month'))); ?></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-hand-thumbs-up"></i>
                  </div>
                  <div class="ps-2">
                    <h6><?php echo e($terbaik->nama ?? null); ?></h6>
                    <span class="text-muted small pt-2 ps-1">Dari</span> <span class="text-primary small pt-1 fw-bold"><?php echo e($c_karyawan); ?> Karyawan</span>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Terbaik Card -->

          <!-- Kinerja Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Penilaian Kinerja</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-clipboard-check"></i>
                  </div>
                  <div class="ps-2">
                    <h6><?php echo e($terbaik->total ?? null); ?></h6>
                    <span class="text-muted small pt-2 ps-1">Penilaian Terendah</span> <span class="text-success small pt-1 fw-bold"><?php echo e($terendah->total ?? null); ?></span>

                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Kinerja Card -->

          <!-- Keahlian Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Penilaian Keahlian</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-award"></i>
                  </div>
                  <div class="ps-2">
                    <h6><?php echo e($keahlian->keahlian); ?></h6>
                    <span class="text-muted small pt-2 ps-1">Dengan nilai</span> <span class="text-danger small pt-1 fw-bold"><?php echo e($keahlian->nilai); ?>%</span>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- End Keahlian Card -->

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Karyawan Tiap Bulan <?php echo e(date('Y')); ?></h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                  const labels = <?php echo json_encode($labels); ?>;
                  const datas = <?php echo json_encode($datas); ?>;
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#lineChart'), {
                      type: 'line',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Total Karyawan',
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

          <!-- Recent Karyawan -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Karyawan Terakhir Ditambahkan</h5>
                <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">NIP</th>
                      <th scope="col">Email</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Divisi</th>
                      <th scope="col">Bidang</th>
                      <th scope="col">Tanggal Kerja</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"><?php echo e($data->nip); ?></th>
                      <td><?php echo e($data->email); ?></td>
                      <td><?php echo e($data->nama); ?></td>
                      <td><?php echo e($data->nama_divisi); ?></td>
                      <td><?php echo e($data->bidang); ?></td>
                      <td><?php echo e(date('d-m-Y', strtotime($data->dibuat))); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
                </div>
              </div>

            </div>
          </div>
          <!-- End Recent Karyawan -->

        </div>
      </div>
      <!-- End Columns -->
    </div>
  </section>

</main>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/home.blade.php ENDPATH**/ ?>