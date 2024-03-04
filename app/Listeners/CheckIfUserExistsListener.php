<?php

namespace App\Listeners;

use App\Events\GroupInvitationCreatedEvent;
use App\Models\User;
use App\Notifications\BePartOfGroupNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckIfUserExistsListener
{
    use Queueable;

    /**
     * Handle the event.
     */
    public function handle(GroupInvitationCreatedEvent $event): void
    {
        if ($user = User::whereEmail($event->invitation->email)->first())
        {
            $user->notify(new BePartOfGroupNotification());        
            return;
        }

        $event->invitation->notify(new BePartOfGroupNotification());
    }
}
