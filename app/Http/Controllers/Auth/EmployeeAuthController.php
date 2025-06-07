<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EmployeeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required'],]);
        if (Auth::guard('employee')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('employee.dashboard'));
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.',])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        $employee = Auth::guard('employee')->user();
        $role = Role::find($employee->role_id);

        return view('employee.dashboard', ['employee' => $employee, 'role' => $role]);
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('employee.register', compact('roles'));
    }

    public function register(Request $request)
    {
        Employee::create(['last_name' => $request->last_name, 'first_name' => $request->first_name, 'email' => $request->email, 'phone' => $request->phone, 'role_id' => $request->role_id, 'password' => Hash::make($request->password),]);
        return redirect()->route('employeeLogin');
    }
}
