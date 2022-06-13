@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Laporan Supplier</h1>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Laporan Supplier</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('/laporansupplier/cetak') }}" target="_blank" class="btn btn-outline-success">Cetak Laporan</a>
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
                        <h2 class="card-title">Laporan Data Supplier</h2>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection