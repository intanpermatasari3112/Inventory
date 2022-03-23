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
                    <h1>Data User</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/barang">Data User</a></li>
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

                <div class="col-6">
                    <h2 class="card-title"><b>Edit Data User</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/user/{{$user->id}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="id" class="form-label">ID Karyawan</label>
                            <input name="id" type="text" class="form-control" id="id" aria-describedby="id" placeholder="Masukkan ID Karyawan" value="{{$user->id}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Karyawan</label>
                            <input name="name" type="text" class="form-control" id="nama" aria-describedby="nama" placeholder="Masukkan Nama Karyawan" value="{{$user->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-select">
                            <option value="">--Pilih Jabatan--</option>
                                <option {{ $user->jabatan == 'MANAGER' ? 'selected':'' }} value="MANAGER">Manager</option>
                                <option {{ $user->jabatan == 'KARYAWAN' ? 'selected':'' }} value="KARYAWAN">Karyawan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input name="email" type="text" class="form-control" id="username" aria-describedby="username" placeholder="Masukkan Username" value="{{$user->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input name="password" type="text" class="form-control" id="password" aria-describedby="password" placeholder="Kosongkan jika tidak ingin mengubah password!">
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" id="level" class="form-select">
                                <option value="">--Pilih Level--</option>
                                <option {{ $user->level == 'ADMIN' ? 'selected':'' }} value="ADMIN">Administrator</option>
                                <option {{ $user->level == 'PENGGUNA' ? 'selected':'' }} value="PENGGUNA">Pengguna</option>
                                <option {{ $user->level == 'MANAGER' ? 'selected':'' }} value="MANAGER">Manager</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection