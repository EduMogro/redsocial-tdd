<?php

namespace Tests\Browser;

use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersSeeStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function users_can_see_all_statuses_on_the_homepage()
    {
       $statuses = Status::factory()->count(3)->create();

       $this->browse(function (Browser $browser) use ($statuses){
           $browser->visit('/')
                    ->waitForText($statuses->first()->body)
                    ->assertSee($statuses->first()->body);

            foreach ($statuses as $status) {
                $browser->assertSee($status->body);
            }
       });
    }
}
