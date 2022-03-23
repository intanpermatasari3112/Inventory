@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Laporan Inventaris Barang</h1>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Laporan Inventaris Barang</li>
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
                        <h2 class="card-title">Laporan Data Inventaris Barang</h2>
                    </div>
                 
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <form action="" method="get" class="mt-2">
                                <input type="date" name="dari_tgl" value="{{ request()->dari_tgl }}" class="form-control form-control-sm d-inline" style="width: auto;" id=""> s/d <input type="date" name="sampai_tgl" class="form-control form-control-sm d-inline" value="{{ request()->sampai_tgl }}" style="width: auto;" id="">
                                   {{-- filter as jenis --}}
                              

                              {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('laporan-based-jenis') }}">Laporan all barang</a>
                                @foreach ($jenis as $j)
                                    <a href="{{ url('laporan-based-jenis?jenis-barang='. $j->id_jenis_barang) }}" class="dropdown-item">{{ $j->jenis_barang }}</a>
                                @endforeach
                              </div> --}}
                              <select name="jenis" class=" form-control-sm d-inline">
                                  <option value="">--Pilih Jenis--</option>
                                  @foreach ($jenis as $j)
                                  <option value="{{ $j->id_jenis_barang }}">{{ $j->jenis_barang }}</option>
                              @endforeach
                              </select>
                              <button class="btn btn-sm btn-success" type="submit">Lihat</button>
                             
                              {{-- end filter as jenis --}}
                            </form>
                         
                            <div>
                                @php $tot = 0; @endphp
                                @foreach($data_barang as $barang)
                                    @php
                                    $tot += $barang->harga_beli * ($barang->stok ? $barang->stok->sum('stok'): 0);
                                    @endphp
                                @endforeach
                                <h4>Jumlah Pengeluaran :  Rp {{ number_format($tot, 0, ',', '.') }}</h4>
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
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Tanggal Masuk</th>
                            <th>Harga Beli</th>
                            <th>Stok</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_barang as $barang)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$barang->kode_barang}}</td>
                            <td>{{$barang->nama_barang}}</td>
                            <td>{{$barang->jenis->jenis_barang}}</td>
                            <td>{{$barang->tanggal_masuk}}</td>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>{{$barang->stok ? $barang->stok->sum('stok'): 0}}</td>
                            <td>Rp {{ number_format($barang->harga_beli * ($barang->stok ? $barang->stok->sum('stok'): 0), 0, ',', '.') }}</td>
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