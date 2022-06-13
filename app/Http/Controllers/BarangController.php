<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jenis;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Str;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $data['data_barang'] = \App\Models\Barang::all();
        // $data['data_barang_cetak'] = \App\Models\Barang::all();
        $data['jenis'] = Jenis::all();
        $data['supplier'] = Supplier::all();
        $data['satuan'] = Satuan::all();
        $data['history'] = DB::table('history_transaksi')->where('jenis_transaksi', 'MUTASI_BARANG')->get();
        $data['kodesbarang'] = DB::table(DB::raw("(SELECT j.kode_jenis, max(substring_index(substring_index(b.kode_barang,'-',-1),',',1)) as lastid FROM jenis j left join barang b on j.id_jenis_barang = b.jenis_barang group by j.kode_jenis) x"))->get();
        return view('barang.index',$data);
    }

    public function create(Request $request)
    // {
    //     $file = $request->file("gambar");
    //     $insert = $request->all();
    //     $insert['gambar'] = $file->storeAs('berkas', Str::random(25) .'.'. $file->getClientOriginalExtension());
    //     \App\Models\Barang::create($insert);
    //     return redirect('/barang')->with('sukses','Data berhasil diinput');
    // }
    {
        $file = $request->file("gambar");
        $insert = $request->all();
        $insert['harga_beli'] = str_replace(".", "", str_replace("Rp. ", "", $insert['harga_beli'])); //untuk menghilangkan string titik dan spasi.
        $fileName =  Str::random(25) .'.'. $file->getClientOriginalExtension();
        $upload = $file->move('berkas', $fileName); //ini eksekusi function upload. TRUE/FALSE. Kalo true berhasil, kalo false gagal upload
        if(!$upload){
            return redirect('/barang')->with('gagal','Data gagal diinput');
        }

        $insert['gambar'] = "berkas/$fileName";
        // $insert['gambar'] = $file->storeAs('berkas', Str::random(25) .'.'. $file->getClientOriginalExtension());
        \App\Models\Barang::create($insert);
        return redirect('/barang')->with('sukses','Data berhasil diinput');
    }
    public function edit($kode_barang)
    {
        $barang = \App\Models\Barang::find($kode_barang);
        $data['barang'] = $barang;
        $data['jenis'] = Jenis::all();
<<<<<<< HEAD
        $data['satuan'] = Satuan::where('id_jenis', $barang->jenis->id_jenis_barang)->get();
=======
        // dd(Satuan::where(DB::raw('JSON_CONTAINS(id_jenis, \'"'.$barang->jenis->id_jenis_barang.'"\', \'$\')'), 'true')->toSql());
        $data['satuan'] = Satuan::where(DB::raw('JSON_CONTAINS(id_jenis, \'"'.$barang->jenis->id_jenis_barang.'"\', \'$\')'), 1)->get();
>>>>>>> e86f4b4c69ed67604fe6a0467d09328181eb1624
        $data['supplier'] = Supplier::all();
        return view('barang/edit', $data);
    }
    public function update(Request $request, $kode_barang)
    // {
    //     // return request()->all();
    //     $file = $request->file("gambar");
    //     $update = $request->all();
    //     if($file){
    //         $update['gambar'] = $file->storeAs('berkas', Str::random(25) .'.'. $file->getClientOriginalExtension());
    //     }
    //     $data = \App\Models\Barang::find($kode_barang);
    //     $berkaslama = $data->gambar;
    //     $data->update($update);
    //     if($berkaslama && $file){
    //         Storage::delete($berkaslama);
    //     }
    //     return redirect('/barang')->with('sukses', 'Data berhasil diupdate');
    // }
    {
        // return request()->all();
        $file = $request->file("gambar");
        $update = $request->all();
        $update['harga_beli'] = str_replace(".", "", str_replace("Rp. ", "", $update['harga_beli']));
        if($file){
            $fileName =  Str::random(25) .'.'. $file->getClientOriginalExtension();
            $upload = $file->move('berkas', $fileName); //ini eksekusi function upload. TRUE/FALSE. Kalo true berhasil, kalo false gagal upload
            if(!$upload){
                return redirect('/barang')->with('gagal','Data gagal diinput');
            }
            $update['gambar'] = "berkas/$fileName";
        }
        $data = \App\Models\Barang::find($kode_barang);
        
        // penjumlahan stok lama dengan stok baru
        $total_stok = $data->jumlah_beli + request()->jumlah_beli;

        $berkaslama = $data->gambar;
        $update['jumlah_beli'] = $total_stok;
        $data->update($update);
        if($berkaslama && $file){
            Storage::delete($berkaslama);
        }

        // tambah ke history
        DB::table('history_transaksi')->insert([
            'nama_transaksi' => 'Penambahan '. request()->jumlah_beli .' barang, dari pengubahan barang masuk ' . $data->kode_barang,
            'jenis_transaksi' => 'MUTASI_BARANG',
            'user_id' => Auth::user()->id
        ]);

        return redirect('/barang')->with('sukses', 'Data berhasil diupdate');
    }

    public function delete($kode_barang)
    {
        $data = \App\Models\Barang::find($kode_barang);
        $berkaslama = $data->gambar;
        $data->delete($data);
        if($berkaslama){
            Storage::delete($berkaslama);
        }
        return redirect('/barang')->with('sukses', 'Data berhasil dihapus');
    }
    public function cetak($kode_barang)
    {
        $data['barang'] = \App\Models\Barang::find($kode_barang);
        return view('barang.cetak',$data);
    }
    // Cetak Barcode
    public function cetakBatch (Request $request)
    {   
        $jenis = $request->get('jenis-barang');
        if(!empty($jenis)){
            $data ['barang'] = Barang::where('jenis_barang', $jenis)->get();
        }else{
            $data['barang'] = Barang::all();
        }
        return view( 'barang.cetak_batch', $data);
    }
}

