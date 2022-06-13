@extends('layouts.cetak')

@push('judul')
<h2>Laporan User</h2>
@endpush

@section('content')
<table class="table">
  <thead>
    <tr align="center">
      <th>No</th>
      <th>ID Karyawan</th>
      <th>Nama Karyawan</th>
      <th>Jabatan Karyawan</th>
      <th>Username</th>
      <th>Level</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1; @endphp
    @foreach($data_user as $user)
    <tr align="center">
      <td>{{$no++}}</td>
      <td>{{$user->id}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->jabatan}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->level}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection