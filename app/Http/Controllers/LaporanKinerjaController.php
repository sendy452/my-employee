<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Kategori;
use App\Models\PenilaianKinerja;
use App\Models\TotalKinerja;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Exports\LaporanKinerjaExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKinerjaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function laporanDivisi(Request $request)
    {
        $kinerja_divisi = TotalKinerja::leftJoin('tb_karyawan', 'tb_total_kinerja.id_karyawan', '=', 'tb_karyawan.id_karyawan')
        ->leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
        ->where('tb_total_kinerja.is_active',1)->where('tb_karyawan.id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->orderBy('total', 'desc')->get();
        $divisi = Divisi::orderBy('nama_divisi','asc')->get();
       
        if ($request != "") {

            $data = $request->all();
            $validator = Validator::make($data, [
                'bulan' => 'string'
            ],[
                'bulan.string' => 'Bulan harus dipilih.'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            }

            $check = TotalKinerja::leftJoin('tb_karyawan', 'tb_total_kinerja.id_karyawan', '=', 'tb_karyawan.id_karyawan')
            ->leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->where('tb_total_kinerja.is_active',1)->where('tb_karyawan.id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->count('tb_karyawan.id_karyawan');
            if ($request->bulan != "" && $check == 0) {
                $errors = 'List penilaian karyawan tidak ditemukan.';
                return redirect()->back()->withErrors($errors);
            }
        }

        return view('laporan-kinerja-divisi', ['kinerja_divisi' => $kinerja_divisi, 'divisi' => $divisi, 'bulan' => $request->bulan, 'id_divisi' => $request->id_divisi]);
    }

    public function exportDivisi($bulan, $id_divisi)
    {
        $kinerja_divisi = TotalKinerja::leftJoin('tb_karyawan', 'tb_total_kinerja.id_karyawan', '=', 'tb_karyawan.id_karyawan')
        ->leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
        ->where('tb_total_kinerja.is_active',1)->where('tb_karyawan.id_divisi', $id_divisi)->where('bulan', date('F-Y',strtotime($bulan)))->orderBy('total', 'desc')->get();

        $pdf = PDF::loadview('export-kinerja-divisi', ['kinerja_divisi' => $kinerja_divisi]);
        return $pdf->download('Laporan Kinerja Per Divisi '.$kinerja_divisi[0]->nama_divisi.'-'.$kinerja_divisi[0]->bidang.' '.date('F-Y').'.pdf');

        //return view('export-kinerja-divisi', ['kinerja_divisi' => $kinerja_divisi]);
    }

    public function laporanKaryawan(Request $request)
    {
        $karyawan = User::where('is_active', 1)->orderBy('email','asc')->get();
        $kategori = Kategori::get();
        $hitung = PenilaianKinerja::where('id_karyawan', $request->idkaryawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('is_active', 1)->where('id_kategori',1)->count('id_kinerja');
        $hitung2 = PenilaianKinerja::where('id_karyawan', $request->idkaryawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('is_active', 1)->where('id_kategori',2)->count('id_kinerja');
        $kinerja0 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $request->idkaryawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('tb_penilaian_kinerja.id_kategori',1)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $kinerja1 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $request->idkaryawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('tb_penilaian_kinerja.id_kategori',2)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $kinerja2 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $request->idkaryawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('tb_penilaian_kinerja.id_kategori',3)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $totalkinerja = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan',$request->idkaryawan)->get();
        $totalkinerjaakhir = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($request->bulan.'last month')))->where('id_karyawan',$request->idkaryawan)->get();
        $bio = "";
       
        if ($request != "") {

            $data = $request->all();
            $validator = Validator::make($data, [
                'idkaryawan' => 'numeric',
                'bulan' => 'string'
            ],[
                'bulan.string' => 'Bulan harus dipilih.',
                'idkaryawan.numeric' => 'Email Karyawan harus dipilih.'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            }

            $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$request->idkaryawan)->get();

            $check = TotalKinerja::where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan', $request->idkaryawan)->count('bulan');
            if ($request->bulan != "" && $check != 1) {
                $errors = 'Form penilaian karyawan tidak ditemukan.';
                return redirect()->back()->withErrors($errors);
            }
        }
        
        return view('laporan-kinerja-karyawan', ['karyawan' => $karyawan, 'bio' => $bio, 'totalkinerja' => $totalkinerja, 'totalkinerjaakhir' => $totalkinerjaakhir, 'kategori' => $kategori, 'hitung' => $hitung, 'hitung2' => $hitung2, 'kinerja0' => $kinerja0, 'kinerja1' => $kinerja1, 'kinerja2' => $kinerja2, 'bulan' => $request->bulan]);
    }

    public function exportKaryawanPDF($bulan, $id_karyawan)
    {
        $karyawan = User::where('is_active', 1)->get();
        $kategori = Kategori::get();
        $hitung = PenilaianKinerja::where('id_karyawan', $id_karyawan)->where('bulan', date('F-Y',strtotime($bulan)))->where('is_active', 1)->where('id_kategori',1)->count('id_kinerja');
        $hitung2 = PenilaianKinerja::where('id_karyawan', $id_karyawan)->where('bulan', date('F-Y',strtotime($bulan)))->where('is_active', 1)->where('id_kategori',2)->count('id_kinerja');
        $kinerja0 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $id_karyawan)->where('bulan', date('F-Y',strtotime($bulan)))->where('tb_penilaian_kinerja.id_kategori',1)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $kinerja1 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $id_karyawan)->where('bulan', date('F-Y',strtotime($bulan)))->where('tb_penilaian_kinerja.id_kategori',2)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $kinerja2 = PenilaianKinerja::leftJoin('tb_kinerja', 'tb_penilaian_kinerja.id_kinerja', '=', 'tb_kinerja.id_kinerja')
        ->where('id_karyawan', $id_karyawan)->where('bulan', date('F-Y',strtotime($bulan)))->where('tb_penilaian_kinerja.id_kategori',3)->orderBy('tb_penilaian_kinerja.id_kinerja', 'ASC')->get();
        $totalkinerja = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($bulan)))->where('id_karyawan',$id_karyawan)->get();
        $totalkinerjaakhir = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($bulan.'last month')))->where('id_karyawan',$id_karyawan)->get();

        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$id_karyawan)->get();

        $pdf = PDF::loadview('export-kinerja-karyawan', ['karyawan' => $karyawan, 'bio' => $bio, 'totalkinerja' => $totalkinerja, 'totalkinerjaakhir' => $totalkinerjaakhir, 'kategori' => $kategori, 'hitung' => $hitung, 'hitung2' => $hitung2, 'kinerja0' => $kinerja0, 'kinerja1' => $kinerja1, 'kinerja2' => $kinerja2, 'bulan' => $bulan]);
        //return $pdf->stream();
        return $pdf->download('Laporan Kinerja Karyawan '.$bio[0]->nama.' '.date('F-Y').'.pdf');
    }

    public function exportKaryawanExcel($bulan, $id_karyawan)
    {
       
        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
        ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$id_karyawan)->get();

        return Excel::download(new LaporanKinerjaExport($bulan, $id_karyawan), 'Laporan Kinerja Karyawan '.$bio[0]->nama.' '.date('F-Y').'.xlsx');
    }
}
