<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/')); ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#karyawan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Data Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="karyawan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('list-karyawan')); ?>">
              <i class="bi bi-circle"></i><span>List Data Karyawan</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('ubah-karyawan')); ?>">
              <i class="bi bi-circle"></i><span>Ubah Data Karyawan</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('deactivate-karyawan')); ?>">
              <i class="bi bi-circle"></i><span>De/Aktivasi Karyawan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Karyawan Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#manajemen-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manajemen Penilaian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="manajemen-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('penilaian-kinerja')); ?>">
              <i class="bi bi-circle"></i><span>Tambah Penilaian Kinerja</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('edit-penilaian-kinerja')); ?>">
              <i class="bi bi-circle"></i><span>Edit Penilaian Kinerja</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('penilaian-keahlian')); ?>">
              <i class="bi bi-circle"></i><span>Tambah Penilaian Keahlian</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('edit-penilaian-keahlian')); ?>">
              <i class="bi bi-circle"></i><span>Edit Penilaian Keahlian</span>
            </a>
          </li>
        </ul>
      </li><!-- End Penilaian Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#kinerja-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-check"></i><span>Laporan Kinerja</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kinerja-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('laporan-penilaian-kinerja/divisi')); ?>">
              <i class="bi bi-circle"></i><span>Laporan Per Divisi</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('laporan-penilaian-kinerja')); ?>">
              <i class="bi bi-circle"></i><span>Laporan Per Karyawan</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Laporan Kinerja Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#keahlian-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-bookmark"></i><span>Laporan Keahlian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="keahlian-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('laporan-penilaian-keahlian/divisi')); ?>">
              <i class="bi bi-circle"></i><span>Laporan Per Divisi</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('laporan-penilaian-keahlian')); ?>">
              <i class="bi bi-circle"></i><span>Laporan Per Karyawan</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Laporan Keahlian Nav -->

      <li class="nav-heading">Lain-Lain</li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#divisi-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Master Divisi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="divisi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('list-divisi')); ?>">
              <i class="bi bi-circle"></i><span>Data Divisi</span>
            </a>
          </li>
        </ul>
      </li><!-- End Divisi Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#penilaian-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-list-check"></i><span>Master Penilaian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="penilaian-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('list-kinerja')); ?>">
              <i class="bi bi-circle"></i><span>List Penilaian Kinerja</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('list-keahlian')); ?>">
              <i class="bi bi-circle"></i><span>List Penilaian Keahlian</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Penilaian Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#role-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-key"></i><span>Master Role</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="role-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(url('ubah-role/user')); ?>">
              <i class="bi bi-circle"></i><span>Ubah Role User</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(url('list-role')); ?>">
              <i class="bi bi-circle"></i><span>List Role</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Role Nav -->

    </ul>

  </aside><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>