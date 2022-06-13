@extends('layouts.main')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $jumlahBarang }}</h3>

              <p>Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $jumlahBarangKeluar }}</h3>

              <p>Barang Dipinjam</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/barangkeluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $jumlahUser }}</h3>
              {{-- <h3>{{  select COUNT (name) from }}</h3> --}}
              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3> {{ $jumlahStok }}</h3>

              <p>Stok Akan Habis</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/stok" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12">
            <h2 class="card-title">Data Stok</h2>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover myTable">
          <thead>
            <tr align="center">
              <th>No</th>
              <th>Nama Barang</th>
              <th>Batas Minimal</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody>
            @php $no = 1; @endphp
            @foreach($data_stok as $stok)
            <tr {{ ($stok->stok<$stok->batasMin ? "class=bg-danger":'') }} align="center">
              <td>{{$no++}}</td>
              <td>{{$stok->barang ? $stok->barang->nama_barang:''}}</td>
              <td>{{$stok->batasMin}}</td>
              <td>{{$stok->stok}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12">
            <h2 class="card-title">Data Barang Dipinjam</h2>
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
                <button type="button" class="btn btn-peminjaman btn-warning btn-sm" data-kodebarangkeluar="{{$barangkeluar->kode_barang_keluar}}" data-jenis="{{$barangkeluar->jenis}}" data-kodebarang="{{$barangkeluar->nama_barang}}" data-namabarang="{{$barangkeluar->nama_barang}}" data-email="{{$barangkeluar->email}}" data-tanggalkeluar="{{$barangkeluar->tanggal_keluar}}" data-alasanpinjam="{{$barangkeluar->alasan_pinjam}}" data-jumlah="{{$barangkeluar->jumlah}}">Peminjaman</button>
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('js')
<script>
  $(document).ready(function() {
    $('select[name=kode_barang]').change(function() {
      $('input[name=stok]').val($(this).find(':selected').data('jumlahbeli'));
    })
  });
</script>
@endpush