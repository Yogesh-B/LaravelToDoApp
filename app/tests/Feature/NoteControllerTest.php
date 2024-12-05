<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        $token = Auth::login(User::first());
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_notes_index_route_works(): void
    {
        $response = $this->get('/api/notes');
        //add some assertions and other test cases also
        $response->assertStatus(200);
    }
}
