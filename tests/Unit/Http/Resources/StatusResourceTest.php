<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\Status;
use App\Models\Comment;
use App\Http\Resources\StatusResource;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     *
     * @return void
     */
    public function a_status_resources_must_have_the_necessary_field()
    {
        $status = Status::factory()->create();
        Comment::factory()->create(['status_id' => $status->id]);

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals(
            $status->id, 
            $statusResource['id']
        );
        $this->assertEquals(
            $status->body, 
            $statusResource['body']
        );
        $this->assertEquals(
            $status->user->name, 
            $statusResource['user_name']
        );
        $this->assertEquals(
            'https://www.pmfarma.es/images/avatar-equipo.png', 
            $statusResource['user_avatar']
        );
        $this->assertEquals(
            $status->created_at->diffForHumans(), 
            $statusResource['ago']
        );
        $this->assertEquals(
            false, 
            $statusResource['is_liked']
        );
        $this->assertEquals(
            0,
            $statusResource['likes_count']
        );
        // dd($statusResource['comments']->first()->resource);
        $this->assertEquals(
            CommentResource::class,
            $statusResource['comments']->collects
        );
        $this->assertInstanceOf(
            Comment::class,
            $statusResource['comments']->first()->resource
        );
    }
}
