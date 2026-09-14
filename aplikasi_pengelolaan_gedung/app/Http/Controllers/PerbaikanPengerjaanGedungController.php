<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerbaikanGedung;
use App\Models\Divisi;
use App\Models\User;
use App\Models\DetailTemuanKerusakan;
use App\Models\DetailPerbaikanKerusakan;

class PerbaikanPengerjaanGedungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PerbaikanGedung::where('status_perbaikan','Dalam Pengerjaan')->orderBy('id','asc')->get();
        return view('pages.pengerjaan.index')->with('data', $data);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // 5MB max
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pengerjaan_perbaikan'), $filename);

            return response()->json(['fileName' => $filename]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    
    public function show(string $id)
    {
        $data = PerbaikanGedung::where('id',$id)->first();
        $divisi_asal =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $divisi_tujuan =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $user = User::where('is_active',True)->orderBy('id','asc')->get();
        
        $imagePerbaikanUrls = [];

        if ($data->detail_temuan_kerusakan_images) {
            
            $imagePerbaikanUrls = [];

            if ($data->detail_temuan_kerusakan_images) {
                foreach (json_decode($data->detail_temuan_kerusakan_images) as $file) {
                    $imagePerbaikanUrls[] = asset($file->file_path);
                }
            }            
        }


        $imagePengerjaanUrls = [];
        if ($data->detail_perbaikan_kerusakan_images) {
            
            $imagePengerjaanUrls = [];

            if ($data->detail_perbaikan_kerusakan_images) {
                foreach (json_decode($data->detail_perbaikan_kerusakan_images) as $file) {
                    $imagePengerjaanUrls[] = asset($file->file_path);
                }
            }            
        }
        
        return view('pages.pengerjaan.show',compact('data','divisi_asal','divisi_tujuan','user','imagePerbaikanUrls','imagePengerjaanUrls'));

    }

    
    public function edit(string $id)
    {
        $data = PerbaikanGedung::where('id',$id)->first();
        $divisi_asal =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $divisi_tujuan =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $user = User::where('is_active',True)->orderBy('id','asc')->get();
        
        $imagePerbaikanUrls = [];

        if ($data->detail_temuan_kerusakan_images) {
            
            $imagePerbaikanUrls = [];

            if ($data->detail_temuan_kerusakan_images) {
                foreach (json_decode($data->detail_temuan_kerusakan_images) as $file) {
                    $imagePerbaikanUrls[] = asset($file->file_path);
                }
            }            
        }


        $imagePengerjaanUrls = [];
        if ($data->detail_perbaikan_kerusakan_images) {
            
            $imagePengerjaanUrls = [];

            if ($data->detail_perbaikan_kerusakan_images) {
                foreach (json_decode($data->detail_perbaikan_kerusakan_images) as $file) {
                    $imagePengerjaanUrls[] = asset($file->file_path);
                }
            }            
        }
        
        return view('pages.pengerjaan.edit',compact('data','divisi_asal','divisi_tujuan','user','imagePerbaikanUrls','imagePengerjaanUrls'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_temuan_kerusakan' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:tanggal_batas_pengerjaan'],
            'tanggal_batas_pengerjaan'   => ['required', 'date', 'after_or_equal:tanggal_temuan_kerusakan'],
        ],[
            'tanggal_temuan_kerusakan.after_or_equal' => 'Tanggal temuan kerusakan tidak boleh lebih kecil dari hari ini.',
            'tanggal_temuan_kerusakan.before_or_equal' => 'Tanggal temuan kerusakan tidak boleh lebih besar dari tanggal batas pengerjaan.',
            'tanggal_batas_pengerjaan.after_or_equal' => 'Tanggal batas pengerjaan tidak boleh lebih kecil dari tanggal temuan kerusakan.',
        ]);

        $data = PerbaikanGedung::where('id',$id)->first();
        if ($request->has('uploaded_pengerjaan_images')) {
                foreach ($request->uploaded_pengerjaan_images as $fileName) {
                    DetailPerbaikanKerusakan::create([
                        'perbaikan_gedung_id' => $data->id,
                        'file_path' => 'uploads/pengerjaan_perbaikan/' . $fileName,
                    ]);
                }
            }
        
        $data_form = [
            'keterangan_perbaikan'=>$request->keterangan_perbaikan,
            'tanggal_batas_pengerjaan'=>$request->tanggal_batas_pengerjaan,
        ];

        $data->update($data_form);
        return redirect()->to('pengerjaan_perbaikan')->with('success', 'Data Perbaikan berhasil diubah');

    }

    public function selesai_pengerjaan(Request $request, $id){
        $data = PerbaikanGedung::where('id', $id)->first();
        $data->status_perbaikan = "Selesai Pengerjaan";
        $data->tanggal_selesai_pengerjaan = now();
        $data->save();
        return redirect()->to('selesai_perbaikan')->with('success', 'Data Perbaikan Telah Selesai');
    }
}
