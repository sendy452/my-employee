
<?php $__env->startSection('title', 'Manajemen Penilaian'); ?>
<?php $__env->startSection('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Penilaian Kinerja</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item">Manajemen Penilaian</li>
          <li class="breadcrumb-item active">Edit Penilaian Kinerja</li>
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
              <form method="post" action="<?php echo e(url('edit-penilaian-kinerja')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field("GET"); ?>

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Email Karyawan</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Email!-----</h1></option>
                            <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id_karyawan); ?>"><?php echo e($data->email); ?></option>
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
                  <h5 class="card-title">Edit Form Penilaian Kinerja</h5>

                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <tbody>               
                    <form method="post" action="<?php echo e(route('change.penilaian.kinerja')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PUT"); ?>
                           
                      <?php $__currentLoopData = $bio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <th colspan="5"><input type="text" class="form-control" name="id_karyawan" value="<?php echo e($bio->id_karyawan); ?>" hidden>Periode Penilaian</th>
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
                        <td><input type="number" value="<?php echo e($tk->total); ?>" step="0.01" id="total_score" disabled/></td>
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
                        <td colspan="1"><input type="text" name="id_form" value="FPKR/<?php echo e($bulan); ?>/<?php echo e($bio->id_karyawan); ?>" hidden>FPKR/<?php echo e($bulan); ?>/<?php echo e($bio->id_karyawan); ?></td>
                        <td colspan="2"><input type="text" name="bulan" value="<?php echo e(date('F-Y',strtotime($bulan))); ?>" hidden><?php echo e(date('F-Y',strtotime($bulan))); ?></td>
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
                        <td><input type="number" id="kategori1" value="<?php echo e($kategori[0]->bobot); ?>" hidden/><?php echo e($kategori[0]->bobot); ?>%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <?php $no = 0;?>
                      <?php $total_bobot1 = 0;?>
                      
                      <?php $__currentLoopData = $kinerja0; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td colspan="5"><input value="<?php echo e($data->id_penilaian_kinerja); ?>" name="id_penilaian_kinerja[<?php echo e($no+1); ?>]" hidden><input value="<?php echo e($data->id_kinerja); ?>" name="id_kinerja[<?php echo e($no+1); ?>]" hidden><?php echo e($data->kinerja); ?></td>
                          <td><input onblur="findTotal1()" type="number" step="0.01" class="bobot1" value="<?php echo e($data->bobot); ?>" hidden/><?php echo e($data->bobot); ?>%</td>
                          <td><input onblur="findTotal1()" value="<?php echo e($data->nilai); ?>" type="number" step="0.01" max="<?php echo e($data->target); ?>" name="nilai[<?php echo e($no+1); ?>]" class="nilai1" required/><br></td>
                          <td><?php echo e($data->target); ?>.00</td>
                          <td><input onblur="findTotal1()" type="number" step="0.01" name="bobot_nilai[<?php echo e($no+1); ?>]" id="bobot_nilai1<?php echo e($i); ?>" value="<?php echo e($data->bobot_nilai); ?>"/></td>
                      </tr>
                      <?php $total_bobot1 += $data->bobot;?>
                      <?php $no++;?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <tr>
                        <td colspan="5">Total</td>
                        <td><?php echo e($total_bobot1); ?>%</td>
                        <td colspan="2"></td>
                        <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><input type="number" step="0.01" value="<?php echo e($tk->sub_total1); ?>" name="sub_total1" id="total1"/></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">2. <?php echo e($kategori[1]->kategori); ?></th>
                        <td><input type="number" id="kategori2" value="<?php echo e($kategori[1]->bobot); ?>" hidden/><?php echo e($kategori[1]->bobot); ?>%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php $no = $hitung;?>
                      <?php $total_bobot2 = 0;?>
                      <?php $__currentLoopData = $kinerja1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td colspan="5"><input value="<?php echo e($data->id_penilaian_kinerja); ?>" name="id_penilaian_kinerja[<?php echo e($no+1); ?>]" hidden><input value="<?php echo e($data->id_kinerja); ?>" name="id_kinerja[<?php echo e($no+1); ?>]" hidden><?php echo e($data->kinerja); ?></td>
                          <td><input onblur="findTotal2()" type="number" step="0.01" class="bobot2" value="<?php echo e($data->bobot); ?>" hidden/><?php echo e($data->bobot); ?>%</td>
                          <td><input onblur="findTotal2()" value="<?php echo e($data->nilai); ?>" type="number" step="0.01" max="<?php echo e($data->target); ?>" name="nilai[<?php echo e($no+1); ?>]" class="nilai2" required/><br></td>
                          <td><?php echo e($data->target); ?>.00</td>
                          <td><input onblur="findTotal2()" type="number" step="0.01" name="bobot_nilai[<?php echo e($no+1); ?>]" id="bobot_nilai2<?php echo e($i); ?>" value="<?php echo e($data->bobot_nilai); ?>"/></td>
                      </tr>
                      <?php $total_bobot2 += $data->bobot;?>
                      <?php $no++;?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <tr>
                        <td colspan="5">Total</td>
                        <td><?php echo e($total_bobot2); ?>%</td>
                        <td colspan="2"></td>
                        <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><input type="number" step="0.01" value="<?php echo e($tk->sub_total2); ?>" name="sub_total2" id="total2"/></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">3. <?php echo e($kategori[2]->kategori); ?></th>
                        <td><input type="number" id="kategori3" value="<?php echo e($kategori[2]->bobot); ?>" hidden/><?php echo e($kategori[2]->bobot); ?>%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php $no = $hitung + $hitung2;?>
                      <?php $total_bobot3 = 0;?>
                      <?php $__currentLoopData = $kinerja2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td colspan="5"><input value="<?php echo e($data->id_penilaian_kinerja); ?>" name="id_penilaian_kinerja[<?php echo e($no+1); ?>]" hidden><input value="<?php echo e($data->id_kinerja); ?>" name="id_kinerja[<?php echo e($no+1); ?>]" hidden><?php echo e($data->kinerja); ?></td>
                        <td><input onblur="findTotal3()" type="number" step="0.01" class="bobot3" value="<?php echo e($data->bobot); ?>" hidden/><?php echo e($data->bobot); ?>%</td>
                        <td><input onblur="findTotal3()" value="<?php echo e($data->nilai); ?>" type="number" step="0.01" max="<?php echo e($data->target); ?>" name="nilai[<?php echo e($no+1); ?>]" class="nilai3" required/><br></td>
                        <td><?php echo e($data->target); ?>.00</td>
                        <td><input onblur="findTotal3()" type="number" step="0.01" name="bobot_nilai[<?php echo e($no+1); ?>]" id="bobot_nilai3<?php echo e($i); ?>" value="<?php echo e($data->bobot_nilai); ?>"/></td>
                      </tr>
                      <?php $total_bobot3 += $data->bobot;?>
                      <?php $no++;?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <tr>
                        <td colspan="5">Total</td>
                        <td><?php echo e($total_bobot3); ?>%</td>
                        <td colspan="2"></td>
                        <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><input type="number" step="0.01" value="<?php echo e($tk->sub_total3); ?>" name="sub_total3" id="total3"/></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">Total Score</th>
                        <td><?php echo e($kategori[0]->bobot+$kategori[1]->bobot+$kategori[2]->bobot); ?>%</td>
                        <td colspan="2">4.00</td>
                        <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><input type="number" value="<?php echo e($tk->total); ?>" step="0.01" name="total_score" id="total"/></th>
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
                        <?php $__currentLoopData = $totalkinerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th colspan="2"><input type="text" name="atasan" value="<?php echo e($tk->atasan); ?>"></th>
                        <th colspan="2"><input type="text" name="hrd" value="<?php echo e($tk->hrd); ?>"></th>
                        <th colspan="2"><input type="text" name="direktur" value="<?php echo e($tk->direktur); ?>"></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tr>

                      <tr><td colspan="9"></td></tr>
                    
                      <tr>
                          <td colspan="9">
                            <div class="row mb-3 text-end">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" <?php echo e($bio->nama == null ? "hidden" : ""); ?>>Simpan Penilaian</button>
                                </div>
                            </div>
                          </td>
                      </tr>
                      
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                    </form>
                    </tbody>
                  </table>
                  <!-- End Default Table Example -->
    
                </div>
            </div>

          </div>
        </div>
      </section>

  </main>


