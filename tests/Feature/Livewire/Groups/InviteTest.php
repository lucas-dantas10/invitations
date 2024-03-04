<?php

use App\Events\GroupInvitationCreatedEvent;
use App\Listeners\CheckIfUserExistsListener;
use App\Livewire\Groups\Invite;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use App\Notifications\BePartOfGroupNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses()->group('groups.invite');

it('should be able to invite someone to be part of group', function() {
    //Arrange
    Event::fake();
    $user = User::factory()->create();
    $group = Group::factory()->create();

    actingAs($user);

    //Act
    $lw = livewire(Invite::class, compact('group'))
        ->set('email', 'jeremias@example.com')
        ->call('save');

    //Assert
    $lw->assertHasNoErrors();
    assertDatabaseCount(GroupInvitation::class , 1);
    expect(GroupInvitation::first())
        ->email->toBe('jeremias@example.com')
        ->group_id->toBe($group->id)
        ->user_id->toBe($user->id);
    Event::assertDispatched(GroupInvitationCreatedEvent::class);
});

test('if user exists notify him to be part of the group', function () {
    // Arrange
    Notification::fake();
    $user       = User::factory()->create();
    $invited    = User::factory()->create(['email' => 'jeremias@example.com']);
    $group      = Group::factory()->create(['user_id' => $user->id]);
    $invitation = GroupInvitation::create([
        'user_id'  => $user->id,
        'group_id' => $group->id,
        'email'    => 'jeremias@example.com',
    ]);

    $event = new GroupInvitationCreatedEvent($invitation);

    // Act
    $listener = new CheckIfUserExistsListener();
    $listener->handle($event);

    // Assert
    Notification::assertSentTo($invited, BePartOfGroupNotification::class);
});

test('if user not exists notify him anyway to be part of the group', function () {
    // Arrange
    Notification::fake();
    $user       = User::factory()->create();
    $group      = Group::factory()->create(['user_id' => $user->id]);
    $invitation = GroupInvitation::create([
        'user_id'  => $user->id,
        'group_id' => $group->id,
        'email'    => 'jeremias@example.com',
    ]);

    $event = new GroupInvitationCreatedEvent($invitation);

    // Act
    $listener = new CheckIfUserExistsListener();
    $listener->handle($event);

    // Assert
    Notification::assertSentTo($invitation, BePartOfGroupNotification::class);
});
