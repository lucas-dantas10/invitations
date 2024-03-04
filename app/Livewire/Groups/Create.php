<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use Livewire\Component;

class Create extends Component
{
    public Group $group;
    public string $groupName = '';

    protected array $rules = [
        'groupName' => ['required', 'string', 'min:3', 'max:30', 'unique:groups,name'],
    ];
    
    public function render()
    {
        return view('livewire.groups.create');
    }

    public function mount()
    {
        $this->group = new Group();
    }

    public function save()
    {
        $this->validate();

        $this->group->name = $this->groupName;
        $this->group->user_id = auth()->id();

        $this->group->save();

        $this->group->users()->attach(auth()->user());

        $this->dispatch(Index::class, 'group::refresh-list');
    }
}
