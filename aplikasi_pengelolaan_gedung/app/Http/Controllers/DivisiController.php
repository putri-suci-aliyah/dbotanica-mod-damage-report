<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Divisi::where('is_active', TRUE)->orderBy('id','asc')->get();;
        return view('pages.divisi.index')->with('data', $data);
    }

    public function create()
    {
        return view('pages.divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_divisi' => ['unique:divisis,kode_divisi'],
        ],[
            'kode_divisi.unique' => 'Kode divisi sudah ada di database',
            
        ]);

        $divisi = new Divisi();
        $divisi->kode_divisi = $request->kode_divisi;
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->keterangan_divisi = $request->keterangan_divisi;
        $divisi->created_at = now();
        $divisi->save();
        
        return redirect()->to('divisi')->with('success', 'Data divisi berhasil disimpan');

    }

    public function show(Divisi $divisi)
    {
        //
    }

    public function edit(Divisi $divisi)
    {
        $data = $divisi;
        return view('pages.divisi.edit')->with('data', $data);
    }

    public function update(Request $request, Divisi $divisi)
    {
        $data = [
            'nama_divisi' => $request->nama_divisi,
            'keterangan_divisi' => $request->keterangan_divisi,
        ];

        $divisi->update($data);
        return redirect()->to('divisi')->with('success', 'Data divisi berhasil diubah');
    }

    public function soft_delete_divisi(Request $request, $id){
        $data = Divisi::where('id', $id)->first();
        $data->is_active = False;
        $data->save();
        return redirect()->to('divisi')->with('success', 'Data divisi berhasil dihapus');
    }
}
