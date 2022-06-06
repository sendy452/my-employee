@extends('layouts.template')
@section('title', 'List Role')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Master Role</li>
          <li class="breadcrumb-item active">List Role</li>
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
              <h5 class="card-title">Tambah Role</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('add.role') }}">
                @csrf

                <div class="row mb-3">
                    <label for="inputIDRole" class="col-sm-2 col-form-label">ID Role</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="id_role">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNamaRole" class="col-sm-2 col-form-label">Nama Role</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="role">
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Role</button>
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
                <h5 class="card-title">List Data Karyawan</h5>
  
                <!-- Default Table -->
                <table class="table table-bordered dataTable" id="table">

                  <thead>
                    <tr>
                      <th scope="col">ID Role</th>
                      <th scope="col">Nama Role</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($role as $data)
                    <tr>
                      <th scope="row">{{$data->id_role}}</th>
                      <td style="width: 80%">{{$data->role}}</td>
                      <td><a href="{{url('hapus-role').'/'.$data->id_role}}" class="btn btn-danger" type="button">Hapus Role</a></td>
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