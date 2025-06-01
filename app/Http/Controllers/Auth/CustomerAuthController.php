<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::info('Customer login attempt for: ' . $request->email);
        $customer = Customer::where('email', $request->email)->first();
//        echo $customer;
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/customer/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
//        if (!$customer) {
//            Log::info('Customer not found: ' . $request->email);
//            return back()->withErrors([
//                'email' => 'No account found with this email address.',
//            ])->onlyInput('email');
//        }
//
//        if (!Hash::check($request->password, $customer->password)) {
//            Log::info('Password check failed for: ' . $request->email);
//            return back()->withErrors([
//                'email' => 'The provided credentials do not match our records.',
//            ])->onlyInput('email');
//        }else{
//            echo "Valid password";
//        }
////        echo $request;
//        Auth::guard('customer')->login($customer, $request->boolean('remember'));
//        if(Auth::guard('customer')->check()){
//            $request->session()->regenerate();
//            echo "Valid password";
//            return redirect()->intended('/customer/dashboard');
//        }
//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','unique:customers,email','max:255'],
            'phone' => ['required', 'min:9'],
            'birth_date' => ['required','date'],
            "password" => ['required','string','min:8','confirmed'],
        ]);

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'first_name' => $validatedData['first_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'sign_up_date' => Date('Y-m-d'),
            'birth_date' => $validatedData['birth_date'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect('/signin');
    }

    public function dashboard()
    {
        return view('customer.dashboard');
    }
}
