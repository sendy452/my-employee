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
    <h5 class="card-title">List Penilaian Keahlian Per Tahun <?php echo e($tahun); ?></h5>
  
    <!-- Default Table -->
    <table>
        <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama Karyawan</th>
            <th scope="col">Email</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Penilaian Jabatan</th>
            <th scope="col">Penilaian Bulan</th>
            <th scope="col">Total Nilai</th>
        </tr>
        </thead>
        <tbody>        
        
        <?php $__currentLoopData = $keahlian_tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>          
            <th scope="row"><?php echo e($no+1); ?></th>
            <td><?php echo e($data->nip); ?></td>
            <td><?php echo e($data->nama); ?></td>
            <td><?php echo e($data->email); ?></td>
            <td><?php $__currentLoopData = $bio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($b->id_karyawan == $data->id_karyawan ? $b->nama_divisi.' - '.$b->bidang : ""); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
            <td><?php echo e($data->nama_divisi); ?> - <?php echo e($data->bidang); ?></td>
            <td><?php echo e($data->bulan); ?></td>
            <td><?php echo e($data->total); ?>%</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <!-- End Default Table Example -->
</body>
</html>

<?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/export-keahlian-tahun.blade.php ENDPATH**/ ?>