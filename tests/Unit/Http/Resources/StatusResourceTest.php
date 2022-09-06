<?php

namespace Tests\Unit\Http\Resources;

use App\Models\Status;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Http\Resources\StatusResource;
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
    }
}
