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
           
    <h5 class="card-title">Form Penilaian Kinerja Karyawan</h5>

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
            <td colspan="3">ttd, <br><br><br><center>{{$bio->nama}}</center></td>
            @foreach($totalkinerja as $tk)
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

