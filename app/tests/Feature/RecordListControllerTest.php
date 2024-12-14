<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RecordListControllerTest extends TestCase
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
    public function test_record_lists_index_route_works(): void
    {
        $response = $this->get('/api/record_lists');
        //add some assertions and other test cases also
        $response->assertStatus(200);
    }

    //index shows only related record_lists
    //gives meta links

    //shows record_list
    //error for non permission record_list
    
    //store works
    //validation works
    //acl is created for record_list-user

    //update works
    //error for non permission record_list

    //delete works
    //error for non permission record_list

}
