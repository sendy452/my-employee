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
      font-size:12px;
    }
  </style>
    
</head>

<body>
           
    <h5 class="card-title">Laporan Penilaian Kinerja Per Tahun <?php echo e($tahun); ?></h5>

    <!-- Default Table -->
    <table class="table">
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
        <th scope="row"><?php echo e($no+1); ?></th>
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
           
</body>
</html>

<?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/export-kinerja-tahun.blade.php ENDPATH**/ ?>