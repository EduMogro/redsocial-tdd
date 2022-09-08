<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Status;
use PHPUnit\Util\Test;
use App\Models\Comment;
use PHPUnit\Framework\TestBuilder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;

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
    public function a_status_has_many_comments()
    {
        $status = Status::factory()->create();

        Comment::factory()->create([
            'status_id' => $status->id,
            'user_id' => $status->user
        ]);

        $this->assertInstanceOf(Comment::class, $status->comments->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_status_can_be_liked_and_unliked()
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();

        /** @var User $user */
        $this->actingAs($user);

        $status->like();

        $this->assertEquals(1, $status->fresh()->likes()->count());

        $status->unlike();

        $this->assertEquals(0, $status->fresh()->likes()->count());
    }

        /**
     * @test
     *
     * @return void
     */
    public function a_status_can_be_liked_once()
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();

        /** @var User $user */
        $this->actingAs($user);

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
        $user = User::factory()->create();

        /** @var User $user */
        $this->actingAs($user);

        $this->assertFalse($status->isLiked());

        $status->like();

        $this->assertTrue($status->isLiked());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_status_knows_how_many_likes_it_has()
    {
        $status = Status::factory()->create();

        $this->assertEquals(0, $status->likesCount());

        Like::factory(2)->create([
            'status_id' => $status->id
        ]);

        $this->assertEquals(2, $status->likesCount());
    }
}
