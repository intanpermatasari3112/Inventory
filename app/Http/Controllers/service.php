<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;
use App\Models\Barang;
class service extends Controller
{
    public function index()
    {
        $data['data_barang'] = \App\Models\Barang::all();
        return response($data);
    }
    public function lihat()
    {
        $data['data_stok'] = \App\Models\Stok::all();
        return response($data);
    }
    public function lihatjenis()
    {
        //$data['data_jenis'] = \App\Models\Jenis::all();
        $data['data_jenis'] = DB::table(DB::raw("(SELECT j.id_jenis_barang, j.jenis_barang, j.created_at, j.updated_at, j.kode_jenis, max(substring_index(substring_index(b.kode_barang,'-',-1),',',1)) as lastid FROM jenis j left join barang b on j.id_jenis_barang = b.jenis_barang group by j.id_jenis_barang, j.jenis_barang, j.created_at, j.updated_at, j.kode_jenis) x"))->get();
    
        return response($data);
    }
    public function detailBarang(Request $request)
    {
        $kodeBarang = $request->get('kode_barang');
        $data= \App\Models\Barang::where(['kode_barang' => $kodeBarang])->first();
        return response($data);
    }

    public function user(Request $request)
    {
        $input = json_decode($request->getContent());
        $userid = $input->userid;
        $password = $input->password;
        $user = \App\Models\User::where(['email'=> $userid])->first();
        return response($user);
    }
    public function tambahBarang(Request $request)
    {
        $kodeBarang = $request->post('kode_barang'); //ambil post value index nama_peserta
        $namaBarang = $request->post('nama_barang'); //ambil post value index id_asal
        $kondisi = $request->post('kondisi');  //ambil post value index id_periode
        $jenisBarang = $request->post('jenis_barang');  //ambil post value index id_periode
        $tanggalMasuk = $request->post('tanggal_masuk');  //ambil post value index id_periode
        $hargaBeli = $request->post('harga_beli');  //ambil post value index id_periode
        $gambar = $request->file('gambar'); //ambil post value index gambar

        //definisikan path gambar
        $path = "./berkas";

        //cek folder nya udah kebuat atau belum.
        //kalo belum, bakal execute yang mkdir didalam block IF
        if (!is_dir($path)) {
            mkdir($path, 0777, true); //buat folder ini
        }

        //ini proses upload
        //return dari move() itu boolean (true/false)
        //kalo false, berarti upload gagal
        $name = rand() . "-" . str_replace(" ", "-", strtolower($namaBarang)) . "." . $gambar->getClientOriginalExtension();
        if (!$gambar->move($path, $name)) {
            //munculin response upload error dengan HTTP code 500
            return response(['message' => 'upload error'], 500);
        }

        //prepare data untuk diinsert
        $data = [
            'kode_barang' => $kodeBarang,
            'nama_barang' => $namaBarang,
            'kondisi' => $kondisi,
            'jenis_barang' => $jenisBarang,
            'harga_beli' => $hargaBeli,
            'tanggal_masuk' => $tanggalMasuk,
            'gambar' => "berkas/".$name
        ];

        $ins = Barang::insert($data); //proses insert
        if ($ins) {
            //kalo berhasil kasih response json berhasil
            return response(['message' => 'Tambah Barang Berhasil']);
        } else {
            //kalo gagal insert, kasih juga response gagal dengan HTTP code 500 (internal server error)
            return response(['message' => 'Tambah Barang gagal'], 500);
        }
    }

    public function tambahJenis(Request $request)
    {
        $idJenisBarang = $request->post('id_jenis_barang'); //ambil post value index nama_peserta
        $jenisBarang = $request->post('jenis_barang');  //ambil post value index id_periode
        
        
        $data = [
            'id_jenis_barang' => $idJenisBarang,
            'jenis_barang' => $jenisBarang
           
        ];

        $ins = Jenis::insert($data); //proses insert
        if ($ins) {
            //kalo berhasil kasih response json berhasil
            return response(['message' => 'Tambah Jenis Berhasil']);
        } else {
            //kalo gagal insert, kasih juga response gagal dengan HTTP code 500 (internal server error)
            return response(['message' => 'Tambah Jenis gagal'], 500);
        }
    }

    public function hapusBarang($kode_barang)
    {
        $data = \App\Models\Barang::find($kode_barang);
        $berkaslama = $data->gambar;
        $data->delete($data);
        if($berkaslama){
            Storage::delete($berkaslama);
        }
        return response(['message' => 'data berhasil dihapus']);
    }
}
