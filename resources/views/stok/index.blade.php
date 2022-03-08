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
                    <h1>Data Stok</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Stok</li>
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
                <div class="row">
                    <div class="col-12">
                        <h2 class="card-title">Data Stok</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Stok
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/stok/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="kodeStok" class="form-label">Kode Stok</label>
                                                <input name="kodeStok" type="text" class="form-control" id="kodeStok" aria-describedby="kodeStok" placeholder="Masukkan Kode Stok">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                                <select name="kode_barang" id="kode_barang" class="form-control">
                                                    <option value="">-- Silahkan pilih satu --</option>
                                                    @foreach($barang as $b)
                                                    <option value="<?= $b->kode_barang ?>">{{$b->kode_barang}} - {{$b->nama_barang}}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="batasMin" class="form-label">Batas Minimal</label>
                                                <input name="batasMin" type="text" class="form-control" id="batasMin" aria-describedby="batasMin" placeholder="Masukkan Batas Minimal Barang">
                                            </div>
                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok Barang</label>
                                                <input name="stok" type="text" class="form-control" id="stok" aria-describedby="stok" placeholder="Masukkan Stok Barang">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover myTable">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Kode Stok Barang</th>
                            <th>Nama Barang</th>
                            <th>Batas Minimal</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_stok as $stok)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$stok->kodeStok}}</td>
                            <td>{{$stok->barang ? $stok->barang->nama_barang:''}}</td>
                            <td>{{$stok->batasMin}}</td>
                            <td>{{$stok->stok}}</td>
                            <td><a href="/stok/{{$stok->kodeStok}}/edit" class="btn btn-warning btn-sm">Ubah
                                    <a href="/stok/{{$stok->kodeStok}}/delete" class="btn btn-danger btn-sm">Hapus</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection