@extends('layouts.template')
@section('title', 'De/Aktivasi Karyawan')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>De/Aktivasi Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Data Karyawan</li>
          <li class="breadcrumb-item active">De/Aktivasi Karyawan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if($errors->any())
        @foreach ($errors->all() as $danger)
              <h6 class="alert alert-danger">{{ $danger }}</h6>
        @endforeach
      @endif
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>
    @endif

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

        </div>
      </div>
    </section>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Data Karyawan</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">NIP</th>
                      <th scope="col">Email</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Divisi</th>
                      <th scope="col">Bidang</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aktivasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($karyawan as $no => $data)
                    <tr>
                      <td hidden>{{$data->id_karyawan}}</td>
                      <th scope="row">{{$data->nip}}</th>
                      <td>{{$data->email}}</td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->nama_divisi}}</td>
                      <td>{{$data->bidang}}</td>
                      <td>{{$data->is_active == 1 ? 'Aktif' : 'Tidak Aktif'}}</td>
                      <td><a style="width:110px" href="{{$data->is_active == 1 ? url('deactivate-user').'/'.$data->id_karyawan : url('activate-user').'/'.$data->id_karyawan}}" class="btn {{$data->is_active == 1 ? 'btn-danger' : 'btn-success'}}" type="button">{{$data->is_active == 1 ? 'Deaktivasi' : 'Aktivasi'}}</a></td>
                    </tr>
                    @endforeach
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