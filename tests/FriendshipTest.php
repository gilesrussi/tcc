<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestFriendship extends TestCase {

    use DatabaseTransactions;

    /** @test */
    function it_sends_friendship_requests() {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $user1->sendFriendshipRequest($user2);
        $this->assertTrue($user1->isWaitingForResponseFrom($user2));
        $this->assertTrue($user2->canRespondTo($user1));
    }
}
