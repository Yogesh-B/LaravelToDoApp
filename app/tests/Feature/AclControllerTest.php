<?php

namespace Tests\Feature;

use App\Models\Acl;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AclControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        $token = Auth::login(User::first());        
        $note = Note::factory()->create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_record_lists_index_route_works(): void
    {
        $data = [
            'entity_type' => 'note',
            'entity_id' => 1
        ];
        $response = $this->postJson('/api/permissions/show',$data);
        //add some assertions and other test cases also
        $response->assertStatus(200);
    }
}
