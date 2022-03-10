@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
                </div>
                @endif
                <div class="col-sm-6">
                    <h1>Data Jenis Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/barang">Data Jenis Barang</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="col-6">
                    <h2 class="card-title"><b>Edit Data Jenis Barang</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/jenis/{{$jenis->id_jenis_barang}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="id_jenis_barang" class="form-label">ID Jenis Barang</label>
                            <input name="id_jenis_barang" type="text" class="form-control" id="id_jenis_barang" aria-describedby="id_jenis_barang" placeholder="Masukkan ID Jenis Barang" value="{{$jenis->id_jenis_barang}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kode_jenis" class="form-label">Kode Jenis</label>
                            <input name="kode_jenis" type="text" class="form-control" id="kode_jenis" aria-describedby="kode_jenis" placeholder="Masukkan ID Jenis Barang" value="{{$jenis->kode_jenis}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_barang" class="form-label">Jenis Barang</label>
                            <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" aria-describedby="jenis_barang" placeholder="Masukkan jenis Barang" value="{{$jenis->jenis_barang}}">
                        </div>
                        <button type=" submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection