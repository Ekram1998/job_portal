<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;
use Alert;

class AccountController extends Controller
{
    public function registration()
    {
        return view('front.account.registration');
    }
    // this method will be save
    public function processReg(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:15',
            'confirm_password' => 'required|same:password'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Alert::success('success', 'Successfully Registered.Now try to Login');
        return redirect()->route('account.login');
    }
    public function login()
    {
        return view('front.account.login');
    }
    public function authenticate(Request $request)
    {
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credential)) {
            Alert::success('success', 'Login Successfully');
            return redirect()->route('account.myaccount');
        } else {
            Alert::info('error', 'Error Email Or Password.');
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

    // My Account
    public function myaccount()
    {
        $id = Auth::user()->id;
        // $user = user::find($id);
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('front.account.myaccount', [
            'user' => $user
        ]);
    }

    public function updateaccount(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->mobile = $request->mobile;
        $user->save();

        Alert::success('Success', 'Profile Updated Successfully.');
        return redirect()->route('account.myaccount')->with('success', 'Account Updated');
    }
    // User::where('id', $id)->update(['image' => $imageName]);
    public function updateProfilePic(Request $request)
    {

        // Get the currently authenticated user's ID
        $id = Auth::user()->id;

        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $ext;

            // Move the image to the public/profile_pic directory
            $image->move(public_path('/profile_pic/'), $imageName);

            // old picture delete & new picture up
            File::delete(public_path('/profile_pic/' . Auth::user()->image));

            // Update the user's profile picture in the database
            User::where('id', $id)->update(['image' => $imageName]);

            // Return a success message
            return back()->with('success', 'Profile Picture Updated');
        } else {
            // Return an error message if the image upload fails
            return back()->with('error', 'Profile Picture upload failed.');
        }
    }

    // password update
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ],[
            'old_password.required' => 'Please enter your old password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'confirm_password.required' => 'Please confirm your new password.',
            'confirm_password.same' => 'The new password and confirmation do not match.',
        ]);

        // Check if the old password matches
        if (Hash::check($request->old_password, Auth::user()->password) == false) {
            return redirect()->back()->with('error','Incarrect password');
        }

        // Update the user's password
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Success', 'Password Updated Successfully.');
        return redirect()->back();
    }
}
