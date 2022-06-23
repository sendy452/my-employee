<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Kinerja;
use App\Models\Keahlian;
use App\Models\Kategori;
use App\Models\PenilaianKinerja;
use App\Models\PenilaianKeahlian;
use App\Models\TotalKinerja;
use App\Models\TotalKeahlian;
use Illuminate\Support\Facades\Validator;
Use DB;

class ManajemenPenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function penilaianKinerja(Request $request, $divisi = 0)
    {
        $karyawan = User::where('is_active', 1)->orderBy('email','asc')->get();
        $kategori = Kategori::where('is_active', 1)->get();
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

            $totalkinerjaakhir = TotalKinerja::where('is_active', 1)->where('bulan', date('F-Y',strtotime($request->bulan.'last month')))->where('id_karyawan',$request->idkaryawan)->get();
        }

        if($request->idkaryawan != ""){
            (int)$divisi =  DB::table('tb_karyawan')->select("id_divisi")->where("id_karyawan", $request->idkaryawan)->get();
        }
        $hitung = Kinerja::where('is_active', 1)->where('id_kategori',1)->where('id_divsi', $divisi)->count('kinerja');
        $hitung2 = Kinerja::where('is_active', 1)->where('id_kategori',2)->where('id_divisi', $divisi)->count('kinerja');
        $kinerja0 = Kinerja::where('is_active', 1)->where('id_kategori',1)->where('id_divisi', $divisi)->get();
        $kinerja1 = Kinerja::where('is_active', 1)->where('id_kategori',2)->where('id_divisi', $divisi)->get();
        $kinerja2 = Kinerja::where('is_active', 1)->where('id_kategori',3)->where('id_divisi', $divisi)->get();

        $check = TotalKinerja::where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan', $request->idkaryawan)->count('bulan');
        if ($check != 0) {
            $errors = 'Form penilaian karyawan telah didaftarkan sebelumnya.';
            return redirect()->back()->withErrors($errors);
        }
        
        return view('penilaian-kinerja', ['karyawan' => $karyawan, 'bio' => $bio, 'kategori' => $kategori, 'hitung' => $hitung, 'hitung2' => $hitung2, 'kinerja0' => $kinerja0, 'kinerja1' => $kinerja1, 'kinerja2' => $kinerja2, 'bulan' => $request->bulan, 'totalkinerjaakhir' => $totalkinerjaakhir,]);
    }

    public function addPenilaianKinerja(Request $request)
    {
        $batas = Kinerja::where('is_active', 1)->count('kinerja');

        $data = $request->all();
        $validator = Validator::make($data, [
            'id_form' => 'string|unique:tb_total_kinerja,id_form',
        ],[
            'id_form.unique' => 'Penilaian telah didaftarkan sebelumnya.'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        for ($i = 1; $i <= $batas; $i++) {
            $answers[] = [
                'id_karyawan' => $request->id_karyawan,
                'id_form' => $request->id_form,
                'bulan' => $request->bulan,
                'id_kategori' => $request->id_kategori[$i],
                'id_kinerja' => $request->id_kinerja[$i],
                'nilai' => $request->nilai[$i],
                'bobot_nilai' => $request->bobot_nilai[$i]
            ];
        }
        PenilaianKinerja::insert($answers);

        TotalKinerja::insert([
            'id_karyawan' => $request->id_karyawan,
            'id_form' => $request->id_form,
            'bulan' => $request->bulan,
            'atasan' => $request->atasan,
            'hrd' => $request->hrd,
            'direktur' => $request->direktur,
            'sub_total1' => $request->sub_total1,
            'sub_total2' => $request->sub_total2,
            'sub_total3' => $request->sub_total3,
            'total' => $request->total_score
        ]);

        return redirect()->back()->with("message", "Penilaian berhasil ditambahkan!");
    }    

    public function editPenilaianKinerja(Request $request)
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
        
        return view('edit-penilaian-kinerja', ['karyawan' => $karyawan, 'bio' => $bio, 'totalkinerja' => $totalkinerja, 'totalkinerjaakhir' => $totalkinerjaakhir, 'kategori' => $kategori, 'hitung' => $hitung, 'hitung2' => $hitung2, 'kinerja0' => $kinerja0, 'kinerja1' => $kinerja1, 'kinerja2' => $kinerja2, 'bulan' => $request->bulan]);
    }

    public function changePenilaianKinerja(Request $request)
    {
        $batas = PenilaianKinerja::where('id_karyawan', $request->id_karyawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->count('id_kinerja');

        $data = $request->all();
        $validator = Validator::make($data, [
            'nilai' => 'required',
        ],[
            'nilai.required' => 'Harap isi semua nilai'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        for ($i = 1; $i <= $batas; $i++) {
            $penilaiankinerja = PenilaianKinerja::find($request->id_penilaian_kinerja[$i]);
            $penilaiankinerja->update([
                'id_kinerja' => $request->id_kinerja[$i],
                'nilai' => $request->nilai[$i],
                'bobot_nilai' => $request->bobot_nilai[$i]
            ]);
        }

        
        $totalkinerja = TotalKinerja::where('id_form',$request->id_form);
        $totalkinerja->update([
            'atasan' => $request->atasan,
            'hrd' => $request->hrd,
            'direktur' => $request->direktur,
            'sub_total1' => $request->sub_total1,
            'sub_total2' => $request->sub_total2,
            'sub_total3' => $request->sub_total3,
            'total' => $request->total_score
        ]);

        return redirect()->back()->with("message", "Form penilaian berhasil diupdate!");
    }

    public function penilaianKeahlian(Request $request)
    {
        $karyawan = User::where('is_active', 1)->orderBy('email','asc')->get();
        $divisi = Divisi::where('is_active', 1)->get();
        $keahlian = Keahlian::where('id_divisi', $request->id_divisi)->where('is_active', 1)->get();
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
            
            $totalkeahlianakhir = TotalKeahlian::where('id_divisi', $request->id_divisi)->where('is_active', 1)->where('bulan', date('F-Y',strtotime($request->bulan.'last month')))->where('id_karyawan',$request->idkaryawan)->get();

        }

        $check = TotalKeahlian::where('id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan', $request->idkaryawan)->count('bulan');
        if ($request->bulan != "" && $check != 0) {
            $errors = 'Form penilaian karyawan telah didaftarkan sebelumnya..';
            return redirect()->back()->withErrors($errors);
        }
        
        return view('penilaian-keahlian', ['karyawan' => $karyawan, 'bio' => $bio, 'keahlian' => $keahlian, 'bulan' => $request->bulan, 'id_dv' => $request->id_divisi, 'divisi' => $divisi, 'totalkeahlianakhir' => $totalkeahlianakhir]);
    }

    public function addPenilaianKeahlian(Request $request)
    {
        $batas = Keahlian::where('id_divisi',$request->id_divisi)->count('keahlian');

        $data = $request->all();
        $validator = Validator::make($data, [
            'id_form' => 'string|unique:tb_penilaian_keahlian,id_form,'.$request->bulan.',bulan',
            'id_form' => 'string|unique:tb_total_keahlian,id_form,'.$request->bulan.',bulan',
        ],[
            'id_form.unique' => 'Penilaian telah didaftarkan sebelumnya.'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        for ($i = 1; $i <= $batas; $i++) {
            $answers[] = [
                'id_karyawan' => $request->id_karyawan,
                'id_form' => $request->id_form,
                'id_divisi' => $request->id_divisi,
                'bulan' => $request->bulan,
                'id_keahlian' => $request->id_keahlian[$i],
                'nilai' => $request->nilai[$i],
                'bobot_nilai' => $request->bobot_nilai[$i]
            ];
        }
        PenilaianKeahlian::insert($answers);

        TotalKeahlian::insert([
            'id_karyawan' => $request->id_karyawan,
            'id_divisi' => $request->id_divisi,
            'id_form' => $request->id_form,
            'bulan' => $request->bulan,
            'atasan' => $request->atasan,
            'hrd' => $request->hrd,
            'direktur' => $request->direktur,
            'total' => $request->total
        ]);

        return redirect()->back()->with("message", "Penilaian berhasil ditambahkan!");
    }    

    public function editPenilaianKeahlian(Request $request)
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
                'idkaryawan.numeric' => 'Email Karyawan harus dipilih.',
                'bulan.string' => 'Bulan harus dipilih.'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            }

            $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$request->idkaryawan)->get();
        }

        $check = TotalKeahlian::where('id_divisi', $request->id_divisi)->where('bulan', date('F-Y',strtotime($request->bulan)))->where('id_karyawan', $request->idkaryawan)->count('bulan');
        if ($request->bulan != "" && $check != 1) {
            $errors = 'Form penilaian karyawan tidak ditemukan.';
            return redirect()->back()->withErrors($errors);
        }
        
        return view('edit-penilaian-keahlian', ['karyawan' => $karyawan, 'bio' => $bio, 'penilaiankeahlian' => $penilaiankeahlian, 'totalkeahlian' => $totalkeahlian, 'id_dv' => $request->id_divisi, 'totalkeahlianakhir' => $totalkeahlianakhir, 'bulan' => $request->bulan, 'divisi' => $divisi]);
    }

    public function changePenilaianKeahlian(Request $request)
    {
        $batas = PenilaianKeahlian::where('id_divisi', $request->id_divisi)->where('id_karyawan', $request->id_karyawan)->where('bulan', date('F-Y',strtotime($request->bulan)))->count('id_keahlian');

        $data = $request->all();
        $validator = Validator::make($data, [
            'nilai' => 'required',
        ],[
            'nilai.required' => 'Harap isi semua nilai'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        for ($i = 1; $i <= $batas; $i++) {
            $penilaiankeahlian = PenilaianKeahlian::find($request->id_penilaian_keahlian[$i]);
            $penilaiankeahlian->update([
                'id_keahlian' => $request->id_keahlian[$i],
                'nilai' => $request->nilai[$i],
                'bobot_nilai' => $request->bobot_nilai[$i]
            ]);
        }

        
        $totalkeahlian = TotalKeahlian::where('id_form',$request->id_form);
        $totalkeahlian->update([
            'atasan' => $request->atasan,
            'hrd' => $request->hrd,
            'direktur' => $request->direktur,
            'total' => $request->total
        ]);

        return redirect()->back()->with("message", "Form penilaian berhasil diupdate!");
    }

}