<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    function findTotal1(){
        var arr = document.getElementsByClassName('nilai1');
        var arr2 = document.getElementsByClassName('bobot1');
        var tot= 0.0;
        var total= 0.0;
        for(var i=0;i<arr.length;i++){
            if(parseFloat(arr[i].value)){
                tot = parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('bobot_nilai1'+[i]).setAttribute('value',tot.toFixed(2));
                total += parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('total1').value = total.toFixed(2);
            }
        }
    };

    function findTotal2(){
        var arr = document.getElementsByClassName('nilai2');
        var arr2 = document.getElementsByClassName('bobot2');
        var tot= 0.0;
        var total= 0.0;
        for(var i=0;i<arr.length;i++){
            if(parseFloat(arr[i].value)){
                tot = parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('bobot_nilai2'+[i]).setAttribute('value',tot.toFixed(2));
                total += parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('total2').value = total.toFixed(2);
            }
        }
    };

    function findTotal3(){
        var final1 = document.getElementById('total1');
        var final2 = document.getElementById('total2');
        var final3 = document.getElementById('total3');

        var arr = document.getElementsByClassName('nilai3');
        var arr2 = document.getElementsByClassName('bobot3');
        var kategori1 = document.getElementById('kategori1');
        var kategori2 = document.getElementById('kategori2');
        var kategori3 = document.getElementById('kategori3');
        var tot= 0.0;
        var total= 0.0;
        
        for(var i=0;i<arr.length;i++){
            if(parseFloat(arr[i].value)){                
                tot = parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('bobot_nilai3'+[i]).setAttribute('value',tot.toFixed(2));
                total += parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('total3').setAttribute('value',total.toFixed(2));

                final = (parseFloat(final1.value) * kategori1.value/100) + (parseFloat(final2.value) * kategori2.value/100) + (parseFloat(final3.value) * kategori3.value/100);
                document.getElementById('total').setAttribute('value',final.toFixed(2));
                document.getElementById('total_score').setAttribute('value',final.toFixed(2));
            }
        }        
    };
</script>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Apk\laragon\www\scoring\resources\views/edit-penilaian-kinerja.blade.php ENDPATH**/ ?>