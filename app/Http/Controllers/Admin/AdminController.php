<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\BankSetting;
use App\Models\ShippingCharge;
use App\Models\Order;
use App\Models\OrderItem;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City};
use Illuminate\Support\Facades\DB;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function memberList(){
        $states = State::select('id', 'name')->get();

        // $users = DB::table('users')
        //     ->where('role', 'user')
        //     ->orWhere('role', 'admin')
        //     ->get();

        // dd($users);

        // $users = User::with(['address', 'upline'])
        // ->where('role', 'user')
        // ->orWhere('role', 'admin')
        // ->get(['upline_id', 'referrer_id', 'name', 'email', 'ranking_name', 'postcode', 'city', 'state', 'created_at']);

        $users = User::where('role', 'user')->get();
        // dd($users);
        return view('admin.members.listing', compact('users', 'states'));
    }

    public function categorySettings() {
        $categories = Category::get();
        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.categories', compact('categories'));
    }
    public function categoryStore(Request $request) {
        $categoryData = $request->only('id', 'name_en', 'name_cn', 'status', 'remarks');
        // dd($categoryData);
        $category = Category::find($categoryData['id']);
        $category = Category::updateOrCreate(
            ['id' => $categoryData['id']],
            [
                'name_en'    => $categoryData['name_en'],
                'name_cn'    => $categoryData['name_cn'],
                'status'     => $categoryData['status'],
                'remarks'    => $categoryData['remarks'] ?? 'Nonskin',
                'created_by' => $category->created_by ?? Auth::id(),
                'created_at' => $category->created_at ?? now(),
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
        return redirect()->back()->with('deleted', 'Category has been deleted');
    }

    public function shippingCharges() {
        $res = ShippingCharge::get();
        $title = 'Delete Shipping Charge!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.shipping-charges', compact('res'));
    }
    public function chargeStore(Request $request) {
        $chargeData = $request->only('id', 'name', 'amount');
        // dd($chargeData);
        $charge = ShippingCharge::find($chargeData['id']);
        $charge = ShippingCharge::updateOrCreate(
            ['id' => $chargeData['id']],
            [
                'name'       => $chargeData['name'],
                'amount'     => $chargeData['amount'],
                'created_by' => $charge->created_by ?? Auth::id(),
                'created_at' => $charge->created_at ?? now(),
                'updated_by' => Auth::id(),
                'updated_at' => now()
            ]);
        if ($charge->wasRecentlyCreated){
            return redirect()->back()->with('created', 'Shipping Charge created successfully');
        }else{
            return redirect()->back()->with('updated', 'Shipping Charge updated successfully');
        }
    }
    public function chargeDestroy(ShippingCharge $charge) {
        $charge->delete();
        return redirect()->back()->with('deleted', 'Shipping Charge has been deleted');
    }

    public function bankSettings() {
        $banks = BankSetting::get();
        $title = 'Delete Bank!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.banks', compact('banks'));
    }
    public function bankStore(Request $request) {
        $bankData = $request->only('id', 'name');
        // dd($bankData);
        $bank = BankSetting::find($bankData['id']);
        $bank = BankSetting::updateOrCreate(
            ['id' => $bankData['id']],
            [
                'name'       => $bankData['name'],
                'created_by' => $bank->created_by ?? Auth::id(),
                'created_at' => $bank->created_at ?? now(),
                'updated_by' => Auth::id(),
                'updated_at' => now()
            ]);
        if ($bank->wasRecentlyCreated){
            return redirect()->back()->with('created', 'Bank created successfully');
        }else{
            return redirect()->back()->with('updated', 'Bank updated successfully');
        }
    }
    public function bankDestroy(BankSetting $bank) {
        $bank->delete();
        return redirect()->back()->with('deleted', 'Bank has been deleted');
    }

    public function companyInfo() {
        $infos = CompanyInfo::get();
        return view('admin.settings.company-info', compact('infos'));
    }

    public function allorder() {
        // $orders = Order::where('status', 'New')->get();
        // $ordersJson = json_encode($orders);
        // dd($orders);

        $orders = Order::get();

        return view('admin.orders.orderlisting', [
            'orders' => $orders,
        ]);
    }

    public function proceed(Request $request, Order $order)
    {
        dd($request);
        return redirect()->back();
    }

    public function reject(Request $request, Order $order)
    {
        // dd($request->remark);
        if($order->status == 1 || $order->status == 2)
        {
            $order->update([
                'status' => 6,
                'remarks' => $request->remark,
            ]);

            Alert::success('Success', 'Cancelled the shipment');
            return redirect()->back();
        }else{
            Alert::error('Fail', 'You cannot cancel the shipment');
            return redirect()->back();
        }
    }
    public function packing(Request $request, Order $order)
    {
        // dd($request->all());
        $order->update([
            'status' => $request->status,
            'courier' => $request->courier,
            'cn' => $request->cn,
            'tracking_number' => $request->tracking_number,
        ]);

        Alert::success('Success', 'Status has been updated');
        return redirect()->back();
    }
    public function delivering(Request $request, Order $order)
    {
        // $order->update([
        //     'status' => 3,
        // ]);

        
        return redirect()->back();
    }
    public function complete(Request $request, Order $order)
    {
        // dd($request);
        // $order->update([
        //     'status' => 4,
        // ]);

        
        return redirect()->back();
    }

    public function updatestatus(Request $request)
    {

        dd($request);

        return redirect()->back();
    }

    public function invoice(Order $order, Request $request)
    {
        
        $user = $order->user_id;
        $invoice = Order::where('order_num', '=', $order->order_num)->where('user_id', $user)->first();

        // $orderItems = OrderItem::query()->join('products', 'order_items.product_id', '=', 'products.id')
        //                         ->where('order_num', '=', $order)
        //                         ->select('order_items.*', 'products.name_en as product_name_en', 'products.name_cn as product_name_cn')
        //                         ->get();
        $orderItems = OrderItem::where('order_num', $order->order_num)->with(['product'])->get();                      
        $companyInfo = CompanyInfo::all()->keyBy('key');
 
        $pdf = PDF::loadView('member.orders..pdf.invoice', ['invoice' => $invoice, 'orderItems' => $orderItems, 'companyInfo' => $companyInfo]);
        return $pdf->download('invoice.pdf');
    }
}
