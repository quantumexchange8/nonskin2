<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\BankSetting;
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

    public function categorySettings() {
        $categories = Category::get();
        return view('admin.settings.categories', compact('categories'));
    }

    public function companyInfo() {
        $infos = CompanyInfo::get();
        return view('admin.settings.company-info', compact('infos'));
    }

    public function bankSettings() {
        $banks = BankSetting::get();
        return view('admin.settings.banks', compact('banks'));
    }
}
