<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function show(){
        return view('user\profile');
    }
    public function bio(Request $request){
        $request->validate([
            'bio' => 'required',
        ]);
        user::where('id', Auth::user()->id)
            ->update(['bio' => $request->bio]);
        return to_route('profile');
    }
    public function update_picture(Request $request){
        $request->validate([

            'image' => 'required','image','mimes:jpeg,png,jpg,gif','max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Simpan gambar di direktori penyimpanan
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Simpan path gambar ke database
            $user = User::find(auth()->user()->id);
            $user->avatar = "/images/". $imageName; // Sesuaikan dengan lokasi penyimpanan gambar Anda

            user::where('id', Auth::user()->id)
                ->update(['avatar' => $user->avatar]);
            return back()->with('success', 'Gambar berhasil diunggah.');
        }
        else
        {
        return back()->with('error', 'Gambar tidak ditemukan.');
    }
    }
    public function delete_picture(){
        $imageName='DefaultProfile.png';
        $user = User::find(auth()->user()->id);
            $user->avatar = "/images/". $imageName; // Sesuaikan dengan lokasi penyimpanan gambar Anda

            user::where('id', Auth::user()->id)
                ->update(['avatar' => $user->avatar]);
            return to_route('profile')->with('success', 'Gambar berhasil dihapus.');
    }

    public function publicprofile($username){
        $user = User::where('username', $username)->first();
        return view('user\publicprofile', compact('user'));
    }
}
