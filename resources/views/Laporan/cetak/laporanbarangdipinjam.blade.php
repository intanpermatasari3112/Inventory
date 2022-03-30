@extends('layouts.cetak')

@push('judul')
<h2>Laporan Barang Dipinjam</h2>
@endpush

@section('content')
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
@endsection