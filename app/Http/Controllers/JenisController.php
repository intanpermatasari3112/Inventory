<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Jenis;

class JenisController extends Controller
{
    public function index()
    {
        $last = \App\Models\Jenis::orderBy('id_jenis_barang', 'desc')->first();
        $data['data_jenis'] = Jenis::all();
        $data['jenis'] = Jenis::all();
        $data['nextid'] = $last ? $last->id_jenis_barang+1 : 1;
        return view('jenis.index',$data);
    }
    public function create(Request $request)
    {
        \App\Models\Jenis::create($request->all());
        return redirect('/jenis')->with('sukses','Data berhasil diinput');
    }
    public function edit($id_jenis_barang)
    {
        $data['jenis'] = \App\Models\Jenis::find($id_jenis_barang);
        return view('jenis/edit', $data);
    }
    public function update(Request $request, $id_jenis_barang)
    {
        $data = \App\Models\Jenis::find($id_jenis_barang);
        $data->update($request->all());
        return redirect('/jenis')->with('sukses', 'Data berhasil diupdate');
    }
    public function delete($id_jenis_barang)
    {
        $data = \App\Models\Jenis::find($id_jenis_barang);
        $data->delete($data);
        return redirect('/jenis')->with('sukses', 'Data berhasil dihapus');
    }
}
