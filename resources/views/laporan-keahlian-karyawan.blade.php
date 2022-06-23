@extends('layouts.template')
@section('title', 'Laporan Keahlian')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Keahlian Per Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Keahlian</li>
          <li class="breadcrumb-item active">Laporan Keahlian Per Karyawan</li>
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
              <h5 class="card-title">Pilih Data Karyawan</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ url('laporan-penilaian-keahlian') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Nama Karyawan</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Karyawan-----</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id_karyawan}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-md-4 col-lg-3 col-form-label">Pilih Divisi Tujuan</label>
                  <div class="col-md-8 col-lg-9">
                  <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="id_divisi">
                      @foreach($divisi as $data)
                      <option value="{{$data->id_divisi}}">{{$data->nama_divisi}} - {{$data->bidang}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Bulan Penilaian</label>
                    <div class="col-md-8 col-lg-9">
                        <input type="month" class="form-control" name="bulan" max="{{date('Y-m')}}">
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
                  <h5 class="card-title">Form Penilaian Keahlian Karyawan</h5>

                  <div class="table-responsive">
                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <tbody>               
                      @foreach($bio as $bio)
                      <tr>
                        <th colspan="5">Periode Penilaian</th>
                        <th colspan="2">Nilai</th>
                        <th colspan="2">Penilaian/Daftar Nilai</th>
                      </tr>

                      <tr>   
                        <th colspan="2">Nama Karyawan</th>
                        <td colspan="3">{{$bio->nama}}</td>
                        <th>Nilai Bulan Lalu</th>
                        <td>@foreach($totalkeahlianakhir as $tk) {{$tk->total}}@endforeach%</td>
                        <td>Sangat Baik</td>
                        <td>76 - 100%</td>
                      </tr>

                      <tr>
                        <th colspan="2">Bagian-NIP</th>
                        <td colspan="2">{{$bio->bidang}}</td>
                        <td>{{$bio->nip}}</td>
                        <th>Nilai Sekarang</th>
                        @foreach($totalkeahlian as $tk)
                        <td>{{$tk->total}}%</td>
                        @endforeach
                        <td>Baik</td>
                        <td>51 - 75%</td>
                      </tr>

                      <tr>
                        <th colspan="2">Tanggal Mulai Kerja</th>
                        <td colspan="3">{{date('d-m-Y',strtotime($bio->created_at))}}</td>
                        <th>Penilaian Divisi</th>
                        <td>@foreach($divisi as $dv){{$dv->id_divisi == $id_dv ? $dv->nama_divisi : ""}}@endforeach</td>
                        <td>Sedang</td>
                        <td>26 - 50%</td>
                      </tr>

                      <tr>
                        <th colspan="2">ID Form-Penilaian Bulan</th>
                        <td colspan="1">FPKH/{{$bulan}}/{{$bio->id_karyawan}}</td>
                        <td colspan="2">{{date('F-Y',strtotime($bulan))}}</td>
                        <th>Penilaian Bidang</th>
                        <td>@foreach($divisi as $dv){{$dv->id_divisi == $id_dv ? $dv->bidang : ""}}@endforeach</td>
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
                      @foreach($penilaiankeahlian as $i => $data)
                      <tr>
                          <td colspan="5">{{$data->keahlian}}</td>
                          <td colspan="2">{{$data->bobot}}%</td>
                          <td>{{$data->nilai}}</td>
                          <td>{{$data->bobot_nilai}}</td>
                      </tr>
                      <?php $total_bobot += $data->bobot ?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <th colspan="5">Total</td>                    
                        <th colspan="2">{{$total_bobot}}%</td>
                        <td></td>
                        @foreach($totalkeahlian as $tk)
                        <th>{{$tk->total}}</th>
                        @endforeach
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
                        <td colspan="3">{{$bio->nama}}</td>
                        @foreach($totalkeahlian as $tk)
                        <td colspan="2">{{$tk->atasan}}</td>
                        <td colspan="2">{{$tk->hrd}}</td>
                        <td colspan="2">{{$tk->direktur}}</td>
                        @endforeach
                      </tr>

                      <tr><td colspan="9"></td></tr>
                    
                      <tr>
                          <td colspan="9">
                            <div class="row mb-3 text-end">
                                <div class="col-sm-12">
                                    <a href="{{url('export-keahlian-excel/'.date('F-Y',strtotime($bulan)).'/'.$bio->id_karyawan.'/'.$id_dv)}}" type="button" class="btn btn-success" {{ $bio->nama == null ? "hidden" : "" }}>Cetak Excel</a>
                                    <a href="{{url('export-keahlian-pdf/'.date('F-Y',strtotime($bulan)).'/'.$bio->id_karyawan.'/'.$id_dv)}}" type="button" class="btn btn-danger" {{ $bio->nama == null ? "hidden" : "" }}>Cetak PDF</a>
                                </div>
                            </div>
                          </td>
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