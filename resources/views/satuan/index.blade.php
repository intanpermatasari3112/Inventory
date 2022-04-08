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
                    <h1>Data Satuan</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Satuan</li>
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
                        <h2 class="card-title">Data Satuan</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Satuan
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Satuan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/satuan/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="id_jenis" class="form-label">Jenis</label>
                                                <select multiple name="id_jenis[]" id="kategori" class="form-select d-block select2">
                                                    <option value="">-- Silahkan pilih satu --</option>
                                                    @php $jeniss = $jenis->get() @endphp
                                                    @foreach($jeniss as $j)
                                                    <option value="{{ $j->id_jenis_barang }}">{{$j->jenis_barang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="urai" class="form-label">Urai Satuan</label>
                                                <input name="urai" type="text" class="form-control" id="urai" aria-describedby="urai" >
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
                            <th>Jenis</th>
                            <th>Nama Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($satuan as $r)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>
                                @foreach($r->id_jenis as $id_jenis)
                                {{ $jenis->where('id_jenis_barang', $id_jenis)->first()->jenis_barang }},
                                @endforeach
                            </td>
                            <td>{{$r->urai}}</td>
                            <td><a href="/satuan/{{$r->id}}/edit" class="btn btn-warning btn-sm">Ubah
                                    <a href="/satuan/{{$r->id}}/delete" class="btn btn-danger btn-sm">Hapus</td>
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
