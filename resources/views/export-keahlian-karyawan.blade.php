<html lang="en">

<head>
  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <style>
    table, td, th {
      padding: 0px 10px 0px 10px;
      border: 1px solid;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      font-family: 'arial';
      font-size:15px;
    }
  </style>
    
</head>

<body>
    <h5 class="card-title">Form Penilaian Keahlian Karyawan</h5>

    <!-- Default Table -->
    <table>
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
            <th colspan="5">Total</th>                    
            <th colspan="2">{{$total_bobot}}%</th>
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
            <td colspan="3">ttd, <br><br><br><center>{{$bio->nama}}</center></td>
            @foreach($totalkeahlian as $tk)
            <td colspan="2">ttd, <br><br><br><center>{{$tk->atasan}}</center></td>
            <td colspan="2">ttd, <br><br><br><center>{{$tk->hrd}}</center></td>
            <td colspan="2">ttd, <br><br><br><center>{{$tk->direktur}}</center></td>
            @endforeach
          </tr>

          <tr><td colspan="9"></td></tr>
        
          @endforeach
        
        </tbody>
    </table>
    <!-- End Default Table Example -->
</body>
</html>

