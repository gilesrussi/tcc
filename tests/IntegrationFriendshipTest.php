<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class IntegrationFriendshipTest extends TestCase
{

    use DatabaseTransactions;

    /** @var  User $user1 */
    protected $user1;
    /** @var  User $user2 */
    protected $user2;

    function setUp() {
        parent::setUp();
        $this->user1 = factory(User::class)->create();
        $this->user2 = factory(User::class)->create();
    }

    /** @test */
    function a_profile_can_be_seen_by_someone_logged_in() {
        $this->visit("/profile/" . $this->user2->id)
             ->seePageIs("/login");

        $this->actingAs($this->user1)
            ->visit("/profile/" . $this->user2->id)
            ->see($this->user2->name);
    }

}
