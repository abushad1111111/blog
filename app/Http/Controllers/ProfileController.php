<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile(){
        $profile = User::find(1);
        return view('backend.profile.show', compact('profile'));
    }

    public function updateProfile(Request $request, $id){
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string',
            'phone' => 'string',
            'address' => 'string',
            'company' => 'string',
            'country' => 'string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|dimensions:width=120,height=120|max:2048', 
        ]);

        $user = User::findOrFail($id);
        $userData = $request->only(['name', 'email', 'phone', 'address', 'company', 'country']);

        if ($request->hasFile('profile_image')) {

            if($user->profile_image){
                Storage::disk('public')->delete($user->profile_image);
            }

            $filePath = Storage::disk('public')->put('images/profile', request()->file('profile_image'), 'public');
            $userData['profile_image'] = $filePath;
        }

        $user->update($userData);
        return redirect()->route('show.profile')->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(1);
        $plainPassword = $request->password;

        if (Hash::check($plainPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('show.profile')->with('success', 'Password changed successfully!');
        }else{
            return redirect()->route('show.profile')->with('error', 'Password is not matched!');
        }    
    }
}
