<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListStatusesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function can_get_all_statuses()
    {
        $status1 = Status::factory()->create(['created_at' => now()->subDays(4)]);
        $status2 = Status::factory()->create(['created_at' => now()->subDays(3)]);
        $status3 = Status::factory()->create(['created_at' => now()->subDays(2)]);
        $status4 = Status::factory()->create(['created_at' => now()->subDays(1)]);
        
        $response = $this->getJson(route('statuses.index'));

        $response->assertSuccessful();

        $response->assertJson([
            'total' => 4
        ]);

        $response->assertJsonStructure([
            'data','total','first_page_url', 'last_page_url'
        ]);

        $this->assertEquals(
            $status4->id,
            $response->json('data.0.id')
        );
    }
}
