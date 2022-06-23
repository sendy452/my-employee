@extends('layouts.template')
@section('title', 'Manajemen Penilaian')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Tambah Penilaian Kinerja</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Manajemen Penilaian</li>
          <li class="breadcrumb-item active">Tambah Penilaian Kinerja</li>
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
              <form method="post" action="{{ url('penilaian-kinerja') }}">
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
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Bulan Penilaian</label>
                    <div class="col-md-8 col-lg-9">
                        <input type="month" class="form-control" name="bulan" max="{{date('Y-m')}}">
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Buat Penilaian</button>
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
                  <h5 class="card-title">Form Penilaian Kinerja</h5>

                  <div class="table-responsive">
                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <tbody>               
                    <form method="post" action="{{ route('add.penilaian.kinerja') }}">
                    @csrf
                           
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
                        <td>76-100</td>
                      </tr>

                      <tr>
                        <th colspan="2">Bagian-NIP</th>
                        <td colspan="2">{{$bio->bidang}}</td>
                        <td>{{$bio->nip}}</td>
                        <th>Nilai Sekarang</th>
                        <td><input type="number" value="0" step="0.01" id="total_score" disabled/></td>
                        <td>Baik</td>
                        <td>51-75</td>
                      </tr>

                      <tr>
                        <th colspan="2">Tanggal Mulai Kerja</th>
                        <td colspan="3">{{date('d-m-Y',strtotime($bio->created_at))}}</td>
                        <th></th>
                        <td></td>
                        <td>Sedang</td>
                        <td>26-50</td>
                      </tr>

                      <tr>
                        <th colspan="2">ID Form-Penilaian Bulan</th>
                        <td colspan="1"><input type="text" name="id_form" value="FPKR/{{$bulan}}/{{$bio->id_karyawan}}" hidden>FPKR/{{$bulan}}/{{$bio->id_karyawan}}</td>
                        <td colspan="2"><input type="text" name="bulan" value="{{date('F-Y',strtotime($bulan))}}" hidden>{{date('F-Y',strtotime($bulan))}}</td>
                        <th></th>
                        <td></td>
                        <td>Buruk</td>
                        <td>1-25</td>
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
                        <td><input type="number" id="kategori1" value="{{$kategori[0]->bobot}}" hidden/>{{$kategori[0]->bobot}}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      
                      <?php $no = 0;?>
                      <?php $total_bobot1 = 0;?>
                      @foreach($kinerja0 as $i => $data)
                      <tr>
                          <td colspan="5"><input value="{{$kategori[0]->id_kategori}}" name="id_kategori[{{$no+1}}]" hidden><input value="{{$data->id_kinerja}}" name="id_kinerja[{{$no+1}}]" hidden>{{$data->kinerja}}</td>
                          <td><input onblur="findTotal1()" type="number" class="bobot1" value="{{$data->bobot}}" hidden/>{{$data->bobot}}%</td>
                          <td><input onblur="findTotal1()" type="number" min="1" max="{{$data->target}}" name="nilai[{{$no+1}}]" class="nilai1" required/><br></td>
                          <td>{{$data->target}}.00</td>
                          <td><input onblur="findTotal1()" type="number" step="0.01" name="bobot_nilai[{{$no+1}}]" id="bobot_nilai1{{$i}}" value="0"/></td>
                      </tr>
                      <?php $total_bobot1 += $data->bobot;?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{$total_bobot1}}%</td>
                        <td colspan="2"></td>
                        <th><input type="number" step="0.01" value="0" name="sub_total1" id="total1"/></th>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">2. {{$kategori[1]->kategori}}</th>
                        <td><input type="number" id="kategori2" value="{{$kategori[1]->bobot}}" hidden/>{{$kategori[1]->bobot}}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php $no = $hitung;?>
                      <?php $total_bobot2 = 0;?>
                      @foreach($kinerja1 as $i => $data)
                      <tr>
                          <td colspan="5"><input value="{{$kategori[1]->id_kategori}}" name="id_kategori[{{$no+1}}]" hidden><input value="{{$data->id_kinerja}}" name="id_kinerja[{{$no+1}}]" hidden>{{$data->kinerja}}</td>
                          <td><input onblur="findTotal2()" type="number" class="bobot2" value="{{$data->bobot}}" hidden/>{{$data->bobot}}%</td>
                          <td><input onblur="findTotal2()" type="number" min="1" max="{{$data->target}}" name="nilai[{{$no+1}}]" class="nilai2" required/><br></td>
                          <td>{{$data->target}}.00</td>
                          <td><input onblur="findTotal2()" type="number" step="0.01" name="bobot_nilai[{{$no+1}}]" id="bobot_nilai2{{$i}}" value="0"/></td>
                      </tr>
                      <?php $total_bobot2 += $data->bobot;?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{$total_bobot2}}%</td>
                        <td colspan="2"></td>
                        <th><input type="number" step="0.01" value="0" name="sub_total2" id="total2"/></th>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">3. {{$kategori[2]->kategori}}</th>
                        <td><input type="number" id="kategori3" value="{{$kategori[2]->bobot}}" hidden/>{{$kategori[2]->bobot}}%</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php $no = $hitung + $hitung2;?>
                      <?php $total_bobot3 = 0;?>
                      @foreach($kinerja2 as $i => $data)
                      <tr>
                        <td colspan="5"><input value="{{$kategori[2]->id_kategori}}" name="id_kategori[{{$no+1}}]" hidden><input value="{{$data->id_kinerja}}" name="id_kinerja[{{$no+1}}]" hidden>{{$data->kinerja}}</td>
                        <td><input onblur="findTotal3()" type="number" class="bobot3" value="{{$data->bobot}}" hidden/>{{$data->bobot}}%</td>
                        <td><input onblur="findTotal3()" type="number" min="1" max="{{$data->target}}" name="nilai[{{$no+1}}]" class="nilai3" required/><br></td>
                        <td>{{$data->target}}.00</td>
                        <td><input onblur="findTotal3()" type="number" step="0.01" name="bobot_nilai[{{$no+1}}]" id="bobot_nilai3{{$i}}" value="0"/></td>
                      </tr>
                      <?php $total_bobot3 += $data->bobot;?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{$total_bobot3}}%</td>
                        <td colspan="2"></td>
                        <th><input type="number" step="0.01" value="0" name="sub_total3" id="total3"/></th>
                      </tr>

                      <tr><td colspan="9"></td></tr>

                      <tr>
                        <th colspan="5">Total Score</th>
                        <td>{{$kategori[0]->bobot+$kategori[1]->bobot+$kategori[2]->bobot}}%</td>
                        <td>100</td>
                        <td>-</td>
                        <th><input type="number" step="0.01" name="total_score" id="total"/>/{{$kategori[0]->bobot+$kategori[1]->bobot+$kategori[2]->bobot}}%</th>
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
                        <th colspan="2"><input type="text" name="atasan"></th>
                        <th colspan="2"><input type="text" name="hrd"></th>
                        <th colspan="2"><input type="text" name="direktur"></th>
                      </tr>

                      <tr><td colspan="9"></td></tr>
                    
                      <tr>
                          <td colspan="9">
                            <div class="row mb-3 text-end">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" {{ $bio->nama == null ? "hidden" : "" }}>Simpan Penilaian</button>
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
        </div>
      </section>

  </main>


@section('script')
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