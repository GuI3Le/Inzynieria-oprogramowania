<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class EmployeeAuthController
 *
 * Handles employee registration and login operations.
 */
class EmployeeAuthController extends Controller
{
    /**
     * Displays page with employee login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function showLoginForm()
    {
        return view('employee.login');
    }

    /**
     * Validates employee login credentials and redirects to customers dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required'],]);
        if (Auth::guard('employee')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('employee.dashboard'));
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.',])->onlyInput('email');
    }

    /**
     * Logouts employee.
     *
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|object
     */
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Displays page with employees dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function dashboard()
    {
        $employee = Auth::guard('employee')->user();
        $role = Role::find($employee->role_id);

        return view('employee.dashboard', ['employee' => $employee, 'role' => $role]);
    }

    /**
     * Displays page with employees registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('employee.register', compact('roles'));
    }

    /**
     * Validates data from employees validation form, creates employee in the database and redirects to employee login page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        Employee::create(['last_name' => $request->last_name, 'first_name' => $request->first_name, 'email' => $request->email, 'phone' => $request->phone, 'role_id' => $request->role_id, 'password' => Hash::make($request->password),]);
        return redirect()->route('employeeLogin');
    }
}
