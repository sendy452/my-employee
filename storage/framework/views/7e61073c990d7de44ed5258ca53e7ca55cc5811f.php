<html lang="en">

<head>
  <!-- Template Main CSS File -->
  <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

  <style>
    table, td, th {
      padding: 0px 10px 0px 10px;
      border: 1px solid;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      font-family: 'arial';
      font-size:15px;
    }
  </style>
    
</head>

<body>
    <h5 class="card-title">Form Penilaian Keahlian Karyawan</h5>

    <!-- Default Table -->
    <table>
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
            <th colspan="2">Bobot</th>
            <th >Nilai (%)</th>
            <th>Bobot x Nilai (%)</th>
          </tr>

          <?php $no = 0;?>
          <?php $total_bobot = 0;?>
          <?php $__currentLoopData = $penilaiankeahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
              <td colspan="5"><?php echo e($data->keahlian); ?></td>
              <td colspan="2"><?php echo e($data->bobot); ?>%</td>
              <td><?php echo e($data->nilai); ?></td>
              <td><?php echo e($data->bobot_nilai); ?></td>
          </tr>
          <?php $total_bobot += $data->bobot ?>
          <?php $no++;?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <tr>
            <th colspan="5">Total</th>                    
            <th colspan="2"><?php echo e($total_bobot); ?>%</th>
            <td></td>
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
            <td colspan="3">ttd, <br><br><br><center><?php echo e($bio->nama); ?></center></td>
            <?php $__currentLoopData = $totalkeahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td colspan="2">ttd, <br><br><br><center><?php echo e($tk->atasan); ?></center></td>
            <td colspan="2">ttd, <br><br><br><center><?php echo e($tk->hrd); ?></center></td>
            <td colspan="2">ttd, <br><br><br><center><?php echo e($tk->direktur); ?></center></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tr>

          <tr><td colspan="9"></td></tr>
        
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        </tbody>
    </table>
    <!-- End Default Table Example -->
</body>
</html>

<?php /**PATH D:\Apk\laragon\www\scoring\resources\views/export-keahlian-karyawan.blade.php ENDPATH**/ ?>