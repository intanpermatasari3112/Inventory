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
                    <h1>Data Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Barang Keluar</li>
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
                        <h2 class="card-title">Data Barang Keluar</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Barang Keluar
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Keluar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/barangkeluar/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="kode_barang_keluar" class="form-label">Kode Barang Keluar</label>
                                                <input name="kode_barang_keluar" type="text" class="form-control" id="kode_barang_keluar" aria-describedby="kode_barang_keluar" placeholder="Masukkan Kode Barang Keluar">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                                <select name="jenis_barang" id="kategori" class="form-control">
                                                    <option value="">-- Silahkan pilih satu --</option>
                                                    @foreach($barang as $j)
                                                    <option value="<?= $j->id_jenis_barang ?>">{{$j->jenis_barang}}</option>
                                                    @endforeach
                                                </select>
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
                                                <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                                                <input name="tanggal_keluar" type="date" class="form-control" id="tanggal_keluar" aria-describedby="tanggal_keluar" placeholder="Pilih Tanggal">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input name="jumlah" type="int" class="form-control" id="jumlah" aria-describedby="jumlah" placeholder="Masukkan Jumlah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="pengguna" class="form-label">Pengguna</label>
                                                <input name="pengguna" type="int" class="form-control" id="pengguna" aria-describedby="pengguna" placeholder="Masukkan Pengguna">
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <input name="keterangan" type="int" class="form-control" id="keterangan" aria-describedby="keterangan" placeholder="Keterangan">
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
                            <th>Kode Barang Keluar</th>
                            <th>Kode Barang</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah</th>
                            <th>Pengguna</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_barang_keluar as $barangkeluar)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$barangkeluar->kode_barang_keluar}}</td>
                            <td>{{$barangkeluar->barang ? $barangkeluar->barang->nama_barang:''}}</td>
                            <td>{{$barangkeluar->barang->jenis_barang}}</td>
                            <td>{{barangkeluar->tanggal_keluar}}</td>
                            <td>{{barangkeluar->jumlah}}</td>
                            <td>{{barangkeluar->pengguna}}</td>
                            <td>{{barangkeluar->keterangan}}</td>
                            <td>
                                <a href="{{ url('barangkeluar/'.$barangkeluar->kode_barang_keluar.'/edit') }}" class="btn btn-warning btn-sm">Ubah
                                    <a href="{{ url('barangkeluar/'.$barangkeluar->kode_barang_keluar.'/delete') }}" class="btn btn-danger btn-sm">Hapus
                                        <a href="{{ url('barangkeluar/'.$barangkeluar->kode_barang_keluar.'/cetak') }}" class="btn btn-success btn-sm">Barcode
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </section>
    <!-- /.content -->
</div>
@endsection