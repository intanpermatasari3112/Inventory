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
                    <h1>Data Supplier Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/barang">Data Supplier Barang</a></li>
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
                    <h2 class="card-title"><b>Edit Data Supplier</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/supplier/{{$supplier->id_supplier}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="id_supplier" class="form-label">ID Supplier</label>
                            <input name="id_supplier" type="text" class="form-control" id="id_supplier" aria-describedby="id_supplier" placeholder="Masukkan Id Supplier" value="{{$supplier->id_supplier}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Kode Jenis</label>
                            <input name="nama_supplier" type="text" class="form-control" id="nama_supplier" aria-describedby="nama_supplier" placeholder="Masukkan Nama Supplier" value="{{$supplier->nama_supplier}}">
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Jenis Barang</label>
                            <input name="kontak" type="text" class="form-control" id="kontak" aria-describedby="kontak" placeholder="Masukkan Kontak Supplier" value="{{$supplier->kontak}}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Supplier</label>
                            <input name="alamat" type="text" class="form-control" id="alamat" aria-describedby="alamat" placeholder="Masukkan Alamat Supplier" value="{{$supplier->alamat}}">
                        </div>
                        <button type=" submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection