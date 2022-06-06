<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function listDivisi()
    {
        $divisi = Divisi::orderBy('nama_divisi','asc')->get();
       
        return view('list-divisi', ['divisi' => $divisi]);
    }

    public function addDivisi(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'bidang' => 'string|unique:tb_divisi,bidang',
        ],[
            'bidang.unique' => 'Bidang telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Divisi::create([
            'nama_divisi' => $request->nama_divisi,
            'bidang' => $request->bidang
        ]);

        return redirect()->back()->with("message", "Divisi berhasil ditambahkan!");
    }    

    public function deleteDivisi($iddivisi)
    {
        $divisi = Divisi::find($iddivisi);

        $divisi->update([
            'is_active' => 0
        ]);

        return redirect()->back()->with("message", "Divisi berhasil dihapus!");
    }   
    
    public function activateDivisi($iddivisi)
    {
        $divisi = Divisi::find($iddivisi);

        $divisi->update([
            'is_active' => 1
        ]);

        return redirect()->back()->with("message", "Divisi berhasil dihapus!");
    }   
    public function changeDivisi(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'bidang' => 'string|unique:tb_divisi,bidang,'.$request->id_divisi.',id_divisi',
        ],[
            'bidang.unique' => 'Bidang telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        $divisi = Divisi::find($request->id_divisi);

        $divisi->update([
            'nama_divisi' => $request->nama_divisi,
            'bidang' => $request->bidang
        ]);

        return redirect()->back()->with("message", "Divisi berhasil diubah!");
    }
}
