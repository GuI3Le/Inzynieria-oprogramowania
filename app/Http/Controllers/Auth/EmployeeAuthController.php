<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\FitnessClass;
use Carbon\Carbon;

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
        Employee::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'password' => $request->password]);
        return redirect()->route('employee.showLoginForm');
    }

    /**
     * Handles schedule page displaying.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function schedule()
    {
        $classes = FitnessClass::with('employee')
            ->orderBy('scheduled_time')
            ->get();

        $employee = Auth::guard('employee')->user();

        $schedule = [];
        $hours = range(7, 19);
        $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];

        foreach ($hours as $hour) {
            $schedule[$hour] = [];
            foreach ($days as $day) {
                $schedule[$hour][$day] = null;
            }
        }

        foreach ($classes as $class) {
            $date = \Carbon\Carbon::parse($class->scheduled_time);
            $hour = $date->hour;

            $dayMap = [
                'Monday' => 'Poniedziałek',
                'Tuesday' => 'Wtorek',
                'Wednesday' => 'Środa',
                'Thursday' => 'Czwartek',
                'Friday' => 'Piątek',
                'Saturday' => 'Sobota',
                'Sunday' => 'Niedziela'
            ];

            $day = $dayMap[$date->format('l')];

            if ($hour >= 7 && $hour <= 19) {
                $schedule[$hour][$day] = $class;
            }
        }

        return view('employee.schedule', compact('schedule', 'employee', 'days', 'hours'));
    }

    /**
     * Adds fitness class to database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'day' => 'required|string',
            'hour' => 'required|integer|min:7|max:19',
        ]);

        $dayMap = [
            'Poniedziałek' => 'Monday',
            'Wtorek' => 'Tuesday',
            'Środa' => 'Wednesday',
            'Czwartek' => 'Thursday',
            'Piątek' => 'Friday',
            'Sobota' => 'Saturday',
            'Niedziela' => 'Sunday'
        ];

        $date = Carbon::parse('next ' . $dayMap[$request->day]);
        $date->hour = (int)$request->hour;
        $date->minute = 0;
        $date->second = 0;

        $class = new FitnessClass();
        $class->name = $request->name;
        $class->description = 'Opis zajęć';
        $class->available_spots = 20;
        $class->employee_id = Auth::guard('employee')->id();
        $class->scheduled_time = $date;
        $class->save();

        return redirect()->route('employee.schedule')->with('success', 'Zajęcia zostały dodane pomyślnie.');
    }

    /**
     * Edits fitness class data.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'day' => 'required|string',
            'hour' => 'required|integer|min:7|max:19',
        ]);

        $dayMap = [
            'Poniedziałek' => 'Monday',
            'Wtorek' => 'Tuesday',
            'Środa' => 'Wednesday',
            'Czwartek' => 'Thursday',
            'Piątek' => 'Friday',
            'Sobota' => 'Saturday',
            'Niedziela' => 'Sunday'
        ];

        $date = Carbon::parse('next ' . $dayMap[$request->day]);
        $date->hour = (int)$request->hour;
        $date->minute = 0;
        $date->second = 0;

        $class = FitnessClass::where('scheduled_time', $date)
            ->where('employee_id', Auth::guard('employee')->id())
            ->first();

        if ($class) {
            $class->name = $request->name;
            $class->save();
            return redirect()->route('employee.schedule')->with('success', 'Zajęcia zostały zaktualizowane pomyślnie.');
        }

        return redirect()->route('employee.schedule')->with('error', 'Nie znaleziono zajęć do edycji.');
    }

    /**
     * Deletes fitness class.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteClass(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'hour' => 'required|integer|min:7|max:19',
        ]);

        $dayMap = [
            'Poniedziałek' => 'Monday',
            'Wtorek' => 'Tuesday',
            'Środa' => 'Wednesday',
            'Czwartek' => 'Thursday',
            'Piątek' => 'Friday',
            'Sobota' => 'Saturday',
            'Niedziela' => 'Sunday'
        ];

        $date = Carbon::parse('next ' . $dayMap[$request->day]);
        $date->hour = (int)$request->hour;
        $date->minute = 0;
        $date->second = 0;

        $class = FitnessClass::where('scheduled_time', $date)
            ->where('employee_id', Auth::guard('employee')->id())
            ->first();

        if ($class) {
            $class->delete();
            return redirect()->route('employee.schedule')->with('success', 'Zajęcia zostały usunięte pomyślnie.');
        }

        return redirect()->route('employee.schedule')->with('error', 'Nie znaleziono zajęć do usunięcia.');
    }
}
