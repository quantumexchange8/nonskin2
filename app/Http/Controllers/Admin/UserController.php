<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function memberList(){
        $states = State::select('id', 'name')->get();

        // $users = DB::table('users')
        //     ->where('role', 'user')
        //     ->orWhere('role', 'admin')
        //     ->get();


        // dd($users);

        $users = User::with('address')
        ->where('role', 'user')
        ->orWhere('role', 'admin')
        ->get(['referral', 'referrer', 'name', 'email', 'ranking_name', 'postcode', 'city', 'state', 'created_at']);
        // dd($users);
        return view('admin.members.list', compact('users', 'states'));
    }
}
