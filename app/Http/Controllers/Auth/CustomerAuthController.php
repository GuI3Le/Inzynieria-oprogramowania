<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class CustomerAuthController
 *
 * Handles customer registration and login operations.
 *
 */
class CustomerAuthController extends Controller
{
    /**
     * Displays page with login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function showLoginForm()
    {
        return view('customer.login');
    }

    /**
     * Validates customers credentials from login form and redirects to customers dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Displays page with customers registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function showRegistrationForm()
    {
        return view('customer.register');
    }

    /**
     * Validates data from customers registration form, creates customer in the database and redirects to login page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Displays page with customer dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function dashboard()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.dashboard',
            [
                'customer' => $customer
            ]);
    }

    /**
     * Logouts customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.showLoginForm');
    }
}
