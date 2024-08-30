<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at','DESC')->paginate(5);
        return view('admin.users.list',[
            'users'=>$users,
        ]);
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit',['user'=>$user]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id.',id',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->designation = $request->designation;
        $user->save();


        Alert::success('Success','User Successfully Updated.');
        return redirect()->route('admin.userslist');
    }
    public function destroy(Request $request){
        $user = User::find($request->id);
        $user->delete();


        Alert::info('Info','User Deleted.');
        return redirect()->route('admin.userslist');
    }

}
