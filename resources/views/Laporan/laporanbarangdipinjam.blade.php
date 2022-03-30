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
                    <h1>Laporan Data User</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Barang Dipinjam</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('/laporanbarangdipinjam/cetak') }}" target="_blank" class="btn btn-outline-success">Cetak Laporan</a>
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
                        <h2 class="card-title">Laporan Barang Dipinjam</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover myTable">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Kode Barang Dipinjam</th>
                            <th>Jenis Barang</th>
                            <th>Nama Barang</th>
                            <th>Pengguna</th>
                            <th>Tanggal Dipinjam</th>
                            <th>Jumlah</th>
                            <th>Status Peminjaman</th>
                            <th>Status Pengembalian</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_barang_keluar as $barangkeluar)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$barangkeluar->kode_barang_keluar}}</td>
                            <td>{{$barangkeluar->jenis}}</td>
                            <td>{{$barangkeluar->kode_barang . ' ' . $barangkeluar->nama_barang}}</td>
                            <td>{{$barangkeluar->email}}</td>
                            <td>{{$barangkeluar->tanggal_keluar}}</td>
                            <td>{{$barangkeluar->jumlah}}</td>
                            <td>
                                @if ($barangkeluar->status_pinjam=='DISETUJUI')
                                <span class="badge bg-success"> {{$barangkeluar->status_pinjam}}</span>
                                @elseif($barangkeluar->status_pinjam=='PENDING')
                                <span class="badge bg-secondary"> {{$barangkeluar->status_pinjam}}</span>
                                @else
                                <span class="badge bg-danger"> {{$barangkeluar->status_pinjam}}</span>
                                @endif
                            </td>
                            <td>
                                @if ($barangkeluar->status_kembali=='SUDAH')
                                <span class="badge bg-success"> {{$barangkeluar->status_kembali}}</span>
                                @else
                                <span class="badge bg-secondary"> {{$barangkeluar->status_kembali}}</span>
                                @endif
                            </td>
                            <td>{{$barangkeluar->alasan_pinjam}}</td>
                            <td>
                                @if(Auth::user()->level == 'ADMIN')
                                    @if ($barangkeluar->status_pinjam=='PENDING')
                                    
                                    @endif
                                    @elseif(Auth::user()->level == 'PENGGUNA')
                                    @if ($barangkeluar->status_pinjam=='DISETUJUI' && $barangkeluar->status_kembali == 'BELUM')
                                    <button class="btn btn-pengembalian btn-warning" data-kodebarangkeluar="{{$barangkeluar->kode_barang_keluar}}">Pengembalian</button>
                                    @elseif ($barangkeluar->status_pinjam=='PENDING')
                                    <button class="btn btn-batal-pinjam btn-outline-danger" data-kodebarangkeluar="{{$barangkeluar->kode_barang_keluar}}">Batal</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection