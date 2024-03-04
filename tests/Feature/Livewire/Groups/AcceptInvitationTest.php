<?php

namespace Tests\Feature\Livewire\Groups;

use App\Livewire\Groups\AcceptInvitation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AcceptInvitationTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AcceptInvitation::class)
            ->assertStatus(200);
    }
}
