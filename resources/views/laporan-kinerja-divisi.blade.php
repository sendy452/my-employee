@extends('layouts.template')
@section('title', 'Laporan Kinerja')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Kinerja Per Jabatan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Kinerja</li>
          <li class="breadcrumb-item active">Laporan Kinerja Per Jabatan</li>
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

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan Kinerja Per Jabatan</h5>
              
              <!-- General Form Elements -->
              <form method="post" action="{{ url('laporan-penilaian-kinerja-divisi') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-sm-2 col-form-label">Pilih Jabatan</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="id_divisi">
                      @foreach($divisi as $data)
                      <option value="{{$data->id_divisi}}">{{$data->nama_divisi}} - {{$data->bidang}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="Bulan" class="col-sm-2 col-form-label">Bulan Penilaian</label>
                    <div class="col-sm-10">
                        <input type="month" class="form-control" name="bulan" max="{{date('Y-m')}}">
                    </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tampilkan Kinerja</button>
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
                <h5 class="card-title">Laporan Kinerja Per Jabatan<a href="{{url('export-divisi-pdf/'.date('F-Y',strtotime($bulan)).'/'.$id_divisi)}}" type="button" class="btn btn-danger float-end" {{ $bulan == null ? "hidden" : "" }}>Cetak PDF</a></h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama Karyawan</th>
                      <th scope="col">Email</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Penilaian Bulan</th>
                      <th scope="col">Total Nilai</th>
                      <th scope="col">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    @foreach($kinerja_divisi as $no => $data)
                    <tr>          
                      <th scope="row"><input type="text" class="form-control" name="id_keahlian" value="{{$data->id_keahlian}}" hidden>{{$no+1}}</th>
                      <td>{{$data->nip}}</td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->nama_divisi}} - {{$data->bidang}}</td>
                      <td>{{$data->bulan}}</td>
                      <td>{{$data->total}}/100</td>
                      <td>@if($data->total >= 1 && $data->total <= 25) Buruk @elseif($data->total >= 26 && $data->total <= 50) Sedang @elseif($data->total >= 51 && $data->total <= 75) Baik @elseif($data->total >= 76 && $data->total <= 100) Sangat Baik @endif</td>
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