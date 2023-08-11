<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $user->url = url('') .'/register/' . $user->referrer_id;

        return view('member.dashboard', [
            'user' => $user,
        ]);
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function myProfile() {
        // dd(session());
        session(['activeTab' => 'profile']);

        return view('web.my-profile');
    }

    public function updateProfile(Request $request){
        $id = ucfirst(Auth::user()->id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->username = $request->get('username');
        $user->name = $request->get('name');
        $user->id_no = $request->get('id_no');
        $user->contact = $request->get('contact');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            if(@file_exists(public_path(Auth::user()->avatar))){
                @unlink(public_path(Auth::user()->avatar));
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = '/images/' . $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');

        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');

        }
        return redirect()->back()->with('success', 'YOU HAVE SUCCESSFULLY UPDATED!');
    }

    public function updateAddress(Request $request){
        $addressData = $request->only('id', 'name', 'contact', 'address_1', 'address_2', 'postcode', 'city', 'state', 'country');
        // dd($request->all());
        try {
            $address = Address::updateOrCreate(
                ['id' => $addressData['id'] ?? null],
                [
                    'name'          => $addressData['name'],
                    'contact'       => $addressData['contact_address'],
                    'address_1'     => $addressData['address_1'],
                    'address_2'     => $addressData['address_2'],
                    'postcode'      => $addressData['postcode'],
                    'city'          => $addressData['city'],
                    'state'         => $addressData['state'],
                    'country'       => $addressData['country'],
                    'created_by'    => $address->created_by ?? Auth::id(),
                    'created_at'    => $address->created_at ?? now(),
                    'updated_by'    => Auth::id(),
                    'updated_at'    => now()
                ]);
            if ($address->wasRecentlyCreated){
                return redirect()->back()->with('created', 'Address created successfully');
            }else{
                Session::flash('activeTab', 'addresses');
                return redirect()->back()->with('updated', 'Address updated successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function toggleDefaultAddress(Request $request){
        $addressData = $request->only('id', 'user_id', 'is_default');
        $address = Address::where('user_id', $addressData['user_id'])->where('is_default', 1)->first();
        $address->is_default = !$address->is_default;
        $address->update();
        $address = Address::find($addressData['id']);
        $address->is_default = !$address->is_default;
        $address->updated_by = Auth::id();
        $address->update();

        return redirect()->back()->with('updated', "The default address has been changed successfully");
    }

    public function updateBank(Request $request){
        $user = User::find(Auth::id());
        $request->validate([
            'bank_name' => ['required'],
            'bank_holder_name' => ['required', 'string'],
            'bank_acc_no' => ['required', 'numeric'],
            'bank_ic' => ['required', 'numeric'],
        ]);
        // dd($request);
        try {
                $user->bank_name         = $request->get('bank_name');
                $user->bank_holder_name  = $request->get('bank_holder_name');
                $user->bank_acc_no       = $request->get('bank_acc_no');
                $user->bank_ic           = $request->get('bank_ic');
                $user->updated_by        = Auth::id();
                $user->updated_at        = now();
                $user->update();
            return redirect()->back()->with('updated', 'Bank Detail updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    }

    public function updatePassword(Request $request, $id)
    {

        $current = Auth::User()->password;
        if(hash::check($request->input('current_password'), $current))
        {
            $user_id = Auth::user()->id;
            $obj_user = User::find($user_id);
                if($request->input('new_password') == $request->input('confirm_password'))
                {
                    $obj_user->password = Hash::make($request->input('new_password'));
                    $obj_user->save();

                    Alert::success(trans('public.success'), trans('public.successful_updated_password'));
                    return redirect()->back();
                } else {
                    Alert::error(trans('public.failed'), trans('public.new_password_doesn\t_match_with_confirm_password'));
                    return redirect()->back();
                }
        } else {
            Alert::error(trans('public.failed'), trans('public.Incorrect_current_password'));
            return redirect()->back();
        }
    }

}
