<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Enums\WalletType;
use App\Models\WalletHistory;
use App\Models\WalletLog;
use App\Models\Prefixes;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function purchaseWalletDeposit(){
        return view('member.purchase-wallet.deposit');
    }


    public function purchaseWalletTopup(){
        return view('member.purchase-wallet.topup');
    }
    public function purchaseWalletTopupStore(Request $request){
        if(Auth::user()->role == 'user'){
            dd('user');
        }else{
            dd('admin');
        }
        return redirect()->back()->with('success', 'Topup Request Successful');
    }



    public function purchaseWalletWithdraw(){
        $user = Auth::user();
        return view('member.purchase-wallet.withdraw', compact('user'));
    }

    public function cashWallet(){
        return view('member.cash_wallet');
    }
    public function productWallet(){
        return view('member.product_wallet');
    }

    public function pendingDeposit(){
        return view('admin.purchase-wallet.pending_deposit');
    }
    public function pendingWithdrawal(){
        return view('admin.purchase-wallet.pending_withdrawal');
    }
}
