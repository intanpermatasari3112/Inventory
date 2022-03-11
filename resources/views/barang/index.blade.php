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
                    <h1>Data Barang</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Barang</li>
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
                        <h2 class="card-title">Data Barang</h2>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Barang
                        </button>
                    </div>
                    <div class="col-6">
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/barang/create" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
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
                                                <input name="kode_barang" readonly type="text" class="form-control" id="kode_barang" aria-describedby="kode_barang" placeholder="Masukkan Kode Barang">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                                <input name="nama_barang" type="text" class="form-control" id="nama_barang" aria-describedby="kode_barang" placeholder="Masukkan Nama Barang">
                                            </div>
                                            <div class="mb-3">
                                                <label for="merek" class="form-label">Merek</label>
                                                <input name="merek" type="text" class="form-control" id="merek" aria-describedby="merek" placeholder="Masukkan Nama Merek">
                                            </div>
                                            <div class="mb-3">
                                                <label for="satuan" class="form-label">Satuan</label>
                                                <input name="satuan" type="text" class="form-control" id="satuan" aria-describedby="satuan" placeholder="Masukkan Nama Satuan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah_beli" class="form-label">Jumlah Beli</label>
                                                <input name="jumlah_beli" type="integer" class="form-control" id="jumlah_beli" aria-describedby="jumlah_beli" placeholder="Jumlah_beli">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kondisi" class="form-label">Kondisi</label>
                                                <select name="kondisi" id="kondisi" class="form-select">
                                                    <option value="">--Pilih kondisi--</option>
                                                    <option >Baru</option>
                                                    <option >Bekas</option>
                                                    <option >Rusak</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_masuk" class="form-label">Tanggal Beli</label>
                                                <input name="tanggal_masuk" type="date" class="form-control" id="tanggal_masuk" aria-describedby="tanggal_masuk" placeholder="Pilih Tanggal">
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                                <input name="harga_beli" type="int" class="form-control" id="harga_beli" aria-describedby="harga_beli" placeholder="Masukkan Harga Beli">
                                            </div>
                                            <div class="mb-3">
                                                <label for="gambar" class="form-label">Upload Gambar</label>
                                                <input name="gambar" type="file" class="form-control" id="gambar" aria-describedby="gambar">
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
                            <th>Jenis Barang</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Merek</th>
                            <th>Satuan</th>
                            <th>Jumlah beli</th>
                            <th>Kondisi</th>
                            <th>Tanggal Beli</th>
                            <th>Harga Beli</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_barang as $barang)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$barang->jenis->jenis_barang}}</td>
                            <td>{{$barang->kode_barang}}</td>
                            <td>{{$barang->nama_barang}}</td>
                            <td>{{$barang->merek}}</td>
                            <td>{{$barang->satuan}}</td>
                            <td>{{$barang->jumlah_beli}}</td>
                            <td>{{$barang->kondisi}}</td>
                            <td>{{$barang->tanggal_masuk}}</td>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>
                                <img src="{{ url($barang->gambar) }}" width="240px" />
                            </td>
                            <td>
                                <a href="{{ url('barang/'.$barang->kode_barang.'/edit') }}" class="btn btn-warning btn-sm">Ubah
                                <a href="{{ url('barang/'.$barang->kode_barang.'/delete') }}" class="btn btn-danger btn-sm">Hapus
                                <a href="{{ url('barang/'.$barang->kode_barang.'/cetak') }}" class="btn btn-success btn-sm">Barcode
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
    const kodesbarang = {!! json_encode($kodesbarang) !!};
    $(document).ready(function() {
        $('select[name=jenis_barang]').change(function() {
            kodesbarang.filter(r => r.kode_jenis == $(this).find(":selected").data('kodejenis')).map(r => {
                let { kode_jenis, lastid } = r;
                const nextid = ('000' + (parseInt(lastid || '0')+1)).slice(-4);
                $('input[name=kode_barang]').val(`${kode_jenis}-LTI-${nextid}`);
            });
        });
    });
</script>
@endpush