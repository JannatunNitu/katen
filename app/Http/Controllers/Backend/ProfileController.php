<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function ShowProfile(){
        return view('backend.profile');
    }

    function UpdateProfile(request $request)
    {
        $request->validate(
            [
              'name'=> 'required|max:30',
              'email' => 'required|email|unique:users,email,'.auth()->user()->id,
              "profile_img" => "nullable|mimes:jpg,png"
            ],
         [
             'name.required' => "Enter your user name",
             'email.required' => 'The email has already taken',
         ]);
         
         // *IMAGE DATA UPDATE
         if($request->hasFile('profile_img')){
             $ext = $request->profile_img->extension();
             $img_name = auth()->user()->name . '-' . Carbon::now()->format('d-m-y-h-m-s') . '.' .$ext ;
             $request->profile_img->storeAs('users', $img_name, 'public');
         }
     
         //*USER DATA UPDATE
         $user = User::find(auth()->user()->id);
         $user->name = $request->name;
         $user->email = $request->email;
         $user->profile_img = $img_name;
         $user->save();
         return back();
        //  dd($request->all());
        //  if($request->hasFile('profile_img')){
        //      echo "yes";
        //      } else{
        //          echo "no";
        //      }
         }
      


    // Password update
    function UpdatePassword(Request $request)
    {
        $request->validate([
            'old' => 'required|current_password',
            'password' => 'required|confirmed|different:old',
            'password_confirmation' => 'required'
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back();
    }
    
}
