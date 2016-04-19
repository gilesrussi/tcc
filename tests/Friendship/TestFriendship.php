<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestFriendship extends TestCase {
    
    use DatabaseTransactions;

    function it_sends_friendship_requests() {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $this->actingAs($user1);
        $user1->sendFriendshipRequest($user2);
        $this->assertTrue($user1->waitingAcceptance($user2));
    }
}