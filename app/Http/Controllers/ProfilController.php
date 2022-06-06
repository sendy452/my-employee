<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index()
    {
        $profil = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
        ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',Session::get('id_karyawan'))->get();

        return view('profil', ['profil' => $profil]);
    } 

    public function profileChange(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email|unique:tb_karyawan,email,'.Session::get('id_karyawan').',id_karyawan',
            'nik' => 'unique:tb_karyawan,nik,'.Session::get('id_karyawan').',id_karyawan',
            'nip' => 'unique:tb_karyawan,nip,'.Session::get('id_karyawan').',id_karyawan',
            'nohp' => 'unique:tb_karyawan,nohp,'.Session::get('id_karyawan').',id_karyawan',
        ],[
            'email.unique' => 'Email telah didaftarkan akun lain.',
            'nik.unique' => 'NIK/KTP telah didaftarkan akun lain.',
            'nip.unique' => 'NIP telah didaftarkan akun lain.',
            'nohp.unique' => 'No. Hp telah didaftarkan akun lain.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }
        
        $user = User::find(Session::get('id_karyawan'));

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
            'jekel' => $request->jekel
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }

    public function passChange(Request $request)
    {
        $this->validate($request,[
            'password' => 'string',
            'newpassword' => 'string'
        ]);

        $user = User::find(Session::get('id_karyawan'));

        if (Hash::check($request->password, $user->password)) {
            $user->update([
                "password" => Hash::make($request->newpassword),
            ]);

            return redirect()->back()->with(["message" => "Password berhasil diupdate!"]);
        }else{
            return redirect()->back()->with(["message-danger" => "Password lama tidak sesuai!"]);
        }
    }
}
