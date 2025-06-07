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
    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'unique:customers,email', 'max:255'],
            'phone' => ['required', 'min:9'],
            'birth_date' => ['required', 'date'],
            "password" => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Customer::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'first_name' => $validatedData['first_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'sign_up_date' => Date('Y-m-d'),
            'birth_date' => $validatedData['birth_date'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('customer.showLoginForm');
    }

    public function dashboard()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.dashboard',
            [
                'customer' => $customer
            ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.showLoginForm');
    }
}
