<?php

namespace Tests\Feature\Livewire\Groups;

use App\Livewire\Groups\Invite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class InviteTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Invite::class)
            ->assertStatus(200);
    }
}
