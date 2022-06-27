@extends('layouts.template')
@section('title', 'Laporan Kinerja')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Per Tahun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Kinerja</li>
          <li class="breadcrumb-item active">Laporan Per Tahun</li>
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
              <h5 class="card-title">Laporan Kinerja Per Tahun</h5>
              
              <!-- General Form Elements -->
              <form method="post" action="{{ url('laporan-penilaian-kinerja-tahun') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Nama" class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Karyawan-----</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id_karyawan}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Bulan" class="col-sm-2 col-form-label">Tahun Penilaian</label>
                    <div class="col-sm-10">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'  class="form-control" name="tahun">
                        @for ($year = (int)date('Y'); 2000 <= $year; $year--)
                            <option value="<?=$year;?>"><?=$year;?></option>
                        @endfor
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
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
                        <h5 class="card-title">Grafik Penilaian Karyawan Per Tahun {{$tahun ?? ''}}</h5>
            
                        <!-- Line Chart -->
                        <canvas id="lineChart" style="max-height: 400px;"></canvas>
                        <script>
                        const labels = {!! json_encode($labels) !!};
                        const datas = {!! json_encode($datas) !!};
                        console.log(datas);
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#lineChart'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                label: 'Nilai Karyawan',
                                data: datas,
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                                }]
                            },
                            options: {
                                scales: {
                                y: {
                                    beginAtZero: true
                                }
                                }
                            }
                            });
                        });
                        </script>
                        <!-- End Line CHart -->
            
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
                <h5 class="card-title">Penilaian Kinerja Karyawan Per Tahun {{$tahun ?? ''}}<a href="{{url('export-tahun-pdf/'.$tahun.'/'.$id_karyawan)}}" type="button" class="btn btn-danger float-end" {{ $tahun == null ? "hidden" : "" }}>Cetak PDF</a></h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
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
                    
                    @foreach($kinerja_tahun as $no => $data)
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