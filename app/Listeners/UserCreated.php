<?php

namespace App\Listeners;

use App\Events\UserCreated as UserCreatedEvent;

class UserCreated {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event) {
        $event->user->stats()->create();
        $event->user->achievements()->create();
    }
}
