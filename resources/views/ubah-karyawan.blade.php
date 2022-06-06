@extends('layouts.template')
@section('title', 'Ubah Karyawan')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ubah Data Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Data Karyawan</li>
          <li class="breadcrumb-item active">Ubah Data Karyawan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if($errors->any())
        @foreach ($errors->all() as $danger)
              <h6 class="alert alert-danger">{{ $danger }}</h6>
        @endforeach
      @endif
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>
    @endif

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cari Data Karyawan</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ url('ubah-karyawan') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Email Karyawan</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>Pilih Email!</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id_karyawan}}">{{$data->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Pilih Akun</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Ubah Data Karyawan</h5>
    
                  <!-- Ubah Data Karyawan Form -->
                  <form class="row g-3" method="post" action="{{ route('change.user') }}">
                    @csrf
                    @method("PUT")

                    @foreach($bio as $data)
                    <div class="col-md-12">
                      <label for="inputName" class="form-label">Nama Lengkap</label>
                      <input name="id_karyawan" type="text" class="form-control" value="{{$data->id_karyawan}}" hidden>
                      <input name="nama" type="text" class="form-control" value="{{$data->nama}}">
                    </div>
                    <div class="col-md-6">
                      <label for="inputNIK" class="form-label">NIK/KTP</label>
                      <input name="nik" type="number" class="form-control" value="{{$data->nik}}" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputNIP" class="form-label">NIP</label>
                      <input name="nip" type="text" class="form-control" value="{{$data->nip}}" required>
                    </div>
                    <div class="col-12">
                      <label for="inputEmail" class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" value="{{$data->email}}" required>
                    </div>
                    <div class="col-12">
                      <label for="inputNoHP" class="form-label">No HP</label>
                      <input name="nohp" type="number" class="form-control" value="{{$data->nohp}}" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputTLahir" class="form-label">Tempat Lahir</label>
                      <input name="tlahir" type="text" class="form-control" value="{{$data->tlahir}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputTglLahir" class="form-label">Tanggal Lahir</label>
                        <input name="tgllahir" type="date" class="form-control" value="{{$data->tgllahir}}">
                    </div>
                    <div class="col-md-6">
                      <label for="inputAlamat" class="form-label">Alamat</label>                    
                      <textarea name="alamat" class="form-control">{{$data->alamat}}</textarea>                      
                    </div>
                    <div class="col-md-6">
                      <label for="inputNegara" class="form-label">Negara</label>
                      <input name="negara" type="text" class="form-control" value="{{$data->negara}}">
                    </div>
                    <div class="col-md-2">
                        <label for="Jenis Kelamin" class="form-label">Jenis Kelamin</label>                        
                        <select class="form-select" name="jekel">
                            <option value="Laki-Laki" {{ $data->jekel == "Laki-Laki" ? "selected" : "" }}>Laki-Laki</option>
                            <option value="Perempuan" {{ $data->jekel == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                        </select>                       
                    </div>
                    <div class="col-md-8">
                      <label for="inputtDivisi" class="form-label">Divisi</label>
                      <select class="form-select" name="id_divisi">
                          <option></option>
                          @foreach($divisi as $divisi)
                          <option value="{{$divisi->id_divisi}}" {{ $divisi->id_divisi == $data->id_divisi ? "selected" : "" }}>{{$divisi->nama_divisi}} - {{$divisi->bidang}}</option>
                          @endforeach
                      </select>     
                    </div>
                    <div class="col-md-2">
                      <label for="inputRole" class="form-label">Role Akun</label>
                      <input type="text" class="form-control" value="{{$data->role}}" disabled>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    @endforeach
                  </form>
                  <!-- End Ubah Data Karyawan Form -->
    
                </div>
            </div>

          </div>
        </div>
      </section>

  </main>