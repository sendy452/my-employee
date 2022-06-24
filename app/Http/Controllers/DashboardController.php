<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\TotalKinerja;
use App\Models\PenilaianKeahlian;

class DashboardController extends Controller
{
    public function index()
    {
        if(!Session::get('login')){
            return redirect('signin');
        }
        else{
            $terbaik = TotalKinerja::leftJoin('tb_karyawan', 'tb_total_kinerja.id_karyawan', '=', 'tb_karyawan.id_karyawan')->where('bulan', date('F-Y', strtotime('last month')))->orderBy('total', 'desc')->first();
            $terendah = TotalKinerja::leftJoin('tb_karyawan', 'tb_total_kinerja.id_karyawan', '=', 'tb_karyawan.id_karyawan')->where('bulan', date('F-Y', strtotime('last month')))->orderBy('total', 'asc')->first();
            $karyawan = User::select('tb_karyawan.created_at as dibuat', 'tb_karyawan.*', 'tb_divisi.*')->leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')->orderBy('tb_karyawan.created_at', 'desc')->limit(5)->get();
            $c_karyawan = User::count();
            $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $datas = [];
            foreach ($labels as $value) {
                $datas[] = User::where(\DB::raw("MONTHNAME(created_at)"),$value)->where(\DB::raw('YEAR(created_at)'), date('Y'))->count();
            }

            $keahlian = PenilaianKeahlian::leftJoin('tb_keahlian', 'tb_penilaian_keahlian.id_keahlian', '=', 'tb_keahlian.id_keahlian')->where('id_karyawan', $terbaik->id_karyawan ?? 0)->where('bulan', date('F-Y', strtotime('last month')))->orderBy('nilai', 'desc')->first();

            return view('home',['karyawan' => $karyawan, 'c_karyawan' => $c_karyawan, 'terbaik' => $terbaik, 'terendah' => $terendah, 'keahlian' => $keahlian])->with('labels', $labels)->with('datas', $datas);
        }
    }
}
