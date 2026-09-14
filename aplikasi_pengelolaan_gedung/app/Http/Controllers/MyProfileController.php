<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(string $id)
    {
        $data = User::where('id',$id)->first();
        $divisi = Divisi::where('is_active',TRUE)->orderBy('id','asc')->get();
        return view('pages.profile.edit',compact('data','divisi'));
    }

    public function update(Request $request, string $id)
    {
        $data = User::where('id',$id)->first();
        $data_form = [
            'password'=> Hash::make($request->password),            
        ];
        
        $data->update($data_form);

        request()->session()->invalidate();  // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate CSRF token for security
        return redirect('/login');
    }

}
