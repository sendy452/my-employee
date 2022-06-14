<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index()
    {
        $role = Role::get();

        return view('list-role', ['role' => $role]);
    }

    public function addRole(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'id_role' => 'numeric|unique:tb_role,id_role',
            'role' => 'string|unique:tb_role,role',
        ],[
            'id_role.unique' => 'ID Role telah didaftarkan sebelumnya.',
            'role.unique' => 'Role telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Role::create([
            'id_role' => $request->id_role,
            'role' => $request->role
        ]);

        return redirect()->back()->with("message", "Role berhasil ditambahkan!");
    }    

    public function ubahRoleUser(Request $request)
    {
        $karyawan = User::orderBy('email','asc')->get();
        $divisi = Divisi::get();
        $role = Role::get();
        $bio = "";

        if ($request != "") {

            $bio = User::leftJoin('tb_divisi', 'tb_karyawan.id_divisi', '=', 'tb_divisi.id_divisi')
            ->leftJoin('tb_role', 'tb_karyawan.id_role', '=', 'tb_role.id_role')->where('id_karyawan',$request->idkaryawan)->get();
        }
        
        return view('ubah-role-user', ['karyawan' => $karyawan,'bio' => $bio, 'divisi' => $divisi, 'role' => $role]);
    }

    public function changeRole(Request $request)
    {        
        $user = User::find($request->id_karyawan);

        $user->update([
            'id_role' => $request->id_role
        ]);

        return redirect()->back()->with("message", "Role berhasil diupdate!");
    }

    public function deleteRole($idrole)
    {
        $role = Role::find($idrole);

        $role->delete();

        return redirect()->back()->with("message", "Role berhasil dihapus!");
    }
}
