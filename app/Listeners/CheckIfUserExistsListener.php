<?php

namespace App\Listeners;

use App\Events\GroupInvitationCreatedEvent;
use App\Jobs\CreateInvitationJob;
use App\Jobs\CreateInvitationUserJob;
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
        if ($user = User::whereEmail($event->invitation->email)->first()) {
            CreateInvitationUserJob::dispatch($user);
            return;
        }

        CreateInvitationJob::dispatch($event->invitation);

    }
}
