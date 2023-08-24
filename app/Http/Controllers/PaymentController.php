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
Use Alert;

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

        return view('member.purchase-wallet.topup', [
            'companyInfo' => $companyInfo,
        ]);
    }
    public function purchaseWalletTopupStore(Request $request){
        if(Auth::user()->role == 'user'){
            // dd($request->all());
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

                Alert::success('Successfully', 'Submitted Deposit');
                return redirect()->back();
            } else {
                Alert::error('Error', 'No Image Uploaded');
                return redirect()->back();
            }
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

        $user = Auth::user();

        $deposits = Payment::where('type', 'Deposit')->get();
        
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

        $transactionPrefix = 'NONT';
        $prefixRow2 = Prefix::where('prefix', $transactionPrefix)->first();

        $newTransactionNumber = $prefixRow2->counter + 1;
        $prefixRow2->update(
            [
                'counter' => $newTransactionNumber,
                'updated_by' => Auth::id()
            ]
        );

        $wallet = new WalletHistory();    
        $wallet->user =  $user_wallet->id;
        $wallet->wallet_type = 'purchase_wallet';
        $wallet->type = 'deposit';
        $wallet->cash_in = $deposit->amount;
        $wallet->cash_out = null;
        $wallet->balance = $user_wallet->purchase_wallet;
        $wallet->updated_at = now();
        $wallet->remarks = $transactionPrefix . str_pad($newTransactionNumber, $prefixRow2->padding, '0', STR_PAD_LEFT);
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
        return view('admin.purchase-wallet.pending_withdrawal');
    }
}
