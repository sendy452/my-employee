<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }  
       
 
    public function signin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')->where('email',$email)->where('tb_karyawan.is_active',1)->first();
        if($data){ 
            if(Hash::check($password,$data->password) && $data->id_role == 1){
                Auth::loginUsingId($data->id_karyawan);
                Session::put('id_karyawan',$data->id_karyawan);
                Session::put('nama',$data->nama);
                Session::put('bidang',$data->bidang);
                Session::put('login',TRUE);
                return redirect('/');
            }
            else if(Hash::check($password,$data->password) && $data->id_role != 1){
                return redirect('signin')->with('message','Akun tidak diberi hak akses');
            }else{
                return redirect('signin')->with('message','Email atau Password salah!');
            }
        }
        else{
            return redirect('signin')->with('message','Email atau Password salah!');
        }
    } 
 
    public function signout() {
        Session::flush();
        Auth::logout();

        return redirect('signin');
    }
}
