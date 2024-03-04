<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupInvitation;
use Livewire\Component;

class Index extends Component
{
    public int $create = 0;

    protected $listeners = [
        'group:refresh-list' => 'refreshList',
    ];

    public function render()
    {
        return view('livewire.groups.index');
    }

    public function getHasInvitationsProperty()
    {
        return GroupInvitation::whereEmail(auth()->user()->email)->exists();
    }

    public function getGroupsProperty()
    {
        return auth()->user()->groups;
    }

    public function refreshList()
    {
        $this->create = 0;
    }
}
