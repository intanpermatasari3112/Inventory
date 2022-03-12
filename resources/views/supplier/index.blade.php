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
                        <li class="breadcrumb-item active">Data Supplier Barang</li>
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
                        <h2 class="card-title">Data Supplier Barang</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Supplier Barang
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/supplier/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="id_supplier" class="form-label">ID Supplier Barang</label>
                                                <input name="id_supplier" type="text" class="form-control" value="{{$nextid}}" id="id_supplier" aria-describedby="id_supplier" placeholder="Masukkan ID Supplier " readonly>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="nama_supplier" class="form-label">Nama Supplier Barang</label>
                                                <input name="nama_supplier" type="text" class="form-control" id="nama_supplier" aria-describedby="nama_supplier" placeholder="Masukkan Nama Supplier">
                                            </div>

                                            <div class="mb-3">
                                                <label for="kontak" class="form-label">Kontak Supplier</label>
                                                <input name="kontak" type="text" class="form-control" id="kontak" aria-describedby="kontak" placeholder="Masukkan Kontak Supplier">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat Supplier</label>
                                                <input name="alamat" type="text" class="form-control" id="alamat" aria-describedby="alamat" placeholder="Masukkan Alamat Supplier">
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
                            <th>ID Supplier Barang</th>
                            <th>Nama Supplier Barang</th>
                            <th>Kontak Supplier</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_supplier as $supplier)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$supplier->id_supplier}}</td>
                            <td>{{$supplier->nama_supplier}}</td>
                            <td>{{$supplier->kontak}}</td>
                            <td>{{$supplier->alamat}}</td>
                            <td><a href="/supplier/{{$supplier->id_supplier}}/edit" class="btn btn-warning btn-sm">Ubah
                                    <a href="/supplier/{{$supplier->id_supplier}}/delete" class="btn btn-danger btn-sm">Hapus</td>
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