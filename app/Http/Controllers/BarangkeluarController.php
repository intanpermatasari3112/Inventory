<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Str;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $data_barang_keluar = DB::table(DB::raw("(SELECT `barang_keluar`.*, jenis.jenis_barang as jenis, barang.nama_barang, users.email FROM `barang_keluar`
        INNER JOIN barang ON barang_keluar.kode_barang=barang.kode_barang
        INNER JOIN jenis ON barang.jenis_barang=jenis.id_jenis_barang
        INNER JOIN users ON barang_keluar.pengguna=users.email) x"));
        if(request()->status_pinjam)
            $data_barang_keluar=$data_barang_keluar->where('status_pinjam', request()->status_pinjam);
        if(Auth::user()->level=='PENGGUNA'){
            $data_barang_keluar->where('pengguna', Auth::user()->email);
        }
        $last = \App\Models\Barangkeluar::orderBy('kode_barang_keluar', 'desc')->first();
        $data['data_barang_keluar'] = $data_barang_keluar->orderBy('kode_barang_keluar', 'asc')->get();
        $data['jenis'] = Jenis::all();
        $data['kodesbarang'] = DB::table(DB::raw("(SELECT j.kode_jenis, max(substring_index(substring_index(b.kode_barang,'-',-1),',',1)) as lastid FROM jenis j left join barang b on j.id_jenis_barang = b.jenis_barang group by j.kode_jenis) x"))->get();
        if(Auth::user()->level=="PENGGUNA")
        $data['user'] = User::where("id", Auth::user()->id)->get();
            else
        $data['user'] = User::all();
        $data['barang'] = Barang::all();
        $data['history'] = DB::table('history_transaksi')->where('jenis_transaksi', 'PENGEMBALIAN_BARANG')->get();
        $data['nextid'] = $last ? $last->kode_barang_keluar + 1 : 1;
        return view('barangkeluar.index', $data);
    }
    public function create(Request $request)
    {
        $barang=\App\Models\Barang::where('kode_barang', request()->kode_barang)->first();
        if(!$barang)
            return redirect('/barangkeluar')->with('error', 'Barang Tidak ditemukan');
        // pengajuan peminjaman hanya pengecekan stok tanpa mengurangi, nanti di acc
        if(!$barang->stokone || ($barang->stokone && $barang->stokone->stok < request()->jumlah))
            return redirect('/barangkeluar')->with('error', 'Stok kurang dari barang dipinjam');
        $create = $request->all();
        $create ['status_pinjam'] = "PENDING";
        \App\Models\Barangkeluar::create($create);
        return redirect('/barangkeluar')->with('sukses', 'Data berhasil diinput');
    }
    public function edit($kode_barang_keluar)
    {
        
        $data['barangkeluar'] = \App\Models\Barangkeluar::find($kode_barang_keluar);
        $data['jenis'] = Jenis::all();
        $data['user'] = User::all();
        $data['barang'] = Barang::all();
        return view('barangkeluar/edit', $data);
    }
    public function update(Request $request, $kode_barang_keluar)
    {
        $barang=\App\Models\Barang::where('kode_barang', request()->kode_barang)->first();
        if(!$barang)
            return redirect('/barangkeluar')->with('error', 'Barang Tidak ditemukan');
        if(!$barang->stokone || ($barang->stokone && $barang->stokone->stok < request()->jumlah))
            return redirect('/barangkeluar')->with('error', 'Stok kurang dari barang dipinjam');
        $data = \App\Models\Barangkeluar::find($kode_barang_keluar);
        $data->update($request->all());
        return redirect('/barangkeluar')->with('sukses', 'Data berhasil diupdate');
    }
    public function acc_pinjam(Request $request, $kode_barang_keluar)
    {
        $data = \App\Models\Barangkeluar::find($kode_barang_keluar);
        // stok berkurang ketika peminjaman di acc bukan ketika megajukan dan diterima
        $barang = \App\Models\Barang::where('kode_barang', $data->kode_barang)->first();
        if($request->status_pinjam == 'DITERIMA') {
            if(!$barang->stokone || ($barang->stokone && $barang->stokone->stok < request()->jumlah))
                return redirect('/barangkeluar')->with('error', 'Stok kurang dari barang dipinjam, proses pinjam tidak dapat dilanjutkan');
            else {
                $stok = $barang->stokone->stok - request()->jumlah;
                $barang->stokone->update(['stok'=>$stok]);
            }
        }
        $data->update([
            'status_pinjam' => $request->status_pinjam,
            'keterangan_status_pinjam' => $request->keterangan_status_pinjam
        ]);
        return redirect('/barangkeluar')->with('sukses', 'Data berhasil diupdate');
    }
    public function pengembalian(Request $request, $kode_barang_keluar) 
    {
        $data = \App\Models\Barangkeluar::where('kode_barang_keluar', $kode_barang_keluar)->where('status_pinjam', 'DISETUJUI');
        $pinjaman = $data->first();

        // tambah stok barang
        $barang = \App\Models\Barang::where('kode_barang', $pinjaman->kode_barang)->first();
        $stok = $barang->stokone->stok + $pinjaman->jumlah;
        $barang->stokone->update(['stok'=>$stok]);

        // tambah ke history
        DB::table('history_transaksi')->insert([
            'nama_transaksi' => 'Penambahan '. $pinjaman->jumlah .' stok, barang '. $barang->kode_barang .' dari pengembalian ' . $pinjaman->pengguna,
            'jenis_transaksi' => 'PENGEMBALIAN_BARANG',
            'user_id' => Auth::user()->id
        ]);

        $data->update([
            'status_kembali' => 'SUDAH',
        ]);
        return redirect('/barangkeluar')->with('sukses', 'Data berhasil diupdate');
    }
    public function delete($kode_barang_keluar)
    {
        $data = \App\Models\Barangkeluar::find($kode_barang_keluar);
        $data->delete($data);
        return redirect('/barangkeluar')->with('sukses', 'Data berhasil dihapus');
    }
}
