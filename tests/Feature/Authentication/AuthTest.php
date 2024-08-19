<?php

namespace Authentication;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login_should_authenticate_if_email_and_password_are_right()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_login_should_fail_if_password_is_wrong()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
            'password' => 'asdasdasdasd',
        ]);

        $response->assertStatus(401);
    }

    public function test_login_should_fail_if_account_doesnt_exists()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'aaa@test.com',
            'password' => 'asdasdasdasd',
        ]);

        $response->assertStatus(401);
    }

    public function test_register_should_create_user_and_employee()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'internal_id' => '123',
            'born_at' => '1990-01-01',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com'
        ]);

        $this->assertDatabaseHas('employees', [
            'user_id' => User::where('email', 'test@test.com')->first()->id
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'status' => 'success',
        ]);
    }

    public function test_register_should_fail_if_email_is_already_registered()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'internal_id' => '123',
            'born_at' => '1990-01-01',
        ]);

        $response->assertStatus(422);
    }

    public function test_verify_email_should_work()
    {
        $user = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'internal_id' => '123',
            'born_at' => '1990-01-01',
        ]);

        $pin = DB::table('password_reset_tokens')->where('email', 'test@test.com')->first();

        \Auth::login(User::where('email', 'test@test.com')->first());

        $response = $this->postJson('/api/verify-email', [
            'email' => 'test@test.com',
            'pin' => $pin->token,
        ]);

        $response->assertStatus(200);
    }

    public function test_verify_email_should_fail_if_pin_is_wrong()
    {
        $user = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'internal_id' => '123',
            'born_at' => '1990-01-01',
        ]);

        $pin = DB::table('password_reset_tokens')->where('email', 'test@test.com')->first();

        \Auth::login(User::where('email', 'test@test.com')->first());

        $response = $this->postJson('/api/verify-email', [
            'pin' => ($pin->token) + 1,
        ]);

        $response->assertStatus(422);
    }
}
