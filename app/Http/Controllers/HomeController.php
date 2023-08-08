<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function root()
    {
        return view('web.dashboard');
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
        return view('web.my-profile');
    }

    public function updateProfile(Request $request){
        $id = ucfirst(Auth::user()->id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
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
            Session::flash('alert-class', 'alert-success');

        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');

        }
        return redirect()->back()->with('success', 'YOU HAVE SUCCESSFULLY UPDATED!');
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

    public function updatePassword(Request $request, $id){
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!",
                    'html' => view('web.my-profile')
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!",
                    'html' => view('web.my-profile')
                ], 200); // Status code here
            }
        }
    }
}
