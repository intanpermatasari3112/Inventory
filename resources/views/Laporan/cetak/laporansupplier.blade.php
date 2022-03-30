@extends('layouts.cetak')

@push('judul')
<h2>Laporan Supplier</h2>
@endpush

@section('content')
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
@endsection