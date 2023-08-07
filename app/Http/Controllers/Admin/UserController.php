<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\BankSetting;
use App\Models\ShippingCharge;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};
use Illuminate\Support\Facades\DB;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        ->get(['upline_id', 'referrer_id', 'name', 'email', 'ranking_name', 'postcode', 'city', 'state', 'created_at']);
        // dd($users);
        return view('admin.members.list', compact('users', 'states'));
    }

    public function categorySettings() {
        $categories = Category::get();
        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.categories', compact('categories'));
    }
    public function categoryStore(Request $request) {
        $categoryData = $request->only('id', 'name_en', 'name_cn', 'status', 'remarks', 'created_by', 'created_at', 'updated_by', 'updated_at');
        // dd($categoryData);
        $category = Category::updateOrCreate(
            ['id' => $categoryData['id']],
            [
                'name_en'    => $categoryData['name_en'],
                'name_cn'    => $categoryData['name_cn'],
                'status'     => $categoryData['status'],
                'remarks'    => $categoryData['remarks'] ?? 'Nonskin',
                'created_by' => $categoryData['created_by'] ?? Auth::id(),
                'created_at' => $categoryData['created_at'] ?? now(),
                'updated_by' => Auth::id(),
                'updated_at' => now()
            ]);
        if ($category->wasRecentlyCreated){
            return redirect()->back()->with('created', 'Category created successfully');
        }else{
            return redirect()->back()->with('updated', 'Category updated successfully');
        }
    }
    public function categoryDestroy(Category $category) {
        $category->delete();
        return redirect()->back()->with('deleted', 'Category deleted successfully');
    }

    public function shippingCharges() {
        $res = ShippingCharge::get();
        $title = 'Delete Shipping Charge!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.shipping-charges', compact('res'));
    }
    public function chargeStore(Request $request) {
        $chargeData = $request->only('id', 'name', 'amount', 'created_by', 'created_at', 'updated_by', 'updated_at');
        // dd($chargeData);
        $charge = ShippingCharge::updateOrCreate(
            ['id' => $chargeData['id']],
            [
                'name'    => $chargeData['name'],
                'amount'    => $chargeData['amount'],
                'created_by' => $chargeData['created_by'] ?? Auth::id(),
                'created_at' => $chargeData['created_at'] ?? now(),
                'updated_by' => Auth::id(),
                'updated_at' => now()
            ]);
        if ($charge->wasRecentlyCreated){
            return redirect()->back()->with('created', 'Category created successfully');
        }else{
            return redirect()->back()->with('updated', 'Category updated successfully');
        }
    }
    public function chargeDestroy(ShippingCharge $charge) {
        $charge->delete();
        return redirect()->back()->with('deleted', 'Category deleted successfully');
    }

    public function bankSettings() {
        $banks = BankSetting::get();
        $title = 'Delete Bank!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.banks', compact('banks'));
    }
    public function bankStore(Request $request) {
        $bankData = $request->only('id', 'name', 'created_by', 'created_at', 'updated_by', 'updated_at');
        // dd($bankData);
        $bank = BankSetting::updateOrCreate(
            ['id' => $bankData['id']],
            [
                'name'       => $bankData['name'],
                'created_by' => $bankData['created_by'] ?? Auth::id(),
                'created_at' => $bankData['created_at'] ?? now(),
                'updated_by' => Auth::id(),
                'updated_at' => now()
            ]);
        if ($bank->wasRecentlyCreated){
            return redirect()->back()->with('created', 'Category created successfully');
        }else{
            return redirect()->back()->with('updated', 'Category updated successfully');
        }
    }
    public function bankDestroy(BankSetting $bank) {
        $bank->delete();
        return redirect()->back()->with('deleted', 'Category deleted successfully');
    }

    public function companyInfo() {
        $infos = CompanyInfo::get();
        return view('admin.settings.company-info', compact('infos'));
    }
}
