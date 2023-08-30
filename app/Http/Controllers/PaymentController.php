<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Enums\WalletType;
use App\Models\WalletHistory;
use App\Models\WalletLog;
use App\Models\Prefix;
use App\Models\Payment;
use App\Models\User;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
Use Alert;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function purchaseWalletDeposit(){

        $user = Auth::user();

            $deposits = Payment::where('type', 'Deposit')
                            ->where('user_id', $user->id)
                            ->get();
            return view('member.purchase-wallet.deposit', [
                'deposits' => $deposits,
            ]);
    }


    public function purchaseWalletTopup(){

        $companyInfo = CompanyInfo::first();

        if(Auth::user()->role == 'user'){
            return view('member.purchase-wallet.topup', [
                'companyInfo' => $companyInfo,
            ]);
        }else if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
            $members = User::where('role', 'user')->where('status', 'Active')->select('id', 'full_name', 'referrer_id')->orderBy('referrer_id', 'ASC')->get();
            return view('admin.purchase-wallet.new_topup', compact('companyInfo', 'members'));
        }else{
            return abort (404);
        }
    }

    public function purchaseWalletTopupAdmin(Request $request){
        // dd($request->all());
        $user = User::where('id', $request->user_id)->first();
        // dd($user);
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        if(Auth::user()->role == 'admin'){
            // dd($request->all());
            $transactionPrefix = 'NONT';
            $prefixRow2 = Prefix::where('prefix', $transactionPrefix)->first();

            try {
                $newTransactionNumber = $prefixRow2->counter + 1;
                $prefixRow2->update(
                    [
                        'counter' => $newTransactionNumber,
                        'updated_by' => Auth::id()
                    ]
                );

                $payment = Payment::create([
                    'payment_num' => $transactionPrefix . str_pad($newTransactionNumber, $prefixRow2->padding, '0', STR_PAD_LEFT),
                    'type' => PaymentType::DEPOSIT,
                    'payment_method' => 'none',
                    'user_id' => $user->id,
                    'amount' => $request->amount,
                    'gateway' => null,
                    'status' => 'Approved',
                    'remarks' => 'Topped up by Admin',
                    'receipt' => null,
                    'bank_name' => $user->bank_name,
                    'bank_holder_name' => $user->bank_holder_name,
                    'bank_acc_no' => $user->bank_acc_no,
                    'bank_ic' => $user->bank_ic,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);

                if($payment->wasRecentlyCreated){
                    $user->purchase_wallet += $request->amount;
                    $user->save();

                    WalletHistory::create([
                        'user_id' => $user->id,
                        'wallet_type' => WalletType::PURCHASE_WALLET,
                        'type' => PaymentType::DEPOSIT,
                        'cash_in'  => $request->amount,
                        'balance' => $user->purchase_wallet,
                        'remarks' => $request->remarks !== null ? $request->remarks : 'Topped up by Admin',
                    ]);
                }

                Alert::success('Topup Successful', 'Purchase Wallet for '. $user->referrer_id . ' | ' . $user->full_name . ' has been topped up RM ' . number_format($request->amount,2));
                return redirect()->back();
            } catch (\Throwable $th) {
                Alert::error('Topup Failed', 'Please try topup later');
                return redirect()->back();
            }

        }else{
            redirect(RouteServiceProvider::HOME);
        }
    }

    public function purchaseWalletTopupStore(Request $request){
        if(Auth::user()->role == 'user'){
            try {
                // dd($request->all());
                DB::beginTransaction();
                $transactionPrefix = 'NONT';
                $prefixRow2 = Prefix::where('prefix', $transactionPrefix)->first();

                $newTransactionNumber = $prefixRow2->counter + 1;
                $prefixRow2->update(
                    [
                        'counter' => $newTransactionNumber,
                        'updated_by' => Auth::id()
                    ]
                );

                if($request->hasFile('receipt') != null) {
                    $request->validate([
                        'receipt' => 'image|max:2048', // Adjust the allowed mime types and file size as needed
                    ]);
                }

                if ($request->hasFile('receipt')){
                    $imageName1 = null; // Initialize the variable
                    $imageName1 = time().'.'.$request->receipt->extension();
                    $request->receipt->move(public_path('images/payment-proof'), $imageName1);

                    $payment                = new Payment();
                    $payment->payment_num   = $transactionPrefix . str_pad($newTransactionNumber, $prefixRow2->padding, '0', STR_PAD_LEFT);
                    $payment->type          = 'Deposit';
                    $payment->payment_method = 'Manual Transfer';
                    $payment->user_id       = Auth::id();
                    $payment->amount        = $request->amount;
                    $payment->gateway       = null;
                    $payment->status        = 'Pending';
                    $payment->remarks       = $request->remark ?: null;
                    $payment->receipt       = $imageName1;
                    $payment->save();
                    DB::commit();

                    Alert::success('Successfully', 'Submitted Deposit');
                    return redirect()->back();
                } else {
                    Alert::error('Error', 'No Image Uploaded');
                    return redirect()->back();
                }
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::error('Error', 'Please try deposit again');
                return redirect()->back();
            }
        }else{
            redirect(RouteServiceProvider::HOME);
        }
        return redirect()->back()->with('success', 'Topup Request Successful');
    }



    public function purchaseWalletWithdraw(){
        $user = Auth::user();
        $withdrawals = Payment::where('type', PaymentType::WITHDRAW)
                            ->where('user_id', $user->id)
                            ->get();
        return view('member.purchase-wallet.withdraw', compact('user', 'withdrawals'));
    }

    public function purchaseWalletWithdrawStore(Request $request, Payment $withdraw){
        // dd(floatval($request->amount));
        $user = Auth::user();

        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        if(Auth::user()->role == 'user'){
            // dd($request->all());
            $transactionPrefix = 'NONT';
            $prefixRow2 = Prefix::where('prefix', $transactionPrefix)->first();

            try {
                $newTransactionNumber = $prefixRow2->counter + 1;
            $prefixRow2->update(
                [
                    'counter' => $newTransactionNumber,
                    'updated_by' => Auth::id()
                ]
            );

            $payment = Payment::create([
                'payment_num' => $transactionPrefix . str_pad($newTransactionNumber, $prefixRow2->padding, '0', STR_PAD_LEFT),
                'type' => PaymentType::WITHDRAW,
                'payment_method' => 'none',
                'user_id' => $user->id,
                'amount' => $request->amount,
                'gateway' => null,
                'status' => 'Pending',
                'remarks' => null,
                'receipt' => null,
                'bank_name' => $user->bank_name,
                'bank_holder_name' => $user->bank_holder_name,
                'bank_acc_no' => $user->bank_acc_no,
                'bank_ic' => $user->bank_ic,
                'created_by' => $user->id,
                'updated_by' => $user->id
            ]);

            if($payment->wasRecentlyCreated){
                $user->purchase_wallet -= $request->amount;
                $user->save();

                WalletHistory::create([
                    'user_id' => $user->id,
                    'wallet_type' => WalletType::PURCHASE_WALLET,
                    'type' => PaymentType::WITHDRAW,
                    'cash_out'  => $request->amount,
                    'balance' => $user->purchase_wallet,
                    'remarks' => $payment->payment_num,
                ]);
            }

            Alert::success('Successfully', 'Submitted Withdrawal');
            return redirect()->back();
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Please try withdrawing later');
            }

        }else{
            redirect(RouteServiceProvider::HOME);
        }
        return back()->with('success', 'Topup Request Successful');
    }

    public function cashWallet(){
        return view('member.cash_wallet');
    }
    public function productWallet(){
        return view('member.product_wallet');
    }

    public function pendingDeposit(){

        $user = Auth::user();

        $deposits = Payment::where('type', 'Deposit')->latest()->get();

        return view('admin.purchase-wallet.pending_deposit', [
            'deposits' => $deposits,
        ]);
    }

    public function approveDeposit(Request $request, Payment $deposit)
    {

        $deposit->update([
            'status' => 'Approved',
            'remarks' => null
        ]);

        $user_wallet = User::find($deposit->user_id);

        if ($user_wallet) {
            // Update the user's personal_sales with the order's total_amount
            $user_wallet->purchase_wallet += $deposit->amount;
            $user_wallet->save();
        }

        $wallet = new WalletHistory();
        $wallet->user_id =  $user_wallet->id;
        $wallet->wallet_type = WalletType::PURCHASE_WALLET  ;
        $wallet->type = PaymentType::DEPOSIT;
        $wallet->cash_in = $deposit->amount;
        $wallet->cash_out = null;
        $wallet->balance = $user_wallet->purchase_wallet;
        $wallet->updated_at = now();
        $wallet->remarks = $deposit->payment_num;
        $wallet->save();

        Alert::success('Updated', 'the deposit approved');
        return redirect()->back();
    }

    public function newpayslip(Request $request, Payment $row)
    {
        if($request->hasFile('newpayslip') != null) {
            $request->validate([
                'newpayslip' => 'nullable|image|max:2048', // Adjust the allowed mime types and file size as needed
            ]);
        }

        $imageName1 = null; // Initialize the variable

        if ($request->hasFile('newpayslip')){
            $imageName1 = time().'.'.$request->newpayslip->extension();
            $request->newpayslip->move(public_path('images/payment-proof'), $imageName1);

            $row->receipt = $imageName1;
            $row->status = 'Pending';
            $row->remarks = null;
            $row->save();

            Alert::success('Updated', 'the new receipt');
            return redirect()->back();
        } else {
            Alert::error('Failed', 'no image founded');
            return redirect()->back();
        }

    }

    public function rejectDeposit(Request $request, Payment $deposit)
    {

        $deposit->update([
            'status' => 'Failed',
            'remarks' => $request->remark
        ]);

        Alert::success('Updated', 'the deposit status');
        return redirect()->back();
    }

    public function pendingWithdrawal(){
        $withdrawals = Payment::where('type', PaymentType::WITHDRAW)->get();
        return view('admin.purchase-wallet.pending_withdrawal', compact('withdrawals'));
    }
    public function approveWithdrawal(Request $request, Payment $withdraw) {
        // dd($withdraw);
        if ($withdraw->status !== 'Failed') {
            try {
                DB::beginTransaction();
                $withdraw->update([
                    'status' => 'Approved',
                    'remarks' => 'Withdrawal has been approved'
                ]);

                DB::commit();

                Alert::success('Approved', 'The withdrawal request has been approved successfully.');
                return redirect()->back();
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::error('Failed', 'An error occurred while approving the withdrawal request.');
                return redirect()->back();
            }
        } else {
            Alert::error('Failed to Approve', 'The withdrawal request has already been rejected.');
            return redirect()->back();
        }
    }

    public function rejectWithdrawal(Request $request, Payment $withdraw){
        //rejects user's withdrawal request and add the amount back to the user's purchase_wallet
        $user = User::where('id', $request->user_id)->first();
        // dd($withdraw);
        if($withdraw->status != 'Failed'){
            try {
                DB::beginTransaction();

                $withdraw->update([
                    'status' => PaymentStatus::FAILED,
                    'remarks' => $request->remark
                ]);

                WalletHistory::create([
                    'user_id' => $request->user_id,
                    'wallet_type' => WalletType::PURCHASE_WALLET,
                    'type' => PaymentType::DEPOSIT,
                    'cash_in' => $request->amount,
                    'balance' => $user->purchase_wallet + $request->amount,
                    'remarks' => 'Withdrawal rejected'

                ]);

                $user->purchase_wallet += $request->amount;
                $user->update();

                DB::commit();

                Alert::success('Updated', 'the withdrawal status');
                return redirect()->back();
            } catch (\Throwable $th) {
                DB::rollback();
                Alert::error('Failed', 'The withdrawal request is failed to reject');
                return redirect()->back();
            }
        }else{
            Alert::error('Failed', 'The withdrawal request has already been rejected');
                return redirect()->back();
        }
    }

}
