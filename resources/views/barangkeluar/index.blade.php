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
                {{$errors}}
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
                @endif
                <div class="col-sm-6">
                    <h1>Data Barang Dipinjam</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Barang Dipinjam</li>
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
                        <h2 class="card-title">Data Barang Dipinjam</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Barang Dipinjam
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Dipinjam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/barangkeluar/create" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="kode_barang_keluar" class="form-label">Kode Barang Dipinjam</label>
                                                <input name="kode_barang_keluar" type="text" class="form-control" value="{{$nextid}}" id="kode_barang_keluar" aria-describedby="kode_barang_keluar" placeholder="Masukkan Kode Barang Keluar" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                                <select name="jenis_barang" id="kategori" class="form-control">
                                                    <option value="">-- Silahkan pilih satu --</option>
                                                    @foreach($jenis as $j)
                                                    <option data-kodejenis="{{ $j->kode_jenis }}" value="{{ $j->id_jenis_barang }}">{{$j->jenis_barang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                                <select name="kode_barang" id="kode_barang" class="form-control">
                                                    <option value="">-- Silahkan pilih satu --</option>
                                                    @foreach($barang as $b)
                                                    <option data-kodejenis="{{ $b->jenis->kode_jenis }}" value="<?= $b->kode_barang ?>">{{$b->kode_barang}} - {{$b->nama_barang}}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_keluar" class="form-label">Tanggal Dipinjam</label>
                                                <input name="tanggal_keluar" type="date" class="form-control" id="tanggal_keluar" aria-describedby="tanggal_keluar" placeholder="Pilih Tanggal">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input name="jumlah" type="int" class="form-control" id="jumlah" aria-describedby="jumlah" placeholder="Masukkan Jumlah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Pengguna</label>
                                                <select name="pengguna" id="kategori" class="form-control">
                                                    <option value="">-- Silahkan pilih satu --</option>
                                                    @foreach($user as $u)
                                                    <option value="<?= $u->email ?>">{{$u->email}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <input name="keterangan" type="int" class="form-control" id="keterangan" aria-describedby="keterangan" placeholder="Keterangan">
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
                            <th>Kode Barang Dipinjam</th>
                            <th>Jenis Barang</th>
                            <th>Nama Barang</th>
                            <th>Pengguna</th>
                            <th>Tanggal Dipinjam</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_barang_keluar as $barangkeluar)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$barangkeluar->kode_barang_keluar}}</td>
                            <td>{{$barangkeluar->jenis_barang}}</td>
                            <td>{{$barangkeluar->nama_barang}}</td>
                            <td>{{$barangkeluar->email}}</td>
                            <td>{{$barangkeluar->tanggal_keluar}}</td>
                            <td>{{$barangkeluar->jumlah}}</td>
                            <td>{{$barangkeluar->keterangan}}</td>
                            <td>
                                <a href="{{ url('barangkeluar/'.$barangkeluar->kode_barang_keluar.'/edit') }}" class="btn btn-warning btn-sm">Ubah
                                    <a href="{{ url('barangkeluar/'.$barangkeluar->kode_barang_keluar.'/delete') }}" class="btn btn-danger btn-sm">Hapus
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('select[name=kode_barang] option[value!=""]').hide();
        $('select[name=jenis_barang]').change(function() {
            const kodejenis = $(this).find(":selected").data('kodejenis');
            $('select[name=kode_barang] option[value!=""]').hide();
            $('select[name=kode_barang] option[value!=""][data-kodejenis='+kodejenis+']').show();
            $('select[name=kode_barang]').val('');
        });
    });
</script>
@endpush