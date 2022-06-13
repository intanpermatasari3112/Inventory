<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index() {
        $data = [
            'jenis' => Jenis::get(),
            'satuan' => Satuan::get()
        ];
        return view('satuan.index', $data);
    }

    public function create() {
        Satuan::create(request()->all());
        return redirect('/satuan')->with('sukses', 'Data berhasil diinput');
    }

    public function edit($id) {
        $data = [
            'jenis' => Jenis::get(),
            'satuan' => Satuan::find($id)
        ];
        return view('satuan.edit', $data);
    }

    public function update($id) {
        $satuan = Satuan::find($id);
        $satuan->update(request()->all());
        return redirect('/satuan')->with('sukses', 'Data berhasil diubah');
    }

    public function delete($id) {
        $satuan = Satuan::find($id);
        $satuan->delete();
        return redirect('/satuan')->with('sukses', 'Data berhasil dihapus');
    }
}
