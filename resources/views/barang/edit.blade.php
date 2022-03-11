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
                    <h1>Data Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/barang">Data Barang</a></li>
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
                    <h2 class="card-title"><b>Edit Data Barang</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/barang/{{$barang->kode_barang}}/update" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input name="kode_barang" type="text" class="form-control" id="kode_barang" aria-describedby="kode_barang" placeholder="Masukkan Kode Barang" value="{{$barang->kode_barang}}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input name="nama_barang" type="text" class="form-control" id="nama_barang" aria-describedby="kode_barang" placeholder="Masukkan Nama Barang" value="{{$barang->nama_barang}}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Merek</label>
                            <input name="merek" type="text" class="form-control" id="merek" aria-describedby="merek" placeholder="Masukkan Nama Merek" value="{{$barang->merek}}">
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input name="satuan" type="text" class="form-control" id="satuan" aria-describedby="satuan" placeholder="Masukkan Satuan" value="{{$barang->satuan}}">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_beli" class="form-label">Jumlah Beli</label>
                            <input name="jumlah_beli" type="text" class="form-control" id="jumlah_beli" aria-describedby="jumlah_beli" placeholder="Masukkan jumlah_beli" value="{{$barang->jumlah_beli}}">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <input name="kondisi" type="text" class="form-control" id="kondisi" aria-describedby="kondisi" placeholder="Masukkan Nama Barang" value="{{$barang->kondisi}}">
                        </div> --}}
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select name="kondisi" id="kondisi" class="form-select">
                                <option value="">--Pilih kondisi--</option>
                                <option >Baru</option>
                                <option >Bekas</option>
                                <option >Rusak</option>
                            </select>
                        </div>
                        <div class=" mb-3">
                            <label for="jenis_barang" class="form-label">Jenis Barang</label>
                            <select name="jenis_barang" id="kategori" class="form-control">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($jenis as $j)
                                <option {{ $barang->jenis_barang == $j->id_jenis_barang ? 'selected':''}} value="<?= $j->id_jenis_barang ?>">{{$j->jenis_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Beli</label>
                            <input name="tanggal_masuk" type="date" class="form-control" id="tanggal_masuk" aria-describedby="tanggal_masuk" placeholder="Pilih Tanggal" value="{{$barang->tanggal_masuk}}">
                        </div>
                        <div class=" mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input name="harga_beli" type="int" class="form-control" id="harga_beli" aria-describedby="harga_beli" placeholder="Masukkan Harga Beli" value="{{$barang->harga_beli}}">
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input name="gambar" type="file" class="form-control" id="gambar" aria-describedby="gambar" >
                        </div>
                        <button type=" submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection