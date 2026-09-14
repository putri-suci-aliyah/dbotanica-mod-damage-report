<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerbaikanGedung;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();

        if ($user->is_super_admin) {
            $data_draft = $data = PerbaikanGedung::where('status_perbaikan','Draft')->orderBy('id','asc')->get();
            $data_sedang_diperbaiki = PerbaikanGedung::where('status_perbaikan','Dalam Pengerjaan')->orderBy('id','asc')->get();
            $data_selesai_pengerjaan = PerbaikanGedung::where('status_perbaikan','Selesai Pengerjaan')->orderBy('id','asc')->get();
            $data_keseluruhan = $data = PerbaikanGedung::all();
        }else{
            $data_draft = $data = PerbaikanGedung::where('status_perbaikan','Draft')->where('divisi_tujuan_id',$user->divisi->id)->orderBy('id','asc')->get();
            $data_sedang_diperbaiki = PerbaikanGedung::where('status_perbaikan','Dalam Pengerjaan')->where('divisi_tujuan_id',$user->divisi->id)->orderBy('id','asc')->get();
            $data_selesai_pengerjaan = PerbaikanGedung::where('status_perbaikan','Selesai Pengerjaan')->where('divisi_tujuan_id',$user->divisi->id)->orderBy('id','asc')->get();
            $data_keseluruhan = $data = PerbaikanGedung::where('divisi_tujuan_id',$user->divisi->id)->orderBy('id','asc')->get();
        }
        

        return view('pages.dashboard.index',compact('data_draft','data_sedang_diperbaiki','data_selesai_pengerjaan','data_keseluruhan'));

    }
}
