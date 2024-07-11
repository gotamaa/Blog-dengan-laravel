<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function create(){
        return view('user\profile');
    }
    public function ganti_profile(Request $request){
        $request->validate([

            'image' => 'required','image','mimes:jpeg,png,jpg,gif','max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Simpan gambar di direktori penyimpanan
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Simpan path gambar ke database
            $user = User::find(auth()->user()->id);
            $user->image = "/images/". $imageName; // Sesuaikan dengan lokasi penyimpanan gambar Anda

            user::where('id', Auth::user()->id)
                ->update(['image' => $user->image]);
            return back()->with('success', 'Gambar berhasil diunggah.');
        } else {
            return back()->with('error', 'Gambar tidak ditemukan.');


    }
    }
}
