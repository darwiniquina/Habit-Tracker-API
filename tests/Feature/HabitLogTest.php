<?php

namespace Tests\Feature;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HabitLogTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Habit $habit;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        $this->habit = Habit::factory()->create(['user_id' => $this->user->id]);
    }

    public function test_user_cannot_view_logs_of_another_users_habit()
    {
        $otherHabit = Habit::factory()->create();

        $response = $this->getJson("/api/habits/{$otherHabit->id}/logs");

        $response->assertStatus(404)
            ->assertJson(['message' => 'Habit not found.']);
    }
}
