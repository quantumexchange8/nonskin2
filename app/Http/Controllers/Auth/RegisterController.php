<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'referral' => ['nullable', 'string', 'max:12'],
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
    protected function create(array $data)
    {
        // dd($data);
        if (request()->has('avatar')) {
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => "/images/" . $avatarName,
            'referral' => $data['referral'],
            'full_name' => $data['full_name'],
            'id_no' => $data['id_no'],
            'contact' => $data['contact'],
            'username' => $data['username'],

            'address_1' => $data['address_1'],
            'address_2' => $data['address_2'],
            'city' => $data['city'],
            'postcode' => $data['postcode'],
            'state' => $data['state'],
            'country' => $data['country'],

            'bank_name' => $data['bank_name'],
            'bank_holder_name' => $data['bank_holder_name'],
            'bank_acc_no' => $data['bank_acc_no'],
            'bank_ic' => $data['bank_ic'],
        ]);
    }

    public function store(Request $request){
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // if (request()->has('avatar')) {
        //     $avatar = request()->file('avatar');
        //     $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        //     $avatarPath = public_path('/images/');
        //     $avatar->move($avatarPath, $avatarName);
        // }

        $user = User::create([
            'code'          => $request->code,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            // 'avatar'     => "/images/" . $avatarName,
            'avatar'        => '',
            'referral'      => $request->referral,
            'name'          => $request->name,
            'id_no'         => $request->id_no,
            'contact'       => $request->contact,
            'username'      => $request->username,
            'role_id'       => 4,
            'role'          =>'user',
            'ranking_id'    => 5,
            'ranking_name'  => 'Nonmember',

            'address_1'     => $request->address_1,
            'address_2'     => $request->address_2,
            'city'          => $request->city,
            'postcode'      => $request->postcode,
            'state'         => $request->state,
            'country'       => $request->country,

            'bank_name'         => $request->bank_name,
            'bank_holder_name'  => $request->bank_holder_name,
            'bank_acc_no'       => $request->bank_acc_no,
            'bank_ic'           => $request->bank_ic,
        ]);

        $user->assignRole('user');

        return redirect()
                ->route('login')
                ->with("added", "User successfully created!");
    }
}
