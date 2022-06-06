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
           
    <h5 class="card-title">Form Penilaian Kinerja Karyawan</h5>

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
            <td><?php $__currentLoopData = $totalkinerjaakhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($tk->total); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
            <td>Sangat Baik</td>
            <td>4</td>
            </tr>

            <tr>
            <th colspan="2">Bagian-NIP</th>
            <td colspan="2"><?php echo e($bio->bidang); ?></td>
            <td><?php echo e($bio->nip); ?></td>
            <th>Nilai Sekarang</th>
            <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($tk->total); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td>Baik</td>
            <td>3</td>
            </tr>

            <tr>
            <th colspan="2">Tanggal Mulai Kerja</th>
            <td colspan="3"><?php echo e(date('d-m-Y',strtotime($bio->created_at))); ?></td>
            <th></th>
            <td></td>
            <td>Sedang</td>
            <td>2</td>
            </tr>

            <tr>
            <th colspan="2">ID Form-Penilaian Bulan</th>
            <td colspan="1">FPKR/<?php echo e($bulan); ?>/<?php echo e($bio->id_karyawan); ?></td>
            <td colspan="2"><?php echo e(date('F-Y',strtotime($bulan))); ?></td>
            <th></th>
            <td></td>
            <td>Buruk</td>
            <td>1</td>
            </tr>

            <tr><td colspan="9"></td></tr>

            <tr>
            <td colspan="5">Faktor Kompetensi</td>
            <th>Bobot</th>
            <th>Nilai</th>
            <th>Target</th>
            <th>Bobot x Nilai</th>
            </tr>

            <tr>
            <th colspan="5">1. <?php echo e($kategori[0]->kategori); ?></th>
            <td><?php echo e($kategori[0]->bobot); ?>%</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            
            <?php $no = 0;?>
            <?php $total_bobot1 = 0;?>
            <?php $__currentLoopData = $kinerja0; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="5"><?php echo e($data->kinerja); ?></td>
                <td><?php echo e($data->bobot); ?>%</td>
                <td><?php echo e($data->nilai ?? "0"); ?></td>
                <td><?php echo e($data->target); ?>.00</td>
                <td><?php echo e($data->bobot_nilai ?? "0"); ?></td>
            </tr>
            <?php $total_bobot1 += $data->bobot;?>
            <?php $no++;?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr>
            <td colspan="5">Total</td>
            <td><?php echo e($total_bobot1); ?>%</td>
            <td colspan="2"></td>
            <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($tk->sub_total1); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

            <tr><td colspan="9"></td></tr>

            <tr>
            <th colspan="5">2. <?php echo e($kategori[1]->kategori); ?></th>
            <td><?php echo e($kategori[1]->bobot); ?>%</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>

            <?php $no = $hitung;?>
            <?php $total_bobot2 = 0;?>
            <?php $__currentLoopData = $kinerja1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="5"><?php echo e($data->kinerja); ?></td>
                <td><?php echo e($data->bobot); ?>%</td>
                <td><?php echo e($data->nilai ?? "0"); ?></td>
                <td><?php echo e($data->target); ?>.00</td>
                <td><?php echo e($data->bobot_nilai ?? "0"); ?></td>
            </tr>
            <?php $total_bobot2 += $data->bobot;?>
            <?php $no++;?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr>
            <td colspan="5">Total</td>
            <td><?php echo e($total_bobot2); ?>%</td>
            <td colspan="2"></td>
            <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($tk->sub_total2); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

            <tr><td colspan="9"></td></tr>

            <tr>
            <th colspan="5">3. <?php echo e($kategori[2]->kategori); ?></th>
            <td><?php echo e($kategori[2]->bobot); ?>%</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>

            <?php $no = $hitung + $hitung2;?>
            <?php $total_bobot3 = 0;?>
            <?php $__currentLoopData = $kinerja2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
            <td colspan="5"><?php echo e($data->kinerja); ?></td>
            <td><?php echo e($data->bobot); ?>%</td>
            <td><?php echo e($data->nilai ?? "0"); ?></td>
            <td><?php echo e($data->target); ?>.00</td>
            <td><?php echo e($data->bobot_nilai ?? "0"); ?></td>
            </tr>
            <?php $total_bobot3 += $data->bobot;?>
            <?php $no++;?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr>
            <td colspan="5">Total</td>
            <td><?php echo e($total_bobot3); ?>%</td>
            <td colspan="2"></td>
            <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($tk->sub_total3); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

            <tr><td colspan="9"></td></tr>

            <tr>
            <th colspan="5">Total Score</th>
            <th><?php echo e($kategori[0]->bobot+$kategori[1]->bobot+$kategori[2]->bobot); ?>%</th>
            <th colspan="2">4.00</th>
            <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

<?php /**PATH D:\Apk\laragon\www\scoring\resources\views/export-kinerja-karyawan.blade.php ENDPATH**/ ?>