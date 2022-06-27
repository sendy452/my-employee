
<?php $__env->startSection('title', 'Laporan Keahlian'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Keahlian Per Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Keahlian</li>
          <li class="breadcrumb-item active">Laporan Keahlian Per Karyawan</li>
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
              <h5 class="card-title">Pilih Data Karyawan</h5>

              <!-- General Form Elements -->
              <form method="post" action="<?php echo e(url('laporan-penilaian-keahlian')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field("GET"); ?>

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Nama Karyawan</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Karyawan-----</h1></option>
                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id_karyawan); ?>"><?php echo e($data->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-md-4 col-lg-3 col-form-label">Pilih Divisi Tujuan</label>
                  <div class="col-md-8 col-lg-9">
                  <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="id_divisi">
                      <?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($data->id_divisi); ?>"><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>     
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Bulan Penilaian</label>
                    <div class="col-md-8 col-lg-9">
                        <input type="month" class="form-control" name="bulan" max="<?php echo e(date('Y-m')); ?>">
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Pilih Penilaian</button>
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
                  <h5 class="card-title">Form Penilaian Keahlian Karyawan</h5>

                  <div class="table-responsive">
                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <tbody>               
                      <?php $__currentLoopData = $bio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <th colspan="5">Periode Penilaian</th>
                        <th colspan="2">Nilai</th>
                        <th colspan="2">Penilaian/Daftar Nilai</th>
                      </tr>

                      <tr>   
                        <th colspan="2">Nama Karyawan</th>
                        <td colspan="3"><?php echo e($bio->nama); ?></td>
                        <th>Nilai Bulan Lalu</th>
                        <td><?php $__currentLoopData = $totalkeahlianakhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($tk->total); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>%</td>
                        <td>Sangat Baik</td>
                        <td>76 - 100%</td>
                      </tr>

                      <tr>
                        <th colspan="2">Bagian-NIP</th>
                        <td colspan="2"><?php echo e($bio->bidang); ?></td>
                        <td><?php echo e($bio->nip); ?></td>
                        <th>Nilai Sekarang</th>
                        <?php $__currentLoopData = $totalkeahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($tk->total); ?>%</td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <td>Baik</td>
                        <td>51 - 75%</td>
                      </tr>

                      <tr>
                        <th colspan="2">Tanggal Mulai Kerja</th>
                        <td colspan="3"><?php echo e(date('d-m-Y',strtotime($bio->created_at))); ?></td>
                        <th>Penilaian Divisi</th>
                        <td><?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($dv->id_divisi == $id_dv ? $dv->nama_divisi : ""); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                        <td>Sedang</td>
                        <td>26 - 50%</td>
                      </tr>

                      <tr>
                        <th colspan="2">ID Form-Penilaian Bulan</th>
                        <td colspan="1">FPKH/<?php echo e($bulan); ?>/<?php echo e($bio->id_karyawan); ?></td>
                        <td colspan="2"><?php echo e(date('F-Y',strtotime($bulan))); ?></td>
                        <th>Penilaian Bidang</th>
                        <td><?php $__currentLoopData = $divisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($dv->id_divisi == $id_dv ? $dv->bidang : ""); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                        <td>Buruk</td>
                        <td>0 - 25%</td>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">Faktor Kompetensi</th>
                        <th>Bobot</th>
                        <th colspan="2">Nilai (%)</th>
                        <th>Bobot x Nilai (%)</th>
                      </tr>

                      <?php $no = 0;?>
                      <?php $total_bobot = 0;?>
                      <?php $__currentLoopData = $penilaiankeahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td colspan="5"><?php echo e($data->keahlian); ?></td>
                          <td><?php echo e($data->bobot); ?>%</td>
                          <td colspan="2"><?php echo e($data->nilai); ?></td>
                          <td><?php echo e($data->bobot_nilai); ?></td>
                      </tr>
                      <?php $total_bobot += $data->bobot ?>
                      <?php $no++;?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <tr>
                        <th colspan="5">Total</td>                    
                        <th><?php echo e($total_bobot); ?>%</td>
                        <th colspan="2">Saran Jabatan : </br><?php echo e($jabatan->nama_divisi.'-'.$jabatan->bidang ?? '-'); ?></th>
                        <?php $__currentLoopData = $totalkeahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($tk->total); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tr>

                      <tr><td colspan="9"></td></tr>
                      <tr><td colspan="9">Lembar Pengesahan</td></tr>

                      <tr>
                        <th colspan="3">Karyawan yang di nilai</th>
                        <th colspan="2">Atasan langsung</th>
                        <th colspan="2">Kepala HRD</th>
                        <th colspan="2">Direktur</th>
                      </tr>

                      <tr>
                        <td colspan="3"><?php echo e($bio->nama); ?></td>
                        <?php $__currentLoopData = $totalkeahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td colspan="2"><?php echo e($tk->atasan); ?></td>
                        <td colspan="2"><?php echo e($tk->hrd); ?></td>
                        <td colspan="2"><?php echo e($tk->direktur); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tr>

                      <tr><td colspan="9"></td></tr>
                    
                      <tr>
                          <td colspan="9">
                            <div class="row mb-3 text-end">
                                <div class="col-sm-12">
                                    <a href="<?php echo e(url('export-keahlian-excel/'.date('F-Y',strtotime($bulan)).'/'.$bio->id_karyawan.'/'.$id_dv)); ?>" type="button" class="btn btn-success" <?php echo e($bio->nama == null ? "hidden" : ""); ?>>Cetak Excel</a>
                                    <a href="<?php echo e(url('export-keahlian-pdf/'.date('F-Y',strtotime($bulan)).'/'.$bio->id_karyawan.'/'.$id_dv)); ?>" type="button" class="btn btn-danger" <?php echo e($bio->nama == null ? "hidden" : ""); ?>>Cetak PDF</a>
                                </div>
                            </div>
                          </td>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/laporan-keahlian-karyawan.blade.php ENDPATH**/ ?>