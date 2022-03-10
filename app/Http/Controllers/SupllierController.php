<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupllierController extends Controller
{
    public function index()
    {
        $data['data_supplier'] = Supplier::all();
        $data['supplier'] = Supplier::all();
        return view('supplier.index',$data);
    }
    public function create(Request $request)
    {
        \App\Models\Supplier::create($request->all());
        return redirect('/supplier')->with('sukses','Data berhasil diinput');
    }
    public function edit($id_supplier)
    {
        $data['supplier'] = \App\Models\Supplier::find($id_supplier);
        return view('supplier/edit', $data);
    }
    public function update(Request $request, $id_supplier)
    {
        $data = \App\Models\Supplier::find($id_supplier);
        $data->update($request->all());
        return redirect('/supplier')->with('sukses', 'Data berhasil diupdate');
    }
    public function delete($id_supplier)
    {
        $data = \App\Models\Supplier::find($id_supplier);
        $data->delete($data);
        return redirect('/supplier')->with('sukses', 'Data berhasil dihapus');
    }
}
