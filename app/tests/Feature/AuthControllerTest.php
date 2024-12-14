<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_works(): void
    {
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->post('/api/login',$payload);

        $response->assertStatus(200);
    }

    //login works
    //login validation works
    //login attempt fails for non-registered user
    //login fails for wrong email/password
    

    //register works
    //register validation works
    //responds with token
    //gives error for same email



    //logout works

    //refresh works
        //carbon time manipulation for getting expired error in response
        //fail -> work



    //profile test cases
    //gives user details

}
