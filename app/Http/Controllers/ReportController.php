<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\WalletHistory;
use App\Models\RankingUpdateLog;
use Auth;

class ReportController extends Controller
{
    public function reportSales() {
        $role = Auth::user()->role;

        if($role == 'user'){
            $orders = Order::where('user_id', Auth::id())->latest()->get();
            return view('member.reports.sales', compact('orders'));
        }else if ($role == 'admin' || $role == 'superadmin'){
            $orders = Order::latest()->get();
            return view('admin.reports.sales', compact('orders'));
        }else{
            return abort (404);
        }

    }
    public function reportDownlineSales() {
        $users = User::where('upline_id', Auth::id())
            ->whereHas('orders') // Make sure the relationship method name is correct
            ->get();

            // dd($users[0]->orders);
        return view('member.reports.downline_sales', compact('users'));
    }
    public function reportLeadership() {
        return view('member.reports.leadership');
    }
    public function reportLevelling() {
        return view('member.reports.levelling');
    }
    public function reportWallet() {
        $role = Auth::user()->role;
        if($role == 'user'){
            $rows = WalletHistory::where('user_id', Auth::id())->latest()->get();
            return view('member.reports.wallet', compact('rows'));
        }else if ($role == 'admin' || $role == 'superadmin'){
            $rows = WalletHistory::latest()->with(['user'])->get();

            return view('admin.reports.wallet', [
                'rows' => $rows,
            ]);
        }else{
            return abort (404);
        }
    }

    public function monthlyCommissionReport() {
        $role = Auth::user()->role;
        if($role == 'user'){
            return view('member.reports.monthly_commission');
        }else if ($role == 'admin' || $role == 'superadmin'){
            return view('admin.reports.monthly_commission');
        }else{
            return abort (404);
        }
    }
    public function quarterlyCommissionReport() {
        $role = Auth::user()->role;
        if($role == 'user'){
            return view('member.reports.quarterly_commission');
        }else if ($role == 'admin' || $role == 'superadmin'){
            return view('admin.reports.quarterly_commission');
        }else{
            return abort (404);
        }
    }
    public function annuallyCommissionReport() {
        $role = Auth::user()->role;
        if($role == 'user'){
            return view('member.reports.annually_commission');
        }else if ($role == 'admin' || $role == 'superadmin'){
            return view('admin.reports.annually_commission');
        }else{
            return abort (404);
        }
    }
    public function performanceBonusReport() {
        $role = Auth::user()->role;
        if($role == 'user'){
            return view('member.reports.performance_bonus');
        }else if ($role == 'admin' || $role == 'superadmin'){
            return view('admin.reports.performance_bonus');
        }else{
            return abort (404);
        }
    }

    public function reportRanking()
    {

        $rankingLog = RankingUpdateLog::get();
        // dd($rankingLog);

        return view('admin.reports.ranking', [
            'rankings' => $rankingLog,
        ]);
    }
}
