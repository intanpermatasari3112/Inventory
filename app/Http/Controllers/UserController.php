<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $last = \App\Models\User::orderBy('id', 'desc')->first();
        $data['data_user'] = User::all();
        $data['user'] = User::all();
        $data['nextid'] = $last ? $last->id+1 : 1;
        return view('user.index',$data);
    }
    public function create(Request $request)
    {
        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        \App\Models\User::create($user);
        return redirect('/user')->with('sukses','Data berhasil diinput');
    }
    public function edit($id_user)
    {
        $data['user'] = \App\Models\User::find($id_user);
        return view('user/edit', $data);
    }
    public function update(Request $request, $id_user)
    {
        $data = \App\Models\User::find($id_user);
        $user = $request->all();
        if($user['password']) {
            $user['password'] = Hash::make($user['password']);
        } else {
            unset($user['password']);
        }
        $data->update($user);
        return redirect('/user')->with('sukses', 'Data berhasil diupdate');
    }
    public function delete($id_user)
    {
        $data = \App\Models\User::find($id_user);
        $data->delete($data);
        return redirect('/user')->with('sukses', 'Data berhasil dihapus');
    }
}
