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
                </div>
                <div>
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
                                                    <option data-kodejenis="{{ $b->jenis->kode_jenis }}" data-stok="{{ $b->stokOne->stok}}" value="<?= $b->kode_barang ?>">{{$b->kode_barang}} - {{$b->nama_barang}}</option>
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
                                                <label for="alasan_pinjam" class="form-label">Keterangan</label>
                                                <input name="alasan_pinjam" type="int" class="form-control" id="alasan_pinjam" aria-describedby="keterangan" placeholder="Keterangan">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Pinjam Barang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statusModal">Acc Barang Dipinjam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-3">
                                                <label for="kode_barang_keluar" class="form-label">Kode Barang Dipinjam</label>
                                                <input name="kode_barang_keluar" type="text" class="form-control" value="{{$nextid}}" id="kode_barang_keluar" aria-describedby="kode_barang_keluar" placeholder="Masukkan Kode Barang Keluar" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                                <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" aria-describedby="jenis_barang" placeholder="Masukkan Kode Barang Keluar" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                                <input name="nama_barang" type="text" class="form-control" id="nama_barang" aria-describedby="kode_barang" placeholder="Masukkan Kode Barang" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_keluar" class="form-label">Tanggal Dipinjam</label>
                                                <input name="tanggal_keluar" type="date" class="form-control" id="tanggal_keluar" aria-describedby="tanggal_keluar" placeholder="Pilih Tanggal" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input name="jumlah" type="int" class="form-control" id="jumlah" aria-describedby="jumlah" placeholder="Masukkan Jumlah" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Pengguna</label>
                                                <input name="email" type="text" class="form-control" id="email" aria-describedby="email" placeholder="Masukkan Kode Barang Keluar" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alasan_pinjam" class="form-label">Keterangan Peminjaman</label>
                                                <input name="alasan_pinjam" type="int" class="form-control" id="alasan_pinjam" aria-describedby="keterangan" placeholder="Keterangan" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan_status_pinjam" class="form-label">Catatan Peminjaman</label>
                                                <input name="keterangan_status_pinjam" type="int" class="form-control" id="keterangan_status_pinjam" aria-describedby="keterangan" placeholder="Keterangan">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="status_pinjam" value="DISETUJUI" class="btn btn-primary">Terima</button>
                                        <button type="submit" name="status_pinjam" value="DITOLAK" class="btn btn-danger">Tolak</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="batalPinjamModal" tabindex="-1" aria-labelledby="batalPinjamModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="batalPinjamModal">Batalkan Barang Dipinjam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin batal pinjam barang?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="GET">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Batalkan & Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="balikPinjamModal" tabindex="-1" aria-labelledby="balikPinjamModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="balikPinjamModal">Pengenmbalian Barang Dipinjam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                        <p>Kembalikan barang?</p>
                                    </div>
                                    <div class="modal-footer">
                                            {{csrf_field()}}
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Proses</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                            <th>Aksi</th>
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
                                    <button
                                    type="button"
                                    class="btn btn-peminjaman btn-warning btn-sm"
                                    data-kodebarangkeluar="{{$barangkeluar->kode_barang_keluar}}"
                                    data-jenis="{{$barangkeluar->jenis}}"
                                    data-kodebarang="{{$barangkeluar->nama_barang}}"
                                    data-namabarang="{{$barangkeluar->nama_barang}}"
                                    data-email="{{$barangkeluar->email}}"
                                    data-tanggalkeluar="{{$barangkeluar->tanggal_keluar}}"
                                    data-alasanpinjam="{{$barangkeluar->alasan_pinjam}}"
                                    data-jumlah="{{$barangkeluar->jumlah}}">Peminjaman</button>
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
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-12">
                        <h2 class="card-title">History Barang Dipinjam</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover myTable">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Transaksi</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($history as $r)
                        <tr align="center">
                            <td>{{$no++}}</td>
                            <td>{{$r->nama_transaksi}}</td>
                            <td>{{$r->tanggal_transaksi}}</td>
                            <td>{{$r->keterangan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
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
        $('input[name=jumlah]').change(function() {
            const stok = $("select[name=kode_barang]").find(":selected").data('stok');
            const jumlah =   $('input[name=jumlah]').val();
            if(stok<jumlah){
                alert("Barang tidak dapat diproses")
            }
        });

        $(".btn-peminjaman").click(function(){
            const modal=$("#statusModal"); 
            modal.modal("show");
            modal.find("input[name=kode_barang_keluar]").val($(this).data('kodebarangkeluar'))
            modal.find("input[name=jenis_barang]").val($(this).data('jenis'))
            modal.find("input[name=nama_barang]").val($(this).data('namabarang'))
            modal.find("input[name=email]").val($(this).data('email'))
            modal.find("input[mame=tanggal_keluar]").val($(this).data('tanggalkeluar'))
            modal.find("input[mame=alasan_pinjam]").val($(this).data('alasanpinjam'))
            modal.find("input[name=jumlah]").val($(this).data('jumlah'))
            modal.find('form').attr('action', '/barangkeluar/' + $(this).data('kodebarangkeluar') + '/accstatus')
        });


        $(".btn-pengembalian").click(function(){
            const modal=$("#balikPinjamModal");
            modal.modal('show');
            modal.find('form').attr('action', '/barangkeluar/' + $(this).data('kodebarangkeluar') + '/pengembalian')
        });
        
        $(".btn-batal-pinjam").click(function(){
            const modal=$("#batalPinjamModal"); 
            modal.modal('show');
            modal.find('form').attr('action', '/barangkeluar/' + $(this).data('kodebarangkeluar') + '/delete')
        });
    });
</script>
@endpush