<?php

use App\Livewire\Groups\Create;
use App\Models\Group;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

uses()->group('groups.create');

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('should be able to create a new group', function() {
    livewire(Create::class)
        ->set('groupName', 'TesteGrupo')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseCount('groups', 1);
});

test('name should be required', function() {
    livewire(Create::class)
        ->call('save')
        ->assertHasErrors(['groupName' => 'required']);
});

// test('name should be a valid string', function () {
//     livewire(Create::class)
//         ->set('groupName', 1)
//         ->call('save')
//         ->assertHasErrors(['groupName' => 'string']);
// });

test('name should have a min of 3 characters', function () {
    livewire(Create::class)
        ->set('groupName', 'a')
        ->call('save')
        ->assertHasErrors(['groupName' => 'min']);
});

test('name should have a max of 30 characters', function () {
    livewire(Create::class)
        ->set('groupName', str_repeat('a', 31))
        ->call('save')
        ->assertHasErrors(['groupName' => 'max']);
});

test('name should be unique', function () {
    Group::factory()->create(['name' => 'Test Group']);

    livewire(Create::class)
        ->set('groupName', 'Test Group')
        ->call('save')
        ->assertHasErrors(['groupName' => 'unique']);
});