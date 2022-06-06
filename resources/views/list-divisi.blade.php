@extends('layouts.template')
@section('title', 'List Divisi')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Data Divisi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Master Divisi</li>
          <li class="breadcrumb-item active">List Data Divisi</li>
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
              <h5 class="card-title">Tambah Divisi</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('add.divisi') }}">
                @csrf

                <div class="row mb-3">
                    <label for="inputDivisi" class="col-sm-2 col-form-label">Nama Divisi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_divisi">
                    </div>
                </div>
                <div class="row mb-3" style="flex-wrap: nowrap;">
                  <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bidang">
                  </div>
                </div>
                
                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Divisi</button>
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
                <h5 class="card-title">List Data Divisi</h5>
  
                <!-- Default Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Divisi</th>
                      <th scope="col">Bidang</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>        
                    
                    @foreach($divisi as $no => $data)
                    <tr>          
                      <form method="post" action="{{ route('change.divisi') }}">
                      @csrf
                      @method("PUT")          
                      
                      <th scope="row"><input type="text" class="form-control" name="id_divisi" value="{{$data->id_divisi}}" hidden>{{$no+1}}</th>
                      <td><input type="text" class="form-control" name="nama_divisi" value="{{$data->nama_divisi}}"></td>
                      <td><input type="text" class="form-control" name="bidang" value="{{$data->bidang}}"></td>
                      <td><button type="submit" class="btn btn-success">Ubah</button> <a href="{{url('hapus-divisi').'/'.$data->id_divisi}}" class="btn btn-danger" type="button">Hapus</a></td>
                      
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
      </section>

  </main>