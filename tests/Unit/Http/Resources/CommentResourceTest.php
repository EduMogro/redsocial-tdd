<?php

namespace Tests\Unit\Http\Resources;

use App\Models\Status;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     *
     * @return void
     */
    public function a_comment_resources_must_have_the_necessary_field()
    {
        $comment = Status::factory()->create();

        $commentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals(
            $comment->body, 
            $commentResource['body']
        );
        $this->assertEquals(
            $comment->user->name, 
            $commentResource['user_name']
        );
        $this->assertEquals(
            'https://www.pmfarma.es/images/avatar-equipo.png', 
            $commentResource['user_avatar']
        );
    }
}
