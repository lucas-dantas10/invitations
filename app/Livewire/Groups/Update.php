<?php

namespace App\Livewire\Groups;

use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    use AuthorizesRequests;
    public ?Group $group = null;
    public string $groupName = '';
    public int $editing = 0;

    public function getRules(): array
    {
        return [
            'groupName' => [
                'required',
                'string',
                'min:3',
                'max:30',
                Rule::unique('groups', 'name')
                    ->ignore($this->group)
            ]
        ];
    }
    
    public function render()
    {
        return view('livewire.groups.update');
    }

    public function mount()
    {
        $this->authorize('update', $this->group);
    }

    public function save()
    {
        $this->validate();

        $this->group->name = $this->groupName;

        $this->group->save();

        $this->editing = 0;
    }
}
