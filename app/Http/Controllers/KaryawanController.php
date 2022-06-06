<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Divisi;
use Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index()
    {
        $karyawan = User::select('tb_karyawan.created_at as dibuat', 'tb_karyawan.is_active as aktif', 'tb_karyawan.*', 'tb_divisi.*', 'tb_role.*')->leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
        ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->get();

        return view('list-karyawan', ['karyawan' => $karyawan]);
    }

    public function addUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nip' => 'string|unique:tb_karyawan,nip',
            'email' => 'email|unique:tb_karyawan,email',
            'password' => 'string'
        ],[
            'nip.unique' => 'NIP telah didaftarkan sebelumnya.',
            'nip.string' => 'NIP harus diisi.',
            'email.unique' => 'Email telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        User::create([
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with("message", "Data berhasil ditambahkan!");
    }    

    public function ubahKaryawan(Request $request)
    {
        $karyawan = User::get();
        $divisi = Divisi::where('is_active',1)->get();
        $bio = "";

        if ($request != "") {

            $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$request->idkaryawan)->get();
        }
        
        return view('ubah-karyawan', ['karyawan' => $karyawan,'bio' => $bio, 'divisi' => $divisi]);
    }

    public function changeUser(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'unique:tb_karyawan,email,'.$request->id_karyawan.',id_karyawan',
            'nik' => 'unique:tb_karyawan,nik,'.$request->id_karyawan.',id_karyawan',
            'nip' => 'unique:tb_karyawan,nip,'.$request->id_karyawan.',id_karyawan',
            'nohp' => 'unique:tb_karyawan,nohp,'.$request->id_karyawan.',id_karyawan'
        ],[
            'email.unique' => 'Email telah didaftarkan akun lain.',
            'nik.unique' => 'NIK/KTP telah didaftarkan akun lain.',
            'nip.unique' => 'NIP telah didaftarkan akun lain.',
            'nohp.unique' => 'No. Hp telah didaftarkan akun lain.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/ubah-karyawan')->withErrors($errors);
        }
        
        $user = User::find($request->id_karyawan);

        $user->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nohp' => $request->nohp,
            'tlahir' => $request->tlahir,
            'tgllahir' => $request->tgllahir,
            'alamat' => $request->alamat,
            'negara' => $request->negara,
            'jekel' => $request->jekel,
            'id_divisi' => $request->id_divisi
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }

    public function deactivateKaryawan()
    {
        $karyawan = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
        ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->get();
        
        return view('deactivate-karyawan', ['karyawan' => $karyawan]);
    }

    public function deactivateUser($idkaryawan)
    {
        $user = User::find($idkaryawan);

        $user->update([
            'is_active' => 0
        ]);

        return redirect()->back()->with("message", "Data berhasil dideaktivasi!");
    }

    public function activateUser($idkaryawan)
    {
        $user = User::find($idkaryawan);

        $user->update([
            'is_active' => 1
        ]);

        return redirect()->back()->with("message", "Data berhasil diaktivasi!");
    }
}
