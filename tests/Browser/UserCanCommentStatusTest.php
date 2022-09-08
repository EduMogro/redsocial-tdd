<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Status;
use App\Models\Comment;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserCanCommentStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * 
     * @return void
     */
    public function users_can_see_all_comments()
    {
        $status = Status::factory()->create();
        $comments = Comment::factory(2)->create([
            'status_id' => $status->id
        ]);

        $this->browse(function (Browser $browser) use ($status, $comments) {
            $browser->visit('/')
                    ->waitForText($status->body);

            foreach ($comments as $comment) {
                $browser->assertSee($comment->body)
                        ->assertSee($comment->user->name);
            }
        });

    }

    /**
     * @test
     * 
     * @return void
     */
    public function authenticated_users_can_comment_statuses()
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($status, $user) {
            
            $comment = "Mi primer comentario";
            
            $browser->loginAs($user)
                    ->visit('/')
                    ->waitForText($status->body)
                    ->type('comment', $comment)
                    ->press('@btn-comment')
                    ->waitForText($comment)
                    ->assertSee($comment);
        });
    }
}
