@extends('layouts.template')
@section('title', 'List Penilaian Kinerja')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Penilaian Kinerja</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Master Penilaian</li>
          <li class="breadcrumb-item active">List Penilaian Kinerja</li>
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

    <!--section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Kategori Penilaian Kinerja</h5>

              <form method="post" action="{{ route('add.kategori') }}">
                @csrf

                <div class="row mb-3">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kategori">
                    </div>
                </div>
                <div class="row mb-3" style="flex-wrap: nowrap;">
                  <label for="inputBobot" class="col-sm-2 col-form-label">Bobot</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" name="bobot">
                        <span class="input-group-text"><i class="bi bi-percent"></i></span>
                    </div>
                  </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>
    </section-->
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Kategori Penilaian Kinerja</h5>
  
                <div class="table-responsive">
                <!-- Default Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Kategori Penilaian</th>
                      <th scope="col">Bobot (%)</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    @foreach($kategori as $no => $data)
                    <tr>          
                      <form method="post" action="{{ route('change.kategori') }}">
                      @csrf
                      @method("PUT")          
                      
                      <th scope="row"><input type="text" class="form-control" name="id_kategori" value="{{$data->id_kategori}}" hidden>{{$no+1}}</th>
                      <td><input style="width: auto;" type="text" class="form-control" name="kategori" value="{{$data->kategori}}"></td>
                      <td><input type="number" class="form-control" name="bobot" value="{{$data->bobot}}"></td>
                      <td><button type="submit" class="btn btn-success">Ubah</button> <!--a href="{{url('hapus-kategori').'/'.$data->id_kategori}}" class="btn btn-danger" type="button">Hapus</a--></td>
                      
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

      <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tambah Penilaian Kinerja</h5>
  
                <!-- General Form Elements -->
                <form method="post" action="{{ route('add.kinerja') }}">
                  @csrf
  
                  <div class="row mb-3">
                      <label for="inputKategori" class="col-sm-2 col-form-label">Nama Kinerja</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="kinerja">
                      </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputtKategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                    <select class="form-select" name="id_kategori">
                        @foreach($kategori as $data)
                        <option value="{{$data->id_kategori}}">{{$data->kategori}}</option>
                        @endforeach
                    </select>     
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputtDivisi" class="col-sm-2 col-form-label">Penilaian Jabatan</label>
                    <div class="col-sm-10">
                    <select class="form-select" name="id_divisi">
                        @foreach($divisi as $data)
                        <option value="{{$data->id_divisi}}">{{$data->nama_divisi.' - '.$data->bidang}}</option>
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
                  <div class="row mb-3">
                    <label for="inputKategori" class="col-sm-2 col-form-label">Target</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="target" placeholder="100" min="1" max="100">
                    </div>
                </div>
                  
                  <div class="row mb-3 text-end">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary">Tambah Kinerja</button>
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
                <h5 class="card-title">List Penilaian Kinerja Tiap Jabatan</h5>
  
                <!-- General Form Elements -->
                <form method="post" action="{{ url('list-kinerja') }}">
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
                      <button type="submit" class="btn btn-primary">Tampilkan Kinerja</button>
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
                  <h5 class="card-title">List Penilaian Kinerja</h5>
    
                  <div class="table-responsive">
                  <!-- Default Table -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Penilaian Kinerja</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penilaian Jabatan</th>
                        <th scope="col">Bobot (%)</th>
                        <th scope="col">Target</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>               
                      
                      @foreach($kinerja as $no => $kinerja)
                      <tr>   
                        <form method="post" action="{{ route('change.kinerja') }}">
                        @csrf
                        @method("PUT")     

                        <th scope="row"><input type="text" class="form-control" name="id_kinerja" value="{{$kinerja->id_kinerja}}" hidden>{{$no+1}}</th>
                        <td><input type="text" style="width: auto;" class="form-control" name="kinerja" value="{{$kinerja->kinerja}}"></td>
                        <td>
                            <select style="width: auto;" class="form-select" name="id_kategori">
                                @foreach($kategori as $data)
                                <option value="{{$data->id_kategori}}" {{ $data->id_kategori == $kinerja->id_kategori ? "selected" : "" }}>{{$data->kategori}}</option>
                                @endforeach
                            </select>  
                        </td>
                        <td>{{$kinerja->nama_divisi.' - '.$kinerja->bidang}}</td>
                        <td><input type="number" class="form-control" name="bobot" value="{{$kinerja->bobot}}"></td>
                        <td><input type="number" class="form-control" name="target" value="{{$kinerja->target}}"></td>
                        <td><button type="submit" class="btn btn-success">Ubah</button> <a href="{{url('hapus-kinerja').'/'.$kinerja->id_kinerja}}" class="btn btn-danger" type="button">Hapus</a></td>
                        
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