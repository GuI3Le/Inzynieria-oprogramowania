<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\FitnessClass;
use App\Models\ClassRegistration;

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
     * Display the customer's memberships page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function memberships()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Musisz być zalogowany, aby zobaczyć karnety.');
        }

        return view('customer.membership', compact('customer'));
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
     * Handles schedule page displaying for customers.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function schedule()
    {
        $classes = FitnessClass::with('employee')
            ->orderBy('scheduled_time')
            ->get();

        $customer = Auth::guard('customer')->user();

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

        return view('customer.schedule', compact('schedule', 'customer', 'days', 'hours'));
    }

    /**
     * Display the customer profile edit form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editProfile()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Musisz być zalogowany, aby edytować profil.');
        }

        return view('customer.edit-profile', compact('customer'));
    }

    /**
     * Update the customer profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Musisz być zalogowany, aby edytować profil.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'required|numeric',
            'birth_date' => 'required|date|before:today',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $customer->update($data);

        return redirect()->route('customer.dashboard')->with('success', 'Profil zaktualizowany pomyślnie!');
    }

    /**
     * Register customer for a fitness class.
     *
     * @param int $classId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerForClass($classId)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.schedule')->with('error', 'Musisz być zalogowany, aby się zapisać.');
        }

        $fitnessClass = FitnessClass::findOrFail($classId);

        if ($fitnessClass->scheduled_time < now()) {
            return redirect()->route('customer.schedule')->with('error', 'Nie można zapisać się na zajęcia z przeszłości.');
        }

        if ($fitnessClass->available_spots <= 0) {
            return redirect()->route('customer.schedule')->with('error', 'Brak wolnych miejsc na te zajęcia.');
        }

    
        $alreadyRegistered = ClassRegistration::where('customer_id', $customer->id)
            ->where('fitness_class_id', $classId)
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->route('customer.schedule')->with('error', 'Jesteś już zapisany na te zajęcia.');
        }

    
        ClassRegistration::create([
            'customer_id' => $customer->id,
            'fitness_class_id' => $classId,
            'status' => 'confirmed',
            'registration_date' => now(),
        ]);

        // Zmniejsz liczbę dostępnych miejsc
        $fitnessClass->decrement('available_spots');

        return redirect()->route('customer.schedule')->with('success', 'Zapisano na zajęcia pomyślnie!');
    }

    /**
     * Unregister customer from a fitness class.
     *
     * @param int $classId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unregisterFromClass($classId)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('customer.schedule')->with('error', 'Musisz być zalogowany, aby się wypisać.');
        }

        $registration = ClassRegistration::where('customer_id', $customer->id)
            ->where('fitness_class_id', $classId)
            ->where('status', 'confirmed')
            ->first();

        if (!$registration) {
            return redirect()->route('customer.schedule')->with('error', 'Nie jesteś zapisany na te zajęcia.');
        }

     
        $registration->update(['status' => 'cancelled']);

      
        FitnessClass::findOrFail($classId)->increment('available_spots');

        return redirect()->route('customer.schedule')->with('success', 'Wypisano z zajęć pomyślnie!');
    }

    /**
     * Logouts customer.
     *
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|object
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
