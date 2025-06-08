<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EmployeeRegisterTest extends TestCase
{
    use RefreshDatabase;
    public $role;
    public function setUp(): void
    {
        parent::setUp();
        $this->role = Role::create([
            'role_name' => 'Test Role'
        ]);
    }

    public function test_employee_can_view_registration_form()
    {
        $response = $this->get('/employee/register');

        $response->assertStatus(200);
        $response->assertViewIs('employee.register'); // Adjust view name as needed
    }

    public function test_employee_can_register_with_valid_data()
    {
        $response = $this->post('/employee/register', [
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'email' => 'jkowalski@profit.com',
            'phone' => '123456789',
            'role_id' => $this->role->id,
            'password' => 'PoprawneHaslo123!',
        ]);
        $response->assertRedirect('/employee/login');
        $this->assertDatabaseHas('employees', [
            'email' => 'jkowalski@profit.com',
        ]);
        $employee = Employee::where('email', 'jkowalski@profit.com')->first();
        $this->assertTrue(Hash::check('PoprawneHaslo123!', $employee->password));
    }
}
