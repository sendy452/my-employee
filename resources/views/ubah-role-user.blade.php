@extends('layouts.template')
@section('title', 'Ubah Role User')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ubah Role User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Master Role</li>
          <li class="breadcrumb-item active">Ubah Role User</li>
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
              <h5 class="card-title">Cari Data User</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ url('ubah-role-user') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Nama User</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option><h1>-----Pilih Karyawan-----</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id_karyawan}}">{{$data->nama}}</option>
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
                  <h5 class="card-title">Ubah Data User</h5>
    
                  <!-- Ubah Data Karyawan Form -->
                  <form class="row g-3" method="post" action="{{ route('change.role') }}">
                    @csrf
                    @method("PUT")

                    @foreach($bio as $data)
                    <div class="col-md-12">
                      <label for="inputName" class="form-label">Nama Lengkap</label>
                      <input name="id_karyawan" type="text" class="form-control" value="{{$data->id_karyawan}}" hidden>
                      <input name="nama" type="text" class="form-control" value="{{$data->nama}}" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputNIK" class="form-label">NIK/KTP</label>
                      <input name="nik" type="number" class="form-control" value="{{$data->nik}}" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputNIP" class="form-label">NIP</label>
                      <input name="nip" type="text" class="form-control" value="{{$data->nip}}" disabled>
                    </div>
                    <div class="col-12">
                      <label for="inputEmail" class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" value="{{$data->email}}" disabled>
                    </div>
                    <div class="col-12">
                      <label for="inputNoHP" class="form-label">No HP</label>
                      <input name="nohp" type="number" class="form-control" value="{{$data->nohp}}" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputTLahir" class="form-label">Tempat Lahir</label>
                      <input name="tlahir" type="text" class="form-control" value="{{$data->tlahir}}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="inputTglLahir" class="form-label">Tanggal Lahir</label>
                        <input name="tgllahir" type="date" class="form-control" value="{{$data->tgllahir}}" disabled>
                    </div>
                    <div class="col-md-6">
                      <label for="inputAlamat" class="form-label">Alamat</label>                    
                      <textarea name="alamat" class="form-control" disabled>{{$data->alamat}}</textarea>                      
                    </div>
                    <div class="col-md-6">
                      <label for="inputNegara" class="form-label">Negara</label>
                      <input name="negara" type="text" class="form-control" value="{{$data->negara}}" disabled>
                    </div>
                    <div class="col-md-2">
                        <label for="Jenis Kelamin" class="form-label">Jenis Kelamin</label>                        
                        <select class="form-select" name="jekel" disabled>
                            <option value="Laki-Laki" {{ $data->jekel == "Laki-Laki" ? "selected" : "" }} >Laki-Laki</option>
                            <option value="Perempuan" {{ $data->jekel == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                        </select>                       
                    </div>
                    <div class="col-md-8">
                      <label for="inputtDivisi" class="form-label">Divisi</label>
                      <select class="form-select" name="id_divisi" disabled>
                          <option></option>
                          @foreach($divisi as $divisi)
                          <option value="{{$divisi->id_divisi}}" {{ $divisi->id_divisi == $data->id_divisi ? "selected" : "" }}>{{$divisi->nama_divisi}} - {{$divisi->bidang}}</option>
                          @endforeach
                      </select>     
                    </div>
                    <div class="col-md-2">
                      <label for="inputRole" class="form-label">Role Akun</label>
                      <select class="form-select" name="id_role">
                          @foreach($role as $role)
                          <option value="{{$role->id_role}}" {{ $role->id_role == $data->id_role ? "selected" : "" }}>{{$role->role}}</option>
                          @endforeach
                      </select>
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