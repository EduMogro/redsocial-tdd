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


    /**
     * @test
     *
     * @return void
     */
    public function a_status_can_be_liked()
    {
        $status = Status::factory()->create();

        $this->actingAs(User::factory()->create());

        $status->like();

        $this->assertEquals(1, $status->likes()->count());
    }

        /**
     * @test
     *
     * @return void
     */
    public function a_status_can_be_liked_once()
    {
        $status = Status::factory()->create();

        $this->actingAs(User::factory()->create());

        $status->like();

        $this->assertEquals(1, $status->likes()->count());

        $status->like();

        // EL método fresh() vuelve a obtener el modelo desde la db para que esté actualizado
        $this->assertEquals(1, $status->fresh()->likes()->count());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_status_know_if_it_has_been_liked()
    {
        $status = Status::factory()->create();

        $this->assertFalse($status->isLiked());

        $this->actingAs(User::factory()->create());

        $this->assertFalse($status->isLiked());

        $status->like();

        $this->assertTrue($status->isLiked());
    }
}
