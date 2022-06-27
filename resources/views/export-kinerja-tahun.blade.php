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
      font-size:12px;
    }
  </style>
    
</head>

<body>
           
    <h5 class="card-title">Laporan Penilaian Kinerja Per Tahun {{$tahun}}</h5>

    <!-- Default Table -->
    <table class="table">
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
        <th scope="row">{{$no+1}}</th>
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
           
</body>
</html>

