<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Status;
use Tests\TestCase;
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
}
