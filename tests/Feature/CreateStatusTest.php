<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_create_a_statuses()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('statuses.store'), [
            'user_id' => $user->id,
            'body' => 'Mi primer estado'
        ]);

        $this->assertDatabaseHas('statuses',[
            'user_id' => $user->id,
            'body' => 'Mi primer estado'
        ]);
        
    }
    
}
