<?php

use App\Livewire\Groups\Index;
use App\Models\Group;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

uses()->group('groups.index');

beforeEach(function () {
    $this->user = User::factory()->createOne();
    actingAs($this->user);
});

it('should list all groups that I own', function () {
    $userNotOwn = User::factory()->createOne();
    $groupsThatIOwn = Group::factory()->count(3)->create(['user_id' => $this->user->id]);
    $groupsThatIDontOwn = Group::factory()->count(3)->create(['user_id' => $userNotOwn->id]);

    foreach ($groupsThatIOwn as $group) {
        $group->users()->attach($this->user);
    }

    foreach ($groupsThatIDontOwn as $group) {
        $group->users()->attach($userNotOwn);
    }

    actingAs($this->user);

    livewire(Index::class)
        ->assertSet('groups', function ($groups) use ($groupsThatIOwn, $groupsThatIDontOwn) {
            $iOwn = $groupsThatIOwn->whereIn('id', $groups->pluck('id'));

            if ($iOwn->count() !== 3) {
                return false;
            }

            $iDontOwn = $groupsThatIDontOwn->whereIn('id', $groups->pluck('id'));

            if ($iDontOwn->count() === 3) {
                return false;
            }

            return true;
        });
});
