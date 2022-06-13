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
                    <h1>Data Satuan</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/stok">Data Satuan</a></li>
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
                    <h2 class="card-title"><b>Edit Data Satuan</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/satuan/{{$satuan->id}}/update" method="POST">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="id_jenis" class="form-label">Kode Barang</label>
<<<<<<< HEAD
                            <select name="id_jenis" id="id_jenis" class="form-control">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($jenis as $j)
                                <option {{ $j->id_jenis_barang == $satuan->id_jenis ? 'selected': '' }} value="{{ $j->id_jenis_barang }}">{{$j->jenis_barang}}</option>
=======
                            <select multiple name="id_jenis[]" id="id_jenis" class="form-select d-block select2">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($jenis as $j)
                                <option {{ in_array($j->id_jenis_barang, $satuan->id_jenis) ? 'selected': '' }} value="{{ $j->id_jenis_barang }}">{{$j->jenis_barang}}</option>
>>>>>>> e86f4b4c69ed67604fe6a0467d09328181eb1624
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="urai" class="form-label">Urai Satuan</label>
                            <input name="urai" type="text" class="form-control" id="urai" value="{{$satuan->urai}}">
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection