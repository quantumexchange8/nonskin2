<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function memberList(){
        $members = User::where('role', 'user')
        ->orWhere('role', 'admin')
        ->get();
        // dd($members);
        return view('admin.members.list', compact('members'));
    }
}
