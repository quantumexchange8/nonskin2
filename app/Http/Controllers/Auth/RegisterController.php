<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Prefix;
use App\Models\User;
use App\Models\Address;
use App\Models\Cart;
use App\Models\BankSetting;
use App\Models\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'upline_id' => ['nullable', 'string', 'max:12'],
            'name' => ['required', 'string', 'max:255'],
            'id_no' => ['required', 'numeric', 'digits:12'],
            'contact' => ['required', 'numeric'],
            'username' => ['required', 'string', 'min:6'],
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required_with:password_confirmation','same:password_confirmation', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['min:8'],
            'avatar' => ['nullable', 'image' ,'mimes:jpg,jpeg,png','max:1024'],

            'address_1' => ['required', 'string', 'max:255'],
            'address_2' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'numeric'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string', 'max:50'],

            'bank_name' => ['required', 'string', 'max:100'],
            'bank_holder_name' => ['required', 'string', 'max:100'],
            'bank_acc_no' => ['required', 'numeric'],
            'bank_ic' => ['required', 'string', 'max:20'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     // dd($data);
    //     if (request()->has('avatar')) {
    //         $avatar = request()->file('avatar');
    //         $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
    //         $avatarPath = public_path('/images/');
    //         $avatar->move($avatarPath, $avatarName);
    //     }

    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'avatar' => "/images/" . $avatarName,
    //         'referral' => $data['referral'],
    //         'full_name' => $data['full_name'],
    //         'id_no' => $data['id_no'],
    //         'contact' => $data['contact'],
    //         'username' => $data['username'],

    //         'address_1' => $data['address_1'],
    //         'address_2' => $data['address_2'],
    //         'city' => $data['city'],
    //         'postcode' => $data['postcode'],
    //         'state' => $data['state'],
    //         'country' => $data['country'],

    //         'bank_name' => $data['bank_name'],
    //         'bank_holder_name' => $data['bank_holder_name'],
    //         'bank_acc_no' => $data['bank_acc_no'],
    //         'bank_ic' => $data['bank_ic'],
    //     ]);
    // }

    public function register(Request $request, $referral = null) {

        $banks = BankSetting::pluck('name', 'id');
        $countries = Country::select('id', 'name')->get();
        
        return view('auth.register', [
            'banks' => $banks,
            'referral' => $referral,
            'countries' => $countries,
        ]);
    }

    public function store(Request $request){
        // $validator = $this->validator($request->all());

        // if user inputs referral in registration form

        if($request->referral != null){
            $uplineId = User::where('referrer_id', $request->referral)->first();

            if(!$uplineId) {
                Alert::error('invalid action', 'invalid_referral_code');
                return back()->withInput($request->input())->withErrors(['error_messages'=>'Invalid referral code!']);
            }

            $upline_user_id = $uplineId->id;

            if(empty($uplineId['hierarchyList'])){
                $hierarchyList = "-" . $upline_user_id . "-";
            } else {
                $hierarchyList = $uplineId['hierarchyList'] . $upline_user_id . "-";
            }
            // $hierarchyList = $uplineId['hierarchyList'] . $upline_user_id . "-";

        }else{
            $upline_user_id = 3;
            $hierarchyList = "-" . 3 . "-";
        }

        $memberPrefix = 'NON';
        // Find the corresponding row in the 'prefixes' table based on the prefix
        $prefixRow = Prefix::where('prefix', $memberPrefix)->first();

        try {
            DB::beginTransaction();
            $newMemberNumber = $prefixRow->counter + 1;
            $prefixRow->update(
                [
                    'counter' => $newMemberNumber,
                    'updated_by' => Auth::id()
                ]
            );
            $user = User::create([
                'upline_id'     => $upline_user_id,
                'referrer_id'   => $memberPrefix . str_pad($newMemberNumber, $prefixRow->padding, '0', STR_PAD_LEFT),
                'hierarchyList' => $hierarchyList,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                // 'avatar'     => "/images/" . $avatarName,
                'avatar'        => null,
                'full_name'     => $request->full_name,
                'id_no'         => $request->id_no,
                'contact'       => $request->contact,
                'username'      => $request->username,
                'role'          =>'user',
                'rank_id'       => 1,
                'bank_name'         => $request->bank_name,
                'bank_holder_name'  => $request->bank_holder_name,
                'bank_acc_no'       => $request->bank_acc_no,
                'bank_ic'           => $request->bank_ic,
                'address_1'             => $request->address_1,
                'address_2'             => $request->address_2,
                'city'                  => $request->city,
                'postcode'              => $request->postcode,
                'state'                 => $request->state,
                'country'               => $request->country,
                'delivery_address_1'    => $request->address_1,
                'delivery_address_2'    => $request->address_2,
                'delivery_city'         => $request->city,
                'delivery_postcode'     => $request->postcode,
                'delivery_state'        => $request->state,
                'status'        => 'NotActive',
                'delivery_country'      => $request->country,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
            $user->assignRole('user');

            if($user->wasRecentlyCreated){
                Address::create([
                    'user_id'       => $user->id,
                    'name'          => $request->full_name,
                    'contact'       => $request->contact,
                    'address_1'     => $request->address_1,
                    'address_2'     => $request->address_2,
                    'city'          => $request->city,
                    'postcode'      => $request->postcode,
                    'state'         => $request->state,
                    'country'       => $request->country,
                    'created_by'    => $user->id,
                ]);
                Cart::create([
                    'user_id'       => $user->id,
                    'created_by'    => $user->id
                ]);
                DB::commit();
                return redirect()
                ->route('login')
                ->with("added", "User successfully created!");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    public function checkExistingReferral(Request $request){
        $referral = $request->input('referral');
        $isExist = User::where('referrer_id', $referral)->exists();
        return response()->json(['exist' => $isExist]);
    }
    public function checkUniqueUsername(Request $request){
        $username = $request->input('username');
        $isUnique = !User::where('username', $username)->exists();
        return response()->json(['unique' => $isUnique]);
    }
    public function checkUniqueEmail(Request $request){
        $email = $request->input('email');
        $isUnique = !User::where('email', $email)->exists();
        return response()->json(['unique' => $isUnique]);
    }
    public function checkUniqueID(Request $request){
        $id_no = $request->input('id_no');
        $isUnique = !User::where('id_no', $id_no)->exists();
        return response()->json(['unique' => $isUnique]);
    }
    public function checkUniqueContact(Request $request){
        $contact = $request->input('contact');
        $isUnique = !User::where('contact', $contact)->exists();
        return response()->json(['unique' => $isUnique]);
    }
}
