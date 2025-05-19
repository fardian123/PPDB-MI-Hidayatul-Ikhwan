<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class userController extends Controller
{

    public function userProfileStore(Request $request)
    {

        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'user Profile Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function userProfile()
    {
        return view('user.user_profile');
    }

    public function userHasilSeleksi(): mixed
    {
        $user = auth()->user(); // Ambil user login
        $pendaftaran = $user->pendaftaran; // Ambil relasi pendaftarannya

        return view('user.user_hasil_seleksi', compact('pendaftaran'));
    }

    public function userPendaftaran()
    {
        return view('user.user_pendaftaran');
    }

    public function userChangePassword()
    {
        $profileData = User::find(Auth::user()->id);

        return view('user.user_change_password', compact('profileData'));
    }

    public function userPasswordUpdate(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed|',

        ]);
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old password Doesnt match',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // update new password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Succes',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }


}
