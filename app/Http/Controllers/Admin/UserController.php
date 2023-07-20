<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};


class UserController extends Controller
{
    public function memberList(){
        $states = State::select('id', 'name')->get();

        $members = User::where('role', 'user')
        ->orWhere('role', 'admin')
        ->get(['referral', 'referrer', 'name', 'email', 'ranking_name', 'city', 'postcode', 'state', 'created_at']);
        // dd($members);
        return view('admin.members.list', compact('members', 'states'));
    }
}
