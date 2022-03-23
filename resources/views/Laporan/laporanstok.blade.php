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
                    <h1>Laporan Data Stok Menipis</h1>

                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Data Stok Menipis</li>
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
                        <h2 class="card-title">Laporan Data Stok Menipis</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover myTable">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Kode Stok Barang</th>
                            <th>Kode Barang</th>
                            <th>Batas Minimal</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($data_stok as $stok)
                        <tr {{ ($stok->stok<$stok->batasMin ? "class=bg-danger":'') }} align="center">
                            <td>{{$no++}}</td>
                            <td>{{$stok->kodeStok}}</td>
                            <td>{{$stok->barang ? $stok->barang->kode_barang:''}}</td>
                            <td>{{$stok->batasMin}}</td>
                            <td>{{$stok->stok}}</td>
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

@push('js')
<script>
    $(document).ready(function() {
        $('select[name=kode_barang]').change(function() {
            $('input[name=stok]').val($(this).find(':selected').data('jumlahbeli'));
        })
    });
</script>
@endpush