@extends('layouts.template')
@section('title', 'List Penilaian Keahlian')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Penilaian Keahlian</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Master Penilaian</li>
          <li class="breadcrumb-item active">List Penilaian Keahlian</li>
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
              <h5 class="card-title">Tambah Penilaian Keahlian</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('add.keahlian') }}">
                @csrf

                <div class="row mb-3">
                    <label for="inputKeahlian" class="col-sm-2 col-form-label">Nama Keahlian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="keahlian">
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-sm-2 col-form-label">Divisi Yang Membutuhkan</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="id_divisi">
                      @foreach($divisi as $data)
                      <option value="{{$data->id_divisi}}">{{$data->nama_divisi}} - {{$data->bidang}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputBobot" class="col-sm-2 col-form-label">Bobot</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" name="bobot" min="0" max="100">
                        <span class="input-group-text"><i class="bi bi-percent"></i></span>
                    </div>
                  </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Keahlian</button>
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
              <h5 class="card-title">List Penilaian Keahlian Tiap Jabatan</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ url('list-keahlian') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                  <label for="inputtDivisi" class="col-sm-2 col-form-label">Pilih Jabatan</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="id_divisi">
                      @foreach($divisi as $data)
                      <option value="{{$data->id_divisi}}">{{$data->nama_divisi}} - {{$data->bidang}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tampilkan Keahlian</button>
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
                <h5 class="card-title">List Penilaian Keahlian</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Keahlian</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Bobot (%)</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    @foreach($keahlian as $no => $data)
                    <tr>          
                      <form method="post" action="{{ route('change.keahlian') }}">
                      @csrf
                      @method("PUT")          
                      
                      <th scope="row"><input type="text" class="form-control" name="id_divisi" value="{{$data->id_divisi}}" hidden><input type="text" class="form-control" name="id_keahlian" value="{{$data->id_keahlian}}" hidden>{{$no+1}}</th>
                      <td><input style="width: auto;" type="text" class="form-control" name="keahlian" value="{{$data->keahlian}}"></td>
                      <td>{{$data->nama_divisi}} - {{$data->bidang}}</td>
                      <td><input style="width: auto;" type="number" class="form-control" name="bobot" value="{{$data->bobot}}"></td>
                      <td><button type="submit" class="btn btn-success">Ubah</button> <a href="{{url('hapus-keahlian').'/'.$data->id_keahlian}}" class="btn btn-danger" type="button">Hapus</a></td>
                      
                      </form>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- End Default Table Example -->
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

  </main>