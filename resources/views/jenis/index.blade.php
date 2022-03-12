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
                        <li class="breadcrumb-item active">Data Jenis Barang</li>
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
                        <h2 class="card-title">Data Jenis Barang</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Jenis Barang
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/jenis/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="id_jenis_barang" class="form-label">ID Jenis Barang</label>
                                                <input name="id_jenis_barang" type="text" class="form-control" value="{{$nextid}}" id="id_jenis_barang" aria-describedby="id_jenis_barang" placeholder="Masukkan ID Jenis Barang" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_jenis" class="form-label">Kode Jenis</label>
                                                <input name="kode_jenis" type="text" class="form-control" id="kode_jenis" aria-describedby="kode_jenis" placeholder="Masukkan Kode Jenis">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                                <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" aria-describedby="kode_barang" placeholder="Masukkan Nama Jenis Barang">
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
                            <th>ID Jenis Barang </th>
                            <th>Kode Jenis</th>
                            <th>Jenis Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_jenis as $jenis)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$jenis->id_jenis_barang}}</td>
                            <td>{{$jenis->kode_jenis}}</td>
                            <td>{{$jenis->jenis_barang}}</td>
                            <td><a href="/jenis/{{$jenis->id_jenis_barang}}/edit" class="btn btn-warning btn-sm">Ubah
                                    <a href="/jenis/{{$jenis->id_jenis_barang}}/delete" class="btn btn-danger btn-sm">Hapus</td>
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