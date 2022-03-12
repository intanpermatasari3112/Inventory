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
                    <h1>Data Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/barang">Data Barang</a></li>
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
                    <h2 class="card-title"><b>Edit Data Barang</b></h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <form action="/barangkeluar/{{$barangkeluar->kode_barang_keluar}}/update" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label for="kode_barang_keluar" class="form-label">Kode Barang Keluar</label>
                            <input name="kode_barang_keluar" type="text" class="form-control" id="kode_barang_keluar" aria-describedby="kode_barang_keluar" placeholder="Masukkan Kode Barang Keluar" value="{{$barangkeluar->kode_barang_keluar}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_barang" class="form-label">Jenis Barang</label>
                            <select name="jenis_barang" id="kategori" class="form-control">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($jenis as $j)
                                <option data-kodejenis="{{ $j->kode_jenis }}" {{$barangkeluar->jenis_barang==$j->id_jenis_barang ? "selected":""}} value="{{ $j->id_jenis_barang }}">{{$j->jenis_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <select name="kode_barang" id="kode_barang" class="form-control">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($barang as $b)
                                <option data-kodejenis="{{ $b->jenis->kode_jenis }}" {{$barangkeluar->kode_barang==$b->kode_barang ? "selected":""}} value="<?= $b->kode_barang ?>">{{$b->kode_barang}} - {{$b->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                            <input name="tanggal_keluar" type="date" class="form-control" id="tanggal_keluar" aria-describedby="tanggal_keluar" placeholder="Pilih Tanggal" value="{{$barangkeluar->tanggal_keluar}}">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input name="jumlah" type="int" class="form-control" id="jumlah" aria-describedby="jumlah" placeholder="Masukkan Jumlah" value="{{$barangkeluar->jumlah}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Pengguna</label>
                            <select name="name" id="kategori" class="form-control">
                                <option value="">-- Silahkan pilih satu --</option>
                                @foreach($user as $u)
                                <option value="<?= $u->email ?>" {{$barangkeluar->pengguna==$u->email ? "selected":""}}>{{$u->email}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input name="keterangan" type="int" class="form-control" id="keterangan" aria-describedby="keterangan" placeholder="Keterangan" value="{{$barangkeluar->keterangan}}">
                        </div>
                        <button type=" submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('select[name=kode_barang] option[value!=""]').hide();
        $('select[name=kode_barang] option[value!=""][data-kodejenis={{ $barangkeluar->jenis->kode_jenis }}]').show();
        $('select[name=jenis_barang]').change(function() {
            const kodejenis = $(this).find(":selected").data('kodejenis');
            $('select[name=kode_barang] option[value!=""]').hide();
            $('select[name=kode_barang] option[value!=""][data-kodejenis=' + kodejenis + ']').show();
            $('select[name=kode_barang]').val('');
        });
    });
</script>
@endpush