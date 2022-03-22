@extends('layouts.main')

@section('content')
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
                    <h1>Data Stok Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/stok">Data Stok Barang</a></li>
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
                    <h2 class="card-title"><b>Edit Data Stok Barang</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/stok/{{$stok->kodeStok}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="kodeStok" class="form-label">Kode Stok</label>
                            <input name="kodeStok" type="text" class="form-control" id="kodeStok" aria-describedby="kodeStok" placeholder="Masukkan Kode Barang" value="{{$stok->kodeStok}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <select name="kode_barang" id="kode_barang" class="form-control">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($barang as $b)
                                <option {{$stok->kode_barang == $b->kode_barang ? 'selected':''}} value="<?= $b->kode_barang ?>">{{$b->kode_barang}} - {{$b->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="batasMin" class="form-label">Batas Minimal</label>
                            <input name="batasMin" type="text" class="form-control" id="batasMin" aria-describedby="batasMin" placeholder="Masukkan Batas Minimal Barang" value="{{$stok->batasMin}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok Barang</label>
                            <input name="stok" type="text" class="form-control" id="stok" aria-describedby="stok" placeholder="Masukkan Stok Barang" value="{{$stok->stok}}" readonly>
                        </div>
                        <button type=" submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection