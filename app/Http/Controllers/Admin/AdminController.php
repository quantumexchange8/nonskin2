<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\BankSetting;
use App\Models\ShippingCharge;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
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
        $res = DB::table('orders')
        ->selectRaw('
            COUNT(*) as total_orders,
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as new_order,
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as packing,
            SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as delivering,
            SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as completed,
            SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) as cancelled,
            (SELECT COUNT(*) FROM products WHERE status = "Active") as total_products,
            (SELECT SUM(total_amount) FROM orders WHERE status = 4) as total_sales,
            (SELECT COUNT(*) FROM users WHERE role = "user") as total_members,
            (SELECT COUNT(*) FROM users WHERE rank_id = 5) as chief_distributors,
            (SELECT COUNT(*) FROM users WHERE rank_id = 4) as exclusive_distributors,
            (SELECT COUNT(*) FROM users WHERE rank_id = 3) as general_distributors,
            (SELECT COUNT(*) FROM users WHERE rank_id = 2) as members,
            (SELECT COUNT(*) FROM users WHERE rank_id = 1) as clients,
            (SELECT COUNT(*) FROM payments WHERE type = "Deposit" AND status = "Pending") as pending_deposit,
            (SELECT COUNT(*) FROM payments WHERE type = "Withdraw" AND status = "Pending") as pending_withdrawal
        ')
        ->first();

        return view('admin.dashboard', compact('res'));
    }
    public function memberList(){
        $states = State::select('id', 'name')->get();
        // $users = User::with(['address', 'upline'])
        // ->where('role', 'user')
        // ->orWhere('role', 'admin')
        // ->get(['upline_id', 'referrer_id', 'name', 'email', 'ranking_name', 'postcode', 'city', 'state', 'created_at']);

        $users = User::where('role', 'user')->get();
        $title = 'Deleting User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.members.listing', compact('users', 'states'));
    }

    public function memberEdit(User $user){
        $states = State::select('id', 'name')->get();
        $banks = BankSetting::select('id', 'name')->orderBy('name')->get();
        return view('admin.members.edit', compact('user', 'states', 'banks'));
    }

    public function memberUpdate(Request $request, User $user){
        // $request->validate([
        //     'username'          => ['required', 'string'],
        //     'email'             => ['required', 'email'],
        //     'full_name'         => ['required', 'string'],
        //     'id_no'             => ['required', 'numeric', 'max:13'],
        //     'contact'           => ['required', 'max:12'],
        //     'bank_name'         => ['required'],
        //     'bank_holder_name'  => ['required', 'string'],
        //     'bank_acc_no'       => ['required', 'numeric'],
        //     'bank_ic'           => ['required', 'numeric'],
        //     'address_1'         => ['required'],
        //     'address_2'         => ['required'],
        //     'postcode'          => ['required', 'numeric', 'max:6'],
        //     'city'              => ['required'],
        //     'state'             => ['required'],
        //     'country'           => ['required'],
        // ]);

        $user = User::find($request->input('id'));
        // dd($request);
        try {
            $user->update([
                'username'          => $request->input('username'),
                'email'             => $request->input('email'),
                'full_name'         => $request->input('full_name'),
                'id_no'             => $request->input('id_no'),
                'contact'           => $request->input('contact'),
                'bank_name'         => $request->input('bank_name'),
                'bank_holder_name'  => $request->input('bank_holder_name'),
                'bank_acc_no'       => $request->input('bank_acc_no'),
                'bank_ic'           => $request->input('bank_ic'),
                'address_1'         => $request->input('address_1'),
                'address_2'         => $request->input('address_2'),
                'postcode'          => $request->input('postcode'),
                'city'              => $request->input('city'),
                'state'             => $request->input('state'),
                'country'           => $request->input('country'),
            ]);

            foreach ($request->input('addresses', []) as $addressId => $addressData) {
                $address = Address::find($addressId);
                if ($address) {
                    $address->update([
                        'name'      => $addressData['name'],
                        'contact'   => $addressData['contact'],
                        'address_1' => $addressData['address_1'],
                        'address_2' => $addressData['address_2'],
                        'postcode'  => $addressData['postcode'],
                        'city'      => $addressData['city'],
                        'state'     => $addressData['state'],
                        'country'   => $addressData['country'],
                        // ... other address fields ...
                    ]);
                }
            }

            return redirect()->back()->with('updated', $user->full_name . ' profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('code', $e->getCode());
            // return $e->getMessage();
        }
    }

    public function memberDestroy(User $user){
        // dd('here');
        $user->is_active = !$user->is_active;
        $user->save();
        $user->delete();
        return redirect()->back()->with('deleted', 'User has been deleted successfully!');
    }


    public function categorySettings() {
        $categories = Category::get();
        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.settings.categories', compact('categories'));
    }
    public function categoryStore(Request $request) {
        $categoryData = $request->only('id', 'name_en', 'name_cn', 'status');
        // dd($categoryData);
        $category = Category::find($categoryData['id']);
        $category = Category::updateOrCreate(
            ['id' => $categoryData['id']],
            [
                'name_en'    => $categoryData['name_en'],
                'name_cn'    => $categoryData['name_cn'],
                'status'     => $categoryData['status'],
                'created_at' => $category->created_at ?? now(),
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
                'created_at' => $charge->created_at ?? now(),
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
                'created_at' => $bank->created_at ?? now(),
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
        $info = CompanyInfo::get()->first();
        return view('admin.settings.company-info', compact('info'));
    }
    public function companyInfoStore(Request $request) {
        $infoData = $request->only('id', 'name', 'contact', 'address', 'register_no', 'description');
        // dd($infoData);
        $info = CompanyInfo::find($infoData['id']);
        $info = CompanyInfo::updateOrCreate(
            ['id' => $infoData['id']],
            [
                'name'       => $infoData['name'],
                'contact'    => $infoData['contact'],
                'address'    => $infoData['address'],
                'register_no'=> $infoData['register_no'],
                'description'=> $infoData['description'],
                'created_at' => $info->created_at ?? now(),
                'updated_at' => now()
            ]);
        if ($info->wasRecentlyCreated){
            return redirect()->back()->with('created', 'Company info created successfully');
        }else{
            return redirect()->back()->with('updated', 'Company info updated successfully');
        }
    }

    public function orderListing() {
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

        if($order->status == 4){

            $user = User::find($order->user_id);

            if ($user) {
                // Update the user's personal_sales with the order's total_amount
                $user->personal_sales += $order->total_amount;
                $user->group_sales += $order->total_amount;
                $user->save();
            }
        }


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
        $companyInfo = CompanyInfo::get()->first();

        $pdf = PDF::loadView('member.orders..pdf.invoice', ['invoice' => $invoice, 'orderItems' => $orderItems, 'companyInfo' => $companyInfo]);
        return $pdf->download('invoice.pdf');
    }

    public function profile()
    {
        return view('admin.profile.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'contact' => $request->contact,
            'id_no' => $request->id_no,
        ]);

        Alert::success('Success', 'Profile Updated');
        return redirect()->back();
    }

    public function changePassword(){
        return view('admin.profile.password');
    }

    public function checkUniqueUsername(Request $request){
        $username = $request->input('username');
        $isUnique = !User::where('username', $username)
                    ->where('id', '!=', Auth::id())
                    ->exists();
        return response()->json(['unique' => $isUnique]);
    }
    public function checkUniqueEmail(Request $request){
        $email = $request->input('email');
        $isUnique = !User::where('email', $email)
                    ->where('id', '!=', Auth::id())
                    ->exists();
        return response()->json(['unique' => $isUnique]);
    }
    public function checkUniqueID(Request $request){
        $id_no = $request->input('id_no');
        $isUnique = !User::where('id_no', $id_no)
                    ->where('id', '!=', Auth::id())
                    ->exists();
        return response()->json(['unique' => $isUnique]);
    }
    public function checkUniqueContact(Request $request){
        $contact = $request->input('contact');
        $isUnique = !User::where('contact', $contact)
                    ->where('id', '!=', Auth::id())
                    ->exists();
        return response()->json(['unique' => $isUnique]);
    }

}
