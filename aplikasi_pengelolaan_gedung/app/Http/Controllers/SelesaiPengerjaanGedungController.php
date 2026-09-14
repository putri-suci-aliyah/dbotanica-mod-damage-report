<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPerbaikanKerusakan;
use App\Models\DetailTemuanKerusakan;
use App\Models\PerbaikanGedung;
use App\Models\Divisi;
use App\Models\User;

class SelesaiPengerjaanGedungController extends Controller
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
        $data = PerbaikanGedung::where('status_perbaikan','Selesai Pengerjaan')->orderBy('id','asc')->get();
        return view('pages.selesai.index')->with('data', $data);
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


        $imageSelesaiPerbaikanUrls = [];
        if ($data->detail_perbaikan_kerusakan_images) {
            
            $imageSelesaiPerbaikanUrls = [];

            if ($data->detail_perbaikan_kerusakan_images) {
                foreach (json_decode($data->detail_perbaikan_kerusakan_images) as $file) {
                    $imageSelesaiPerbaikanUrls[] = asset($file->file_path);
                }
            }            
        }
        
        return view('pages.selesai.show',compact('data','divisi_asal','divisi_tujuan','user','imagePerbaikanUrls','imageSelesaiPerbaikanUrls'));

    }
}
