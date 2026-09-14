<?php

namespace App\Http\Controllers;

use App\Models\PerbaikanGedung;
use App\Models\Divisi;
use App\Models\User;
use App\Models\DetailTemuanKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PerbaikanGedungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */

    public function mulai_pengerjaan(Request $request, $id){
        $data = PerbaikanGedung::where('id', $id)->first();
        $data->status_perbaikan = "Dalam Pengerjaan";
        $data->save();
        return redirect()->to('pengerjaan_perbaikan')->with('success', 'Temuan kerusakan mulai diperbaiki');
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // 5MB max
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/temuan_kerusakan'), $filename);

            return response()->json(['fileName' => $filename]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function index()
    {
        $data = PerbaikanGedung::where('status_perbaikan','Draft')->orderBy('id','asc')->get();
        return view('pages.perbaikan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi_asal = Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $divisi_tujuan =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $user = User::where('is_active',True)->orderBy('id','asc')->get();
        return view('pages.perbaikan.create',compact('divisi_asal','divisi_tujuan','user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'tanggal_temuan_kerusakan' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:tanggal_batas_pengerjaan'],
        //     'tanggal_batas_pengerjaan'   => ['required', 'date', 'after_or_equal:tanggal_temuan_kerusakan'],
        // ],[
        //     'tanggal_temuan_kerusakan.after_or_equal' => 'Tanggal temuan kerusakan tidak boleh lebih kecil dari hari ini.',
        //     'tanggal_temuan_kerusakan.before_or_equal' => 'Tanggal temuan kerusakan tidak boleh lebih besar dari tanggal batas pengerjaan.',
        //     'tanggal_batas_pengerjaan.after_or_equal' => 'Tanggal batas pengerjaan tidak boleh lebih kecil dari tanggal temuan kerusakan.',
        // ]);

        try {
            $perbaikan_gedung = new PerbaikanGedung();
            $perbaikan_gedung->no_perbaikan = Str::upper(Str::random(4))."/".time();
            $perbaikan_gedung->nama_perbaikan = $request->nama_perbaikan;
            $perbaikan_gedung->user_id = $request->user_id;
            $perbaikan_gedung->divisi_asal_id = $request->divisi_asal_id;
            $perbaikan_gedung->divisi_tujuan_id = $request->divisi_tujuan_id;
            $perbaikan_gedung->lantai = $request->lantai;
            $perbaikan_gedung->status_perbaikan = 'Draft';
            $perbaikan_gedung->keterangan_temuan = $request->keterangan_temuan;
            $perbaikan_gedung->tanggal_temuan_kerusakan = $request->tanggal_temuan_kerusakan;
            # $perbaikan_gedung->tanggal_batas_pengerjaan = $request->tanggal_batas_pengerjaan;

            $saved = $perbaikan_gedung->save();

            if (!$saved) {
                return back()->withErrors(['error' => 'Gagal menyimpan temuan kerusakan']);
            }

            if ($request->has('uploaded_temuan_kerusakan_images')) {
                foreach ($request->uploaded_temuan_kerusakan_images as $fileName) {
                    DetailTemuanKerusakan::create([
                        'perbaikan_gedung_id' => $perbaikan_gedung->id,
                        'file_path' => 'uploads/temuan_kerusakan/' . $fileName,
                    ]);
                }
            }


            return redirect()->to('perbaikan')->with('success', 'Data temuan kerusakan berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saving Perbaikan Gedung: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PerbaikanGedung $perbaikanGedung)
    {
        $data = $perbaikanGedung;
        $divisi_asal =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $divisi_tujuan =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $user = User::where('is_active',True)->orderBy('id','asc')->get();
        
        $imagePerbaikanUrls = [];

        if ($perbaikanGedung->detail_temuan_kerusakan_images) {
            
            $imagePerbaikanUrls = [];

            if ($perbaikanGedung->detail_temuan_kerusakan_images) {
                foreach (json_decode($perbaikanGedung->detail_temuan_kerusakan_images) as $file) {
                    $imagePerbaikanUrls[] = asset($file->file_path);
                }
            }            
        }
        
        return view('pages.perbaikan.show',compact('data','divisi_asal','divisi_tujuan','user','imagePerbaikanUrls'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data = PerbaikanGedung::where('id',$id)->first();
        $divisi_asal =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $divisi_tujuan =  Divisi::where('is_active',True)->orderBy('id','asc')->get();
        $user = User::where('is_active',True)->orderBy('id','asc')->get();
        
        $imagePerbaikanEditableUrls = [];

        if ($data->detail_temuan_kerusakan_images) {
            
            $imagePerbaikanEditableUrls = [];

            if ($data->detail_temuan_kerusakan_images) {
                foreach (json_decode($data->detail_temuan_kerusakan_images) as $file) {
                    $imagePerbaikanEditableUrls[] = asset($file->file_path);
                }
            }            
        }
        
        return view('pages.perbaikan.edit',compact('data','divisi_asal','divisi_tujuan','user','imagePerbaikanEditableUrls'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerbaikanGedung $perbaikanGedung,  String $id)
    {
        $data = PerbaikanGedung::where('id',$id)->first();
        if ($request->has('uploaded_perbaikan_editable_images')) {
                foreach ($request->uploaded_perbaikan_editable_images as $fileName) {
                    DetailTemuanKerusakan::create([
                        'perbaikan_gedung_id' => $data->id,
                        'file_path' => 'uploads/temuan_kerusakan/' . $fileName,
                    ]);
                }
            }
        
        $data_form = [
            'nama_perbaikan'=>$request->nama_perbaikan,
            'lantai'=>$request->lantai,
            'divisi_tujuan_id'=>$request->divisi_tujuan_id,
            'tanggal_temuan_kerusakan'=>$request->tanggal_temuan_kerusakan,
            'tanggal_batas_pengerjaan'=>$request->tanggal_batas_pengerjaan,
            'keterangan_temuan'=>$request->keterangan_temuan,
        ];

        $data->update($data_form);
        return redirect()->to('perbaikan')->with('success', 'Data temuan kerusakan berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerbaikanGedung $perbaikanGedung, String $id)
    {
        $data = PerbaikanGedung::where('id',$id)->first();
        $data->delete();
        return redirect()->to('perbaikan')->with('success', 'Data temuan kerusakan berhasil dihapus');

    }
}
