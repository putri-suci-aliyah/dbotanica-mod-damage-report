<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::where('is_active',TRUE)-> with('divisi')->orderBy('id','asc')->get();
        return view('pages.users.index')->with('data', $data);
    }

    public function create()
    {
        $divisi = Divisi::where('is_active',TRUE)->orderBy('id','asc')->get();
        return view('pages.users.create',compact('divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['unique:users,name'],
            'email' => ['unique:users,email'],
        ],[
            'name.unique' => 'Nama user sudah ada di database',
            'email.unique' => 'Email user sudah ada di database',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->divisi_id = $request->divisi_id;
        $user->keterangan_user = $request->keterangan_user;
        $user->created_at = now();
        
        if ($request->is_super_admin == 1){
            $user->is_super_admin = 1;
            $user->is_read = 1; 
            $user->is_create = 1; 
            $user->is_update = 1; 
            $user->is_delete = 1; 
        }else{
            $user->is_super_admin = 0;
            $user->is_read = $request->has('is_read') ? 1 : 0;
            $user->is_create =  $request->has('is_create') ? 1 : 0;
            $user->is_update =  $request->has('is_update') ? 1 : 0;
            $user->is_delete =  0;
        }
                
        $user->save();

        return redirect()->to('users')->with('success', 'Data user berhasil disimpan');
    }

    public function edit(string $id)
    {
        $data = User::where('id',$id)->first();
        $divisi = Divisi::where('is_active',TRUE)->orderBy('id','asc')->get();
        return view('pages.users.edit',compact('data','divisi'));
    }


    public function update(Request $request, string $id)
    {
        $data = User::where('id',$id)->first();
        $data_form = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'divisi_id'=>$request->divisi_id,
            'keterangan'=>$request->keterangan,
            'is_super_admin' => $request->is_super_admin == 1 ? 1 : 0,
            'is_read' => $request->is_super_admin == 1 ? 1 : ($request->has('is_read') ? 1 : 0),
            'is_create' => $request->is_super_admin == 1 ? 1 : ($request->has('is_create') ? 1 : 0),
            'is_update' => $request->is_super_admin == 1 ? 1 : ($request->has('is_update') ? 1 : 0),
            'is_delete' => $request->is_super_admin == 1 ? 1 : ($request->has('is_delete') ? 1 : 0),
        ];

        $data->update($data_form);
        return redirect()->to('users')->with('success', 'Data user berhasil diubah');
    }

    public function soft_delete_users(Request $request, $id){
        $data = User::where('id', $id)->first();
        $data->is_active = False;
        $data->save();
        return redirect()->to('users')->with('success', 'Data user berhasil dihapus');
    }
}
