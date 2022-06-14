<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use App\Models\PenilaianKeahlian;
use App\Models\TotalKeahlian;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Exports\LaporanKeahlianExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeahlianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function laporanDivisi(Request $request)
    {
        $keahlian_divisi = TotalKeahlian::leftJoin('tb_karyawan', 'tb_total_keahlian.id_karyawan', '=', 'tb_karyawan.id_karyawan')
        ->leftJoin('tb_divisi', 'tb_total_keahlian.id_divisi', '=', 'tb_divisi.id_divisi')
        ->where('tb_total_keahlian.is_active',1)->where('tb_total_keahlian.id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->orderBy('total', 'desc')->get();
        $divisi = Divisi::orderBy('nama_divisi','asc')->get();
        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->get();
       
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

            $check = TotalKeahlian::leftJoin('tb_karyawan', 'tb_total_keahlian.id_karyawan', '=', 'tb_karyawan.id_karyawan')
            ->leftJoin('tb_divisi', 'tb_total_keahlian.id_divisi', '=', 'tb_divisi.id_divisi')
            ->where('tb_total_keahlian.is_active',1)->where('tb_total_keahlian.id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->count('tb_karyawan.id_karyawan');
            if ($request->bulan != "" && $check == 0) {
                $errors = 'List penilaian karyawan tidak ditemukan.';
                return redirect()->back()->withErrors($errors);
            }
        }
        
        return view('laporan-keahlian-divisi', ['keahlian_divisi' => $keahlian_divisi, 'bio' => $bio,'divisi' => $divisi, 'bulan' => $request->bulan, 'id_divisi' => $request->id_divisi]);
    }

    public function exportDivisi($bulan, $id_divisi)
    {
        $keahlian_divisi = TotalKeahlian::leftJoin('tb_karyawan', 'tb_total_keahlian.id_karyawan', '=', 'tb_karyawan.id_karyawan')
        ->leftJoin('tb_divisi', 'tb_total_keahlian.id_divisi', '=', 'tb_divisi.id_divisi')
        ->where('tb_total_keahlian.is_active',1)->where('tb_total_keahlian.id_divisi', $id_divisi)->where('bulan', date('F-Y',strtotime($bulan)))->orderBy('total', 'desc')->get();
        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->get();

        $pdf = PDF::loadview('export-keahlian-divisi', ['keahlian_divisi' => $keahlian_divisi, 'bio' => $bio]);
        //return $pdf->stream();
        return $pdf->download('Laporan Keahlian Per Divisi '.$keahlian_divisi[0]->nama_divisi.'-'.$keahlian_divisi[0]->bidang.' '.date('F-Y').'.pdf');

        //return view('export-kinerja-divisi', ['kinerja_divisi' => $kinerja_divisi]);
    }

    public function laporanKaryawan(Request $request)
    {
        $karyawan = User::where('is_active', 1)->orderBy('email','asc')->get();
        $divisi = Divisi::get();
        $penilaiankeahlian = PenilaianKeahlian::leftJoin('tb_keahlian', 'tb_penilaian_keahlian.id_keahlian', '=', 'tb_keahlian.id_keahlian')
        ->where('tb_penilaian_keahlian.id_divisi', $request->id_divisi)->where('id_karyawan', $request->idkaryawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan',$request->idkaryawan)->orderBy('tb_penilaian_keahlian.id_keahlian', 'asc')->get();
        $totalkeahlian = TotalKeahlian::where('id_divisi', $request->id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan',$request->idkaryawan)->get();
        $totalkeahlianakhir = TotalKeahlian::where('id_divisi', $request->id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($request->bulan.'last month')))->where('id_karyawan',$request->idkaryawan)->get();
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

            $check = TotalKeahlian::where('id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan', $request->idkaryawan)->count('bulan');
            if ($request->bulan != "" && $check == 0) {
                $errors = 'Form penilaian karyawan tidak ditemukan.';
                return redirect()->back()->withErrors($errors);
            }
        }
        
        return view('laporan-keahlian-karyawan', ['karyawan' => $karyawan, 'bio' => $bio, 'penilaiankeahlian' => $penilaiankeahlian, 'totalkeahlian' => $totalkeahlian, 'id_dv' => $request->id_divisi, 'totalkeahlianakhir' => $totalkeahlianakhir, 'bulan' => $request->bulan, 'divisi' => $divisi]);
    }

    public function exportKaryawanPDF($bulan, $id_karyawan, $id_divisi)
    {
        $karyawan = User::where('is_active', 1)->get();
        $divisi = Divisi::get();
        $penilaiankeahlian = PenilaianKeahlian::leftJoin('tb_keahlian', 'tb_penilaian_keahlian.id_keahlian', '=', 'tb_keahlian.id_keahlian')
        ->where('tb_penilaian_keahlian.id_divisi', $id_divisi)->where('id_karyawan', $id_karyawan)->where('bulan', date('F-Y',strtotime($bulan)))->where('id_karyawan',$id_karyawan)->orderBy('tb_penilaian_keahlian.id_keahlian', 'asc')->get();
        $totalkeahlian = TotalKeahlian::where('id_divisi', $id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($bulan)))->where('id_karyawan',$id_karyawan)->get();
        $totalkeahlianakhir = TotalKeahlian::where('id_divisi', $id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($bulan.'last month')))->where('id_karyawan',$id_karyawan)->get();
        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$id_karyawan)->get();

        $pdf = PDF::loadview('export-keahlian-karyawan', ['karyawan' => $karyawan, 'bio' => $bio, 'penilaiankeahlian' => $penilaiankeahlian, 'totalkeahlian' => $totalkeahlian, 'id_dv' => $id_divisi, 'totalkeahlianakhir' => $totalkeahlianakhir, 'bulan' => $bulan, 'divisi' => $divisi]);
        //return $pdf->stream();
        return $pdf->download('Laporan Keahlian Karyawan '.$bio[0]->nama.' '.date('F-Y').'.pdf');
    }

    public function exportKaryawanExcel($bulan, $id_karyawan, $id_divisi)
    {
       
        $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$id_karyawan)->get();

        return Excel::download(new LaporanKeahlianExport($bulan, $id_karyawan, $id_divisi), 'Laporan Keahlian Karyawan '.$bio[0]->nama.' '.date('F-Y').'.xlsx');
    }
}
