<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_status_belongs_to_a_user()
    {
        $status = Status::factory()->create();

        $this->assertInstanceOf(User::class, $status->user);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_status_has_many_likes()
    {
        $status = Status::factory()->create();

        Like::factory()->create([
            'status_id' => $status->id,
            'user_id' => $status->user
        ]);

        $this->assertInstanceOf(Like::class, $status->likes->first());
    }
}
