<?php

namespace Tests\Feature\Livewire;

use App\Livewire\UserHierarchyManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserHierarchyManagerTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(UserHierarchyManager::class)
            ->assertStatus(200);
    }
}
