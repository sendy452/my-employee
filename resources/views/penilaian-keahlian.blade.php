@extends('layouts.template')
@section('title', 'Manajemen Penilaian')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Tambah Penilaian Keahlian</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Manajemen Penilaian</li>
          <li class="breadcrumb-item active">Tambah Penilaian Keahlian</li>
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
              <form method="post" action="{{ url('penilaian-keahlian') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Nama Karyawan</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>Pilih Nama!</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id_karyawan}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-md-4 col-lg-3 col-form-label">Pilih Jabatan Tujuan</label>
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
                  <h5 class="card-title">Form Penilaian Keahlian</h5>

                  <div class="table-responsive">
                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <tbody>               
                    <form method="post" action="{{ route('add.penilaian.keahlian') }}">
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
                        <td>@foreach($totalkeahlianakhir as $tk) {{$tk->total != 0 ? $tk->total : "0"}}@endforeach%</td>
                        <td>Sangat Baik</td>
                        <td>76 - 100%</td>
                      </tr>

                      <tr>
                        <th colspan="2">Bagian-NIP</th>
                        <td colspan="2">{{$bio->bidang}}</td>
                        <td>{{$bio->nip}}</td>
                        <th>Nilai Sekarang</th>
                        <td><input type="number" value="" step="0.01" id="total_score" disabled/>%</td>
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
                        <td colspan="2"><input type="text" name="id_form" value="FPKH/{{$bulan}}/{{$bio->id_karyawan}}" hidden>FPKH/{{$bulan}}/{{$bio->id_karyawan}}</td>
                        <td colspan="1"><input type="text" name="bulan" value="{{date('F-Y',strtotime($bulan))}}" hidden>{{date('F-Y',strtotime($bulan))}}</td>
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
                      @foreach($keahlian as $i => $data)
                      <tr>
                          <td colspan="5"><input type="text" class="form-control" name="id_divisi" value="{{$data->id_divisi}}" hidden><input value="{{$data->id_keahlian}}" name="id_keahlian[{{$no+1}}]" hidden>{{$data->keahlian}}</td>
                          <td colspan="2"><input onblur="findTotal()" type="number" class="bobot" value="{{$data->bobot}}" hidden/>{{$data->bobot}}%</td>
                          <td><input onblur="findTotal()" type="number" min="0" max="100" name="nilai[{{$no+1}}]" class="nilai" required/><br></td>
                          <td><input onblur="findTotal()" type="number" step="0.01" name="bobot_nilai[{{$no+1}}]" id="bobot_nilai{{$i}}" value="0"/></td>
                      </tr>
                      <?php $total_bobot += $data->bobot ?>
                      <?php $no++;?>
                      @endforeach

                      <tr>
                        <td colspan="5">Total</td>                    
                        <td colspan="2">{{$total_bobot}}%</td>
                        <td></td>
                        <th><input type="number" step="0.01" value="" name="total" id="total"/></th>
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

    function findTotal(){
        var arr = document.getElementsByClassName('nilai');
        var arr2 = document.getElementsByClassName('bobot');
        var tot= 0.0;
        var total= 0.0;
        for(var i=0;i<arr.length;i++){
            if(parseFloat(arr[i].value)){
                tot = parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
                document.getElementById('bobot_nilai'+[i]).setAttribute('value',tot.toFixed(2));
                total += parseFloat(arr[i].value) * parseFloat(arr2[i].value) / 100;
            }
        }
        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('total_score').value = total.toFixed(2);
    };
</script>