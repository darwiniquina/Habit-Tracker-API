<?php

namespace Tests\Feature;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }

    public function test_user_can_create_a_habit()
    {
        $response = $this->postJson('/api/habits', [
            'name' => 'Morning Run',
            'description' => 'Go for a 30-minute jog',
            'frequency' => 'daily',
            'color' => '#FF6600',
            'reminder_time' => '07:00:00',
        ]);

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'frequency',
                    'color',
                    'reminder_time',
                ],
            ]);
    }

    public function test_user_cannot_create_habit_with_missing_fields()
    {
        $response = $this->postJson('/api/habits', [
            'name' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'frequency', 'reminder_time']);
    }

    public function test_user_can_list_their_habits()
    {
        Habit::factory()->count(3)->create(['user_id' => Auth::id()]);

        $response = $this->getJson('/api/habits');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['id', 'name', 'description']]]);
    }

    public function test_user_can_view_a_specific_habit()
    {
        $habit = Habit::factory()->create(['user_id' => Auth::id()]);

        $response = $this->getJson("/api/habits/{$habit->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $habit->id);
    }

    public function test_user_cannot_view_nonexistent_habit()
    {
        $response = $this->getJson('/api/habits/9999');

        $response->assertStatus(404)
            ->assertJson(['message' => 'Habit not found.']);
    }

    public function test_user_can_update_a_habit()
    {
        $habit = Habit::factory()->create(['user_id' => Auth::id()]);

        $response = $this->putJson("/api/habits/{$habit->id}", [
            'name' => 'Evening Walk',
            'description' => 'Take a short walk after dinner',
            'frequency' => 'daily',
            'color' => '#00AAFF',
            'reminder_time' => '19:00:00',
        ]);

        $response->assertOk()
            ->assertJsonPath('data.name', 'Evening Walk');
    }

    public function test_user_can_delete_a_habit()
    {
        $habit = Habit::factory()->create(['user_id' => Auth::id()]);

        $response = $this->deleteJson("/api/habits/{$habit->id}");
        $response->assertOk();

        $this->assertSoftDeleted('habits', ['id' => $habit->id]);
    }
}
