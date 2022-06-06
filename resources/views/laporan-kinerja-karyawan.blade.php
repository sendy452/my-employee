@extends('layouts.template')
@section('title', 'Laporan Kinerja')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan Kinerja Per Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Laporan Kinerja</li>
          <li class="breadcrumb-item active">Laporan Kinerja Per Karyawan</li>
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
              <form method="post" action="{{ url('laporan-penilaian-kinerja') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email Karyawan</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Email!-----</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id_karyawan}}">{{$data->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Bulan" class="col-md-4 col-lg-3 col-form-label">Bulan Penilaian</label>
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
                  <h5 class="card-title">Form Penilaian Kinerja Karyawan</h5>

                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <tbody>               
                    <form method="post" action="">
                    @csrf
                    @method("PUT")
                           
                      @foreach($bio as $bio)
                      <tr>
                        <th colspan="5"><input type="text" class="form-control" name="id_karyawan" value="{{$bio->id_karyawan}}" hidden>Periode Penilaian</th>
                        <th colspan="2">Nilai</th>
                        <th colspan="2">Penilaian/Daftar Nilai</th>
                      </tr>

                      <tr>   
                        <th colspan="2">Nama Karyawan</th>
                        <td colspan="3">{{$bio->nama}}</td>
                        <th>Nilai Bulan Lalu</th>
                        <td>@foreach($totalkinerjaakhir as $tk) {{$tk->total}} @endforeach</td>
                        <td>Sangat Baik</td>
                        <td>4</td>
                      </tr>

                      <tr>
                        <th colspan="2">Bagian-NIP</th>
                        <td colspan="2">{{$bio->bidang}}</td>
                        <td>{{$bio->nip}}</td>
                        <th>Nilai Sekarang</th>
                        @foreach($totalkinerja as $tk)
                        <td>{{$tk->total}}</td>
                        @endforeach
                        <td>Baik</td>
                        <td>3</td>
                      </tr>

                      <tr>
                        <th colspan="2">Tanggal Mulai Kerja</th>
                        <td colspan="3">{{date('d-m-Y',strtotime($bio->created_at))}}</td>
                        <th></th>
                        <td></td>
                        <td>Sedang</td>
                        <td>2</td>
                      </tr>

                      <tr>
                        <th colspan="2">ID Form-Penilaian Bulan</th>
                        <td colspan="1">FPKR/{{$bulan}}/{{$bio->id_karyawan}}</td>
                        <td colspan="2">{{date('F-Y',strtotime($bulan))}}</td>
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
                        <th colspan="5">1. {{$kategori[0]->kategori}}</th>
                        <td>{{$kategori[0]->bobot}}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <?php $no = 0;?>
                      <?php $total_bobot1 = 0;?>
                      @foreach($kinerja0 as $i => $data)
                      <tr>
                          <td colspan="5">{{$data->kinerja}}</td>
                          <td>{{$data->bobot}}%</td>
                          <td>{{$data->nilai ?? "0"}}</td>
                          <td>{{$data->target}}.00</td>
                          <td>{{$data->bobot_nilai ?? "0"}}</td>
                      </tr>
                      <?php $total_bobot1 += $data->bobot;?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{$total_bobot1}}%</td>
                        <td colspan="2"></td>
                        @foreach($totalkinerja as $tk)
                        <td>{{$tk->sub_total1}}</td>
                        @endforeach
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">2. {{$kategori[1]->kategori}}</th>
                        <td>{{$kategori[1]->bobot}}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php $no = $hitung;?>
                      <?php $total_bobot2 = 0;?>
                      @foreach($kinerja1 as $i => $data)
                      <tr>
                          <td colspan="5">{{$data->kinerja}}</td>
                          <td>{{$data->bobot}}%</td>
                          <td>{{$data->nilai ?? "0"}}</td>
                          <td>{{$data->target}}.00</td>
                          <td>{{$data->bobot_nilai ?? "0"}}</td>
                      </tr>
                      <?php $total_bobot2 += $data->bobot;?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{$total_bobot2}}%</td>
                        <td colspan="2"></td>
                        @foreach($totalkinerja as $tk)
                        <td>{{$tk->sub_total2}}</td>
                        @endforeach
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">3. {{$kategori[2]->kategori}}</th>
                        <td>{{$kategori[2]->bobot}}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php $no = $hitung + $hitung2;?>
                      <?php $total_bobot3 = 0;?>
                      @foreach($kinerja2 as $i => $data)
                      <tr>
                        <td colspan="5">{{$data->kinerja}}</td>
                        <td>{{$data->bobot}}%</td>
                        <td>{{$data->nilai ?? "0"}}</td>
                        <td>{{$data->target}}.00</td>
                        <td>{{$data->bobot_nilai ?? "0"}}</td>
                      </tr>
                      <?php $total_bobot3 += $data->bobot;?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{$total_bobot3}}%</td>
                        <td colspan="2"></td>
                        @foreach($totalkinerja as $tk)
                        <td>{{$tk->sub_total3}}</td>
                        @endforeach
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">Total Score</th>
                        <th>{{$kategori[0]->bobot+$kategori[1]->bobot+$kategori[2]->bobot}}%</th>
                        <th colspan="2">4.00</th>
                        @foreach($totalkinerja as $tk)
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
                        @foreach($totalkinerja as $tk)
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
                                    <a href="{{url('export-karyawan-excel/'.date('F-Y',strtotime($bulan)).'/'.$bio->id_karyawan)}}" type="button" class="btn btn-success" {{ $bio->nama == null ? "hidden" : "" }}>Cetak Excel</a>
                                    <a href="{{url('export-karyawan-pdf/'.date('F-Y',strtotime($bulan)).'/'.$bio->id_karyawan)}}" type="button" class="btn btn-danger" {{ $bio->nama == null ? "hidden" : "" }}>Cetak PDF</a>
                                </div>
                            </div>
                          </td>
                      </tr>
                      
                      @endforeach
                      
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