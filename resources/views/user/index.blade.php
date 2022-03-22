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
                    <h1>Data User</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data User</li>
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
                        <h2 class="card-title">Data User</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah User
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/user/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="id" class="form-label">ID Karyawan</label>
                                                <input name="id" type="text" class="form-control" value="{{$nextid}}" id="id" aria-describedby="id" placeholder="Masukkan ID Karyawan" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Karyawan</label>
                                                <input name="name" type="text" class="form-control" id="nama" aria-describedby="nama" placeholder="Masukkan Nama Karyawan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <select name="jabatan" id="jabatan" class="form-select">
                                                    <option value="">--Pilih Jabatan--</option>
                                                    <option value="MANAGER">Manager</option>
                                                    <option value="KARYAWAN">Karyawan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input name="email" type="text" class="form-control" id="username" aria-describedby="username" placeholder="Masukkan Username">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input name="password" type="password" class="form-control" id="password" aria-describedby="password" placeholder="Masukkan Password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="level" class="form-label">Level</label>
                                                <select name="level" id="level" class="form-select">
                                                    <option value="">--Pilih Level--</option>
                                                    <option value="ADMIN">Administrator</option>
                                                    <option value="MANAGER">Manager</option>
                                                    <option value="PENGGUNA">Pengguna</option>
                                                </select>
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
                            <th>ID Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan Karyawan</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
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
                            <td><a href="/user/{{$user->id}}/edit" class="btn btn-warning btn-sm">Ubah
                                    <a href="/user/{{$user->id}}/delete" class="btn btn-danger btn-sm">Hapus</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </section>
    <!-- /.content -->
</div>
@endsection