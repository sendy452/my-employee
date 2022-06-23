<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kinerja;
use App\Models\Kategori;
use App\Models\Keahlian;
use App\Models\Divisi;
use Illuminate\Support\Facades\Validator;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function listKinerja()
    {
        $kinerja = Kinerja::where('is_active',1)->orderBy('id_kategori','asc')->get();
        $kategori = Kategori::get();

        return view('list-kinerja', ['kinerja' => $kinerja, 'kategori' => $kategori]);
    }

    public function addKategori(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'kategori' => 'string|unique:tb_kategori,kategori',
        ],[
            'kategori.unique' => 'Kategori telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Kategori::create([
            'kategori' => $request->kategori,
            'bobot' => $request->bobot
        ]);

        return redirect()->back()->with("message", "Kategori berhasil ditambahkan!");
    }    

    public function changeKategori(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'kategori' => 'string|unique:tb_kategori,kategori',
        ],[
            'kategori.unique' => 'Kategori telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        $kategori = Kategori::find($request->id_kategori);

        $kategori->update([
            'kategori' => $request->kategori,
            'bobot' => $request->bobot
        ]);

        return redirect()->back()->with("message", "Kategori berhasil diubah!");
    }    

    public function deleteKategori($idkategori)
    {
        $kategori = Kategori::find($idkategori);

        $kategori->delete();

        return redirect()->back()->with("message", "Kategori berhasil dihapus!");
    }

    public function addKinerja(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'kinerja' => 'string|unique:tb_kinerja,kinerja',
        ],[
            'kinerja.unique' => 'Kinerja telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Kinerja::create([
            'kinerja' => $request->kinerja,
            'id_kategori' => $request->id_kategori,
            'bobot' => $request->bobot,
            'target' => $request->target
        ]);

        return redirect()->back()->with("message", "Penilaian kinerja berhasil ditambahkan!");
    }    

    public function deleteKinerja($idkinerja)
    {
        $kinerja = Kinerja::find($idkinerja);

        $kinerja->update([
            'is_active' => 0
        ]);

        return redirect()->back()->with("message", "Penilaian kinerja berhasil dihapus!");
    }   
    
    public function changeKinerja(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'kinerja' => 'string|unique:tb_kinerja,kinerja,'.$request->id_kinerja.',id_kinerja',
        ],[
            'kinerja.unique' => 'Kinerja telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        $kinerja = Kinerja::find($request->id_kinerja);

        $kinerja->update([
            'kinerja' => $request->kinerja,
            'id_kategori' => $request->id_kategori,
            'bobot' => $request->bobot,
            'target' => $request->target
        ]);

        return redirect()->back()->with("message", "Penilaian kinerja berhasil diubah!");
    }


    public function listKeahlian(Request $request)
    {
        $keahlian = Keahlian::leftJoin('tb_divisi', 'tb_keahlian.id_divisi', '=', 'tb_divisi.id_divisi')->where('tb_keahlian.is_active',1)->where('tb_keahlian.id_divisi', $request->id_divisi)->get();
        $divisi = Divisi::orderBy('nama_divisi','asc')->get();
       
        

        return view('list-keahlian', ['keahlian' => $keahlian, 'divisi' => $divisi]);
    }

    public function addKeahlian(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'keahlian' => 'string|unique:tb_keahlian,keahlian,nul,id_keahlian,id_divisi,'.$request->id_divisi,
        ],[
            'keahlian.unique' => 'Keahlian telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Keahlian::create([
            'keahlian' => $request->keahlian,
            'id_divisi' => $request->id_divisi,
            'bobot' => $request->bobot
        ]);

        return redirect()->back()->with("message", "Penilaian keahlian berhasil ditambahkan!");
    }    

    public function deleteKeahlian($idkeahlian)
    {
        $keahlian = Keahlian::find($idkeahlian);

        $keahlian->update([
            'is_active' => 0
        ]);

        return redirect()->back()->with("message", "Penilaian keahlian berhasil dihapus!");
    }   
    
    public function changeKeahlian(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'keahlian' => 'string|unique:tb_keahlian,keahlian,'.$request->id_keahlian.',id_keahlian,id_divisi,'.$request->id_divisi,
        ],[
            'keahlian.unique' => 'Keahlian telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        $keahlian = Keahlian::find($request->id_keahlian);

        $keahlian->update([
            'keahlian' => $request->keahlian,
            'bobot' => $request->bobot
        ]);

        return redirect()->back()->with("message", "Penilaian keahlian berhasil diubah!");
    }
}
