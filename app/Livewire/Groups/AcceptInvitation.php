<?php

namespace App\Livewire\Groups;

use App\Models\GroupInvitation;
use App\Notifications\DontWantToBePartOfGroupNotification;
use Livewire\Component;

class AcceptInvitation extends Component
{
    public function render()
    {
        return view('livewire.groups.accept-invitation');
    }

    public function getInvitationsProperty()
    {
        return GroupInvitation::whereEmail(auth()->user()->email)->get();
    }

    public function accept(int $invitationId)
    {
        $invitation = GroupInvitation::find($invitationId);
        $invitation->group->users()->attach(auth()->user());

        $invitation->delete();
    }

    public function reject(int $invitationId)
    {
        $invitation = GroupInvitation::find($invitationId);
        $invitation->user->notify(new DontWantToBePartOfGroupNotification);

        $invitation->delete();
    }
}
