<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    //login works
    public function test_login_works(): void
    {
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->post('/api/login', $payload);

        $response->assertStatus(200);
    }

    //login validation works
    public function test_login_validation_works(): void
    {
        $payload = [
            'email' => 'invalidemail.com',
            'password' => ''
        ];

        $response = $this->post('/api/login', $payload);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertStringContainsString('must be a valid email address', $response->getContent());
        $this->assertStringContainsString('password field is required', $response->getContent());
    }


    //login attempt fails for non-registered user
    public function test_login_fails_for_non_registered_user(): void
    {
        $payload = [
            'email' => '7o6H0@example.com',
            'password' => 'password'
        ];

        $response = $this->post('/api/login', $payload);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertStringContainsString("Invalid credentials", $response->getContent());
    }

    //register works
    public function test_register_works(): void
    {
        $payload = [
            'name' => 'John Doe',
            'email' => '7o6H0@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertJsonStructure([
            "success",
            "message",
            "access_token",
            "token_type",
            "expires_in",
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => '7o6H0@example.com'
        ]);
    }

    //register validation works
    public function test_register_validation_works(): void
    {
        $payload = [
            "name" => "",
            "email" => "",
            "password" => "",
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertStringContainsString('name field is required', $response->getContent());
        $this->assertStringContainsString('email field is required', $response->getContent());
        $this->assertStringContainsString('password field is required', $response->getContent());
    }

    // /registration fails for already registered user
    public function test_register_fails_for_already_registered_user(): void
    {
        $user = User::factory()->create();

        $payload = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertStringContainsString('email has already been taken', $response->getContent());
    }

    //logout works
    public function test_logout_works(): void
    {
        $user = User::factory()->create();

        $token = Auth::login($user);
        
        $response = $this->withHeader('Authorization','Bearer ' . $token)->post('/api/logout');
        $response->assertJsonFragment(["message"=>"Logout successful"]);
    }

    //refresh works
    //carbon time manipulation for getting expired error in response
    //fail -> work



    //profile test cases
    //gives user details

}
