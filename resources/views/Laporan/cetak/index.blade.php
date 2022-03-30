@extends('layouts.cetak')

@push('judul')
<h2>Laporan Barang Keluar</h2>
@endpush

@section('content')
<table class="table">
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
  <tfoot>
    <th></th>
    <th colspan="6">Jumlah Pengeluaran</th>
    <th>
      @php $tot = 0; @endphp
      @foreach($data_barang as $barang)
      @php
      $tot += $barang->harga_beli * ($barang->stok ? $barang->stok->sum('stok'): 0);
      @endphp
      @endforeach
      Rp {{ number_format($tot, 0, ',', '.') }}
    </th>
  </tfoot>
</table>
@endsection