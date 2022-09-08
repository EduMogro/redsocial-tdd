<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanLikeStatusesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function guests_users_can_not_like_statuses()
    {
        $status = Status::factory()->create();

        $response = $this->postJson(route('statuses.likes.store', $status));

        $this->assertGuest();

        // $response->assertRedirect('login');
        $response->assertStatus(401);
    }
    
    /**
     * @test
     *
     * @return void
     */
    public function an_authenticated_user_can_like_statuses()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $status = Status::factory()->create();

        /** @var User $user */
        $this->actingAs($user)->postJson( route('statuses.likes.store', $status) );

        $this->assertDatabaseHas('likes',[
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);

    }

    /**
     * @test
     *
     * @return void
     */
    public function an_authenticated_user_can_unlike_statuses()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $status = Status::factory()->create();

        /** @var User $user */
        $this->actingAs($user)->postJson( route('statuses.likes.store', $status) );        
        $this->actingAs($user)->deleteJson( route('statuses.likes.destroy', $status) );

        $this->assertDatabaseMissing('likes',[
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);

    }
}
