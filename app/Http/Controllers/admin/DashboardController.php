<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function userIndex()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.users.list', [
            'users' => $users,
        ]);
    }
}
