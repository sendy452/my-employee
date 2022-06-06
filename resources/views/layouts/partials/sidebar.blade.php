<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[1];
?>

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ $page == "" ? "" : "collapsed"}}" href="{{url('/')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="list-karyawan" || $page=="ubah-karyawan" || $page=="deactivate-karyawan" ? "" : "collapsed"}}" data-bs-target="#karyawan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Data Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="karyawan-nav" class="nav-content collapse {{ $page =="list-karyawan" || $page=="ubah-karyawan" || $page=="deactivate-karyawan" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-karyawan')}}" class="{{ $page=="list-karyawan" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Data Karyawan</span>
            </a>
          </li>
          <li>
            <a href="{{url('ubah-karyawan')}}" class="{{ $page=="ubah-karyawan" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Data Karyawan</span>
            </a>
          </li>
          <li>
            <a href="{{url('deactivate-karyawan')}}" class="{{ $page=="deactivate-karyawan" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>De/Aktivasi Karyawan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Karyawan Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="penilaian-kinerja" || $page=="edit-penilaian-kinerja" || $page=="penilaian-keahlian" || $page=="edit-penilaian-keahlian" ? "" : "collapsed"}}" data-bs-target="#manajemen-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manajemen Penilaian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="manajemen-nav" class="nav-content collapse {{ $page =="penilaian-kinerja" || $page=="edit-penilaian-kinerja" || $page=="penilaian-keahlian" || $page=="edit-penilaian-keahlian" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('penilaian-kinerja')}}" class="{{ $page=="penilaian-kinerja" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Tambah Penilaian Kinerja</span>
            </a>
          </li>
          <li>
            <a href="{{url('edit-penilaian-kinerja')}}" class="{{ $page=="edit-penilaian-kinerja" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Edit Penilaian Kinerja</span>
            </a>
          </li>
          <li>
            <a href="{{url('penilaian-keahlian')}}" class="{{ $page=="penilaian-keahlian" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Tambah Penilaian Keahlian</span>
            </a>
          </li>
          <li>
            <a href="{{url('edit-penilaian-keahlian')}}" class="{{ $page=="edit-penilaian-keahlian" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Edit Penilaian Keahlian</span>
            </a>
          </li>
        </ul>
      </li><!-- End Penilaian Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="laporan-penilaian-kinerja-divisi" || $page=="laporan-penilaian-kinerja" ? "" : "collapsed"}}" data-bs-target="#kinerja-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-check"></i><span>Laporan Kinerja</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kinerja-nav" class="nav-content collapse {{ $page =="laporan-penilaian-kinerja-divisi" || $page=="laporan-penilaian-kinerja" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('laporan-penilaian-kinerja-divisi')}}" class="{{ $page=="laporan-penilaian-kinerja-divisi" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Laporan Per Divisi</span>
            </a>
          </li>
          <li>
            <a href="{{url('laporan-penilaian-kinerja')}}" class="{{ $page=="laporan-penilaian-kinerja" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Laporan Per Karyawan</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Laporan Kinerja Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="laporan-penilaian-keahlian-divisi" || $page=="laporan-penilaian-keahlian" ? "" : "collapsed"}}" data-bs-target="#keahlian-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-bookmark"></i><span>Laporan Keahlian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="keahlian-nav" class="nav-content collapse {{ $page =="laporan-penilaian-keahlian-divisi" || $page=="laporan-penilaian-keahlian" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('laporan-penilaian-keahlian-divisi')}}" class="{{ $page=="laporan-penilaian-keahlian-divisi" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Laporan Per Divisi</span>
            </a>
          </li>
          <li>
            <a href="{{ url('laporan-penilaian-keahlian')}}" class="{{ $page=="laporan-penilaian-keahlian" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Laporan Per Karyawan</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Laporan Keahlian Nav -->

      <li class="nav-heading">Lain-Lain</li>
      
      <li class="nav-item">
        <a class="nav-link {{ $page =="list-divisi" ? "" : "collapsed"}}" data-bs-target="#divisi-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Master Divisi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="divisi-nav" class="nav-content collapse {{ $page =="list-divisi" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-divisi')}}" class="{{ $page=="list-divisi" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Data Divisi</span>
            </a>
          </li>
        </ul>
      </li><!-- End Divisi Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="list-kinerja" || $page=="list-keahlian" ? "" : "collapsed"}}" data-bs-target="#penilaian-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-list-check"></i><span>Master Penilaian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="penilaian-nav" class="nav-content collapse {{ $page =="list-kinerja" || $page=="list-keahlian" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-kinerja')}}" class="{{ $page=="list-kinerja" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Penilaian Kinerja</span>
            </a>
          </li>
          <li>
            <a href="{{url('list-keahlian')}}" class="{{ $page=="list-keahlian" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Penilaian Keahlian</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Penilaian Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="ubah-role-user" || $page=="list-role" ? "" : "collapsed"}}" data-bs-target="#role-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-key"></i><span>Master Role</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="role-nav" class="nav-content collapse {{ $page =="ubah-role-user" || $page=="list-role" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('ubah-role-user')}}" class="{{ $page=="ubah-role-user" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Role User</span>
            </a>
          </li>
          <li>
            <a href="{{url('list-role')}}" class="{{ $page=="list-role" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Role</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Role Nav -->

    </ul>

  </aside>