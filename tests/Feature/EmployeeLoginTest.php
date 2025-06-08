<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EmployeeLoginTest extends TestCase
{
    use RefreshDatabase;

    public $role;
    public $employee;
    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::create([
            'role_name' => 'Test Role'
        ]);
        $this->employee = Employee::create([
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'email' => 'jkowalski@profit.com',
            'phone' => '123456789',
            'role_id' => $this->role->id,
            'password' => Hash::make('PoprawneHaslo123!')
        ]);
    }

    public function test_employee_can_login_with_valid_credentials()
    {
        $response = $this->post('/employee/login', [
            'email' => 'jkowalski@profit.com',
            'password' => 'PoprawneHaslo123!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('employee.dashboard'));
        $this->assertAuthenticated('employee');
    }

    public function test_employee_cant_login_without_password()
    {
        $response = $this->post('/employee/login', [
            'email' => 'jkowalski@profit.com',
            'password' => '',
        ]);
        $response->assertSessionHasErrors(['password']);
        $this->assertGuest('employee');
    }

    public function test_employee_cant_login_with_invalid_credentials()
    {
        $response = $this->post('/employee/login', [
            'email' => 'jkowalski@profit.com',
            'password' => 'zlehaslo',
        ]);
        $response->assertSessionHasErrors(['email']);
        $this->assertGuest('employee');
    }
}
